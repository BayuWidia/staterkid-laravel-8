<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\Management\ManagementMenu;

// =============== start default use repository ===============
use Auth;
use DB;

use App\Repositories\Management\ManagementMenu\Interfaces\ManagementMenuInterface as ManagementMenuInterface;
use App\Models\MasterMenus;
use App\Models\MasterMenusSecond;
use App\Models\MasterMenusThird;
// =============== end default use repository ===============


class ManagementMenuRepository implements ManagementMenuInterface
{

    public function getDataMenus()
    {
        $getData = MasterMenus::all();
        return $getData;
    }

    public function getDataMenusSecond()
    {
        $getData = MasterMenusSecond::all();
        return $getData;
    }

    public function getDataMenusThird()
    {
        $getData = MasterMenusThird::all();
        return $getData;
    }

    public function getDataMenusById($id)
    {
        return MasterMenus::where('id_master_menus',$id)->get();
    }

    public function getDataMenusSecondById($id)
    {
        return MasterMenusSecond::where('id_master_menus_second',$id)->get();
    }

    public function getDataMenusSecondByIdMasterMenus($id)
    {
        return MasterMenusSecond::where('id_master_menus',$id)->get();
    }

    public function getDataMenusThirdById($id)
    {
        $data = MasterMenusThird::select('master_menus_third.*', 'master_menus_second.id_master_menus')
                                  ->join('master_menus_second', 'master_menus_second.id_master_menus_second', '=', 'master_menus_third.id_master_menus_second')
                                  ->where('id_master_menus_third',$id)->get();
                                  // dd($data);
        return $data;
    }

    public function storeMenus($attributes)
    {
        DB::transaction(function() use($attributes,&$result) {
           $result = MasterMenus::create($attributes);
        });
        return $result;
    }

    public function updateMenus($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterMenus::where('id_master_menus',$id)->update($data);
        });
        return $record;
    }

    public function storeMenusSecond($attributes)
    {
        DB::transaction(function() use($attributes,&$result) {
           $result = MasterMenusSecond::create($attributes);
        });
        return $result;
    }

    public function updateMenusSecond($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterMenusSecond::where('id_master_menus_second',$id)->update($data);
        });
        return $record;
    }

    public function updateMenusSecondByIdMasterMenu($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterMenusSecond::where('id_master_menus',$id)->update($data);
        });
        return $record;
    }

    public function storeMenusThird($attributes)
    {
        DB::transaction(function() use($attributes,&$result) {
           $result = MasterMenusThird::create($attributes);
        });
        return $result;
    }

    public function updateMenusThird($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterMenusThird::where('id_master_menus_third',$id)->update($data);
        });
        return $record;
    }

    public function updateMenusThirdByIdMenuSecond($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterMenusThird::where('id_master_menus_second',$id)->update($data);
        });
        return $record;
    }


}
