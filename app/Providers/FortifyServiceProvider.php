<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Hash;
use App\Models\User;
use Validator;
use Auth;
use Session;
use Illuminate\Support\Facades\Redis;
use App\Services\IsAdmin\PrivillageService;
use App\Services\Management\ManagementUserService;
use \Cache;
use Carbon\Carbon;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $user = User::where($loginType, $request->email)->where('is_active','1')->first();

            if ($user && Hash::check($request->password, $user->password)) {

                /*$user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);*/

                $managementUserService = app(ManagementUserService::class);
                $getCounter = $user->login_count + 1;
                $latLoginAt = Carbon::now()->toDateTimeString();
                $latLoginIp = $request->getClientIp();
                $id = $user->id_master_users;
                $auth = $user->username;
                $roleData = $managementUserService->updateCountLogin($getCounter, $latLoginAt, $latLoginIp, $id, $auth);

                $privillageService = app(PrivillageService::class);
                $roleData = $privillageService->getPrivillage();

                $SubMenu2 = array();
                foreach($roleData as $privillage){

                    $role_id            = $privillage->role_id;
                    $menu_name          = $privillage->menu_name;
                    $menus_second_name  = $privillage->menus_second_name;
                    $menus_third_name   = $privillage->menus_third_name;
                    $icons[$menu_name]	= $privillage->menu_icon;

                    $Menus[$role_id][$menu_name][$menus_second_name][] = $menus_third_name;

                    if($privillage->menus_third_route!=''){
                        $route_second_menu='#';
                        $route_third_menu	=$privillage->menus_third_route;

                        $SubMenu2[$role_id][$menu_name][$menus_second_name][$menus_third_name]=$route_third_menu;
                        $SubMenu1[$role_id][$menu_name][$menus_second_name]=$route_second_menu;
                    } else {
                        $route_second_menu=$privillage->menus_second_route;
                        $route_third_menu	='';

                        $SubMenu1[$role_id][$menu_name][$menus_second_name]=$route_second_menu;
                    }

                }

                if (!Cache::has('cache.menus')){ Cache::put('cache.menus', $Menus); }
                if (!Cache::has('cache.subMenu1')){ Cache::put('cache.subMenu1', $SubMenu1); }
                if (!Cache::has('cache.subMenu2')){ Cache::put('cache.subMenu2', $SubMenu2); }
                if (!Cache::has('cache.icons')){ Cache::put('cache.icons', $icons); }

                return $user;
            }
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
