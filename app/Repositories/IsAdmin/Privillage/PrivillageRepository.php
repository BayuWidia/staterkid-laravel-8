<?php
namespace App\Repositories\IsAdmin\Privillage;

use App\Repositories\IsAdmin\Privillage\Interfaces\PrivillageInterface as PrivillageInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\MasterUser;
use \Cache;

class PrivillageRepository implements PrivillageInterface {

    public function getPrivillage()
    {
      return Cache::rememberForever("cache.all.menus" , function(){

          $resultDB = DB::select('SELECT role_id,  mm.id_master_menus
                                      , menu_name, menu_icon
                                      , mms.id_master_menus_second, mms.menus_second_name, mms.menus_second_route
                                      , mmt.id_master_menus_third, mmt.menus_third_name, mmt.menus_third_route
                                    FROM master_access ma
                                    LEFT JOIN master_menus_second mms
                                      ON ma.id_master_menus_second=mms.id_master_menus_second
                                    LEFT JOIN master_menus_third mmt
                                      ON ma.id_master_menus_third=mmt.id_master_menus_third
                                    LEFT JOIN master_menus mm
                                      ON mms.id_master_menus=mm.id_master_menus
                                    WHERE 1=1
                                    AND ma.is_active=1
                                    AND (mmt.is_active=1 OR mms.is_active=1)
                                    AND mm.is_active=1
                                    ORDER BY role_id, mm.urutan,mms.urutan,mmt.urutan');

          return $resultDB;
      });
    }

}
