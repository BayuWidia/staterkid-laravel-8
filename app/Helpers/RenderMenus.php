<?php

namespace App\Helpers;

use Carbon\Carbon;
use \Cache;
use Auth;
use Str;
use Route;
class RenderMenus
{
    public static function redisGet($keys=''){
        $value = Cache::get($keys);
        return $value;
    }

    public static function moduleName(){
        $modulDetails   = RenderMenus::redisGet('cache.modul_details_'.Auth::user()->role_id);
        $moduleName = strtoupper($modulDetails['modul_name']);
        return $moduleName;
    }

    public static function activeMenu($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    public static function menuOpen($path, $menuOpen = 'dropdown') {
        return call_user_func_array('Request::is', (array)$path) ? $menuOpen : '';
    }
    public static function appendMenus(){

        $menus          = RenderMenus::redisGet('cache.menus');
        $subMenu1       = RenderMenus::redisGet('cache.subMenu1');
        $subMenu2       = RenderMenus::redisGet('cache.subMenu2');
        $icons          = RenderMenus::redisGet('cache.icons');

        $addMenus = '';
        dd($menus);
        foreach ($menus[Auth::user()->role_id] as $keyFirst => $valFirst) {
        // code...
        $name = Route::currentRouteName();
        $openMenuParent = "";
            foreach ($valFirst as $keySecond => $valSecond) {
                    $openMenuParent = $subMenu1[Auth::user()->role_id][$keyFirst][$keySecond];
                    if(!empty($valSecond[0])){
                        foreach($valSecond as $keyThird => $valThird){
                            $openMenuParent = $subMenu2[Auth::user()->role_id][$keyFirst][$keySecond][$valThird];
                            if ($name == $openMenuParent) {
                            break;
                            }
                        }
                    }
                    if ($name == $openMenuParent) {
                    break;
                    }
            }
            $addMenus .= '<li class="nav-item '.RenderMenus::menuOpen([$openMenuParent."*"]).'">
                        <a href="#" class="nav-link  has-dropdown">
                            <i class="'.$icons[$keyFirst].'"></i>
                            '.$keyFirst.'
                        </a>
                        <ul class="dropdown-menu">';
                        foreach ($valFirst as $keySecond => $valSecond) {
                            // dd($keySecond[0]);
                            $routeSecondMenus = $subMenu1[Auth::user()->role_id][$keyFirst][$keySecond];

                            $openMenuChild = "";
                            if(!empty($valSecond[0])){
                                foreach($valSecond as $keyThird => $valThird){
                                    $openMenuChild = $subMenu2[Auth::user()->role_id][$keyFirst][$keySecond][$valThird];
                                    if ($name == $openMenuChild) {
                                    break;
                                    }
                                }
                            }

                            $addMenus .= '<li class="nav-item '.RenderMenus::menuOpen([$openMenuChild."*"]).'">
                                            <a href="'.url('/'.$routeSecondMenus).'" class="nav-link '.RenderMenus::activeMenu([$routeSecondMenus."*"]).'">
                                            '.$keySecond.'
                                            </a>';

                                            if(!empty($valSecond[0])){
                                            $addMenus .= '<ul class="dropdown-menu">';
                                                foreach($valSecond as $keyThird => $valThird){
                                                    $addMenus .= '<li class="nav-item">
                                                                    <a href="'.url('/'.$subMenu2[Auth::user()->role_id][$keyFirst][$keySecond][$valThird]).'" class="nav-link '.RenderMenus::activeMenu([$subMenu2[Auth::user()->role_id][$keyFirst][$keySecond][$valThird]."*"]).'">
                                                                    '.$valThird.'
                                                                    </a>
                                                                </li>';
                                                }
                                            $addMenus .= '</ul>';
                                            }


                            $addMenus .= '</li>';
                        }
                $addMenus .= '</ul>
                            </li>';
        }

        return $addMenus;
    }
}
