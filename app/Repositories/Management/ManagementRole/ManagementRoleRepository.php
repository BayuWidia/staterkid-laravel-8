<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\Management\ManagementRole;

// =============== start default use repository ===============
use Auth;
use DB;
use Ramsey\Uuid\Uuid;

use App\Repositories\Management\ManagementRole\Interfaces\ManagementRoleInterface as ManagementRoleInterface;
use App\Models\MasterRoles;
use App\Models\MasterAccess;

// =============== end default use repository ===============

class ManagementRoleRepository implements ManagementRoleInterface
{

    public function getCustomManagementRole()
    {
        $data = MasterRoles::all();
        return $data;
    }

    public function store($data)
    {
        DB::transaction(function() use($data,&$result) {
           $result = MasterRoles::create($data);
        });
        return $result;
    }

    public function getDataById($id)
    {
        return MasterRoles::where('id_master_roles',$id)->first();
    }

    public function update($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterRoles::where('id_master_roles',$id)->update($data);
        });
        return $record;
    }

    public function delInsAccess($params)
    {
        DB::transaction(function () use($params,&$update) {
            DB::delete('DELETE from master_access where role_id = ?', [$params['roleId']]);

            $idListMenus = $params['idListMenuHeader'];
            if ($idListMenus != null) {
              foreach($idListMenus as $idListMenu){
                $idArr = explode("/", $idListMenu);
                if ($idArr[1] == '') {
                  $idArr[1] = null;
                }
                $data =array('id_master_access' => Uuid::uuid4(),
                              'role_id' => $params['roleId'],
                              'id_master_menus_second' => $idArr[0],
                              'id_master_menus_third' => $idArr[1],
                              'is_active' => $params['status'],
                              'created_by' => $params['createdBy']);

                $update = MasterAccess::create($data);
              }
            }

        });
        return $update;
    }

    public function updateStatus($params)
    {
        DB::transaction(function () use($params,&$update) {
            $update = MasterRoles::where('id_master_roles',$params['id'])->update(["is_active"=>$params->status, "updated_by"=>$params->updated_by]);
        });
        return $update;
    }

    public function getDataAllRoleMenuById($id)
    {
        return DB::select("SELECT
                                ma.id_master_access,
                                mm.id_master_menus,
                                mm.menu_name,
                                mms.id_master_menus_second,
                                mms.menus_second_name,
                                mmt.id_master_menus_third,
                                mmt.menus_third_name,
                                mms.menus_second_route,
                                mmt.menus_third_route
                            FROM master_access as ma
                                LEFT JOIN master_menus_second as mms on mms.id_master_menus_second = ma.id_master_menus_second
                                LEFT JOIN master_menus as mm on mm.id_master_menus = mms.id_master_menus
                                LEFT JOIN master_menus_third as mmt on mmt.id_master_menus_third = ma.id_master_menus_third
                            WHERE ma.role_id = '$id'
                            ORDER BY mm.menu_name, mms.menus_second_name,mmt.menus_third_name");
    }

    public function getDataAllRoleMenu()
    {
        return DB::select("SELECT
                                mm.id_master_menus,
                            		mm.menu_name,
                                mm.menu_icon,
                            		mms.id_master_menus_second,
                            		mms.menus_second_name,
                            		mmt.id_master_menus_third,
                            		mmt.menus_third_name,
                            		mms.menus_second_route,
                            		mmt.menus_third_route
                            FROM master_menus as mm
                            		LEFT JOIN master_menus_second as mms on mm.id_master_menus = mms.id_master_menus
                            		LEFT JOIN master_menus_third as mmt on mms.id_master_menus_second = mmt.id_master_menus_second
                            order by mm.menu_name, mms.menus_second_name,mmt.menus_third_name");
    }

}
