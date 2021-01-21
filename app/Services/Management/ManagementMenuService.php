<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Services\Management;

// =============== start default use service ===============
use Auth;
use Image;
use Hash;
use Ramsey\Uuid\Uuid;

use App\Repositories\Management\ManagementMenu\Interfaces\ManagementMenuInterface as ManagementMenuInterface;
// =============== end default use service ===============


class ManagementMenuService
{

    private $managementMenuInterface;

    public function __construct(ManagementMenuInterface $managementMenuInterface)
    {
        $this->managementMenuInterface = $managementMenuInterface;
    }

    public function getDataMenus(){
      $getDataMenus = $this->managementMenuInterface->getDataMenus();

      $getDataMenusSecond = $this->managementMenuInterface->getDataMenusSecond();

      $getDataMenusThird = $this->managementMenuInterface->getDataMenusThird();

      foreach($getDataMenusSecond as $key){
  			$idMasterMenus			= $key->id_master_menus;
  			$getDataMenusSeconds[$idMasterMenus][] = $key;
  		}

      if ($getDataMenusThird != null) {
        foreach($getDataMenusThird as $key){
    			$idMasterMenuSecond	=$key->id_master_menus_second;
    			$getDataMenusThirds[$idMasterMenuSecond][]=$key;
    		}
      } else {
        $getDataMenusThirds = array();
      }
      $dataMenu = array("getDataMenus" => $getDataMenus,
                        "getDataMenusSecond" => $getDataMenusSeconds,
                        "getDataMenusThird" => $getDataMenusThirds,
                        );
      return $dataMenu;
    }

    public function store($params)
    {
        if ($params->level == "grandparent") {
          $data = array('id_master_menus' => Uuid::uuid4(),
                        'menu_name'       => $params->menuName,
                        'menu_icon'       => $params->menuIcon,
                        'created_by'      =>  Auth::user()->username,
                        'is_active'       => 1);
          $result = $this->managementMenuInterface->storeMenus($data);
        } else if($params->level == "parent") {
          $data = array('id_master_menus_second' => Uuid::uuid4(),
                        'id_master_menus'        => $params->menuId,
                        'menus_second_name'      => $params->menuName,
                        'menus_second_route'     => $params->menuRoute,
                        'created_by'             =>  Auth::user()->username,
                        'is_active'              => 1);
          $result = $this->managementMenuInterface->storeMenusSecond($data);
        } else {
          $data = array('id_master_menus_third' => Uuid::uuid4(),
                        'id_master_menus_second' => $params->menuSecondId,
                        'menus_third_name'      => $params->menuName,
                        'menus_third_route'     => $params->menuRoute,
                        'created_by'            =>  Auth::user()->username,
                        'is_active'             => 1);
          $result = $this->managementMenuInterface->storeMenusThird($data);
        }

    		return $result;
    }

    public function update($params)
    {
        if ($params->levelEdit == "grandparent") {
          $data = array('id_master_menus' => $params->idEdit,
                        'menu_name'       => $params->menuNameEdit,
                        'menu_icon'       => $params->menuIconEdit,
                        'updated_by'      =>  Auth::user()->username,
                        'is_active'       => 1);
          $result = $this->managementMenuInterface->updateMenus($data, $params->idEdit);
        } else if($params->levelEdit == "parent") {
          $data = array('id_master_menus_second' => $params->idEdit,
                        'id_master_menus'        => $params->menuIdEdit,
                        'menus_second_name'      => $params->menuNameEdit,
                        'menus_second_route'     => $params->menuRouteEdit,
                        'updated_by'             =>  Auth::user()->username,
                        'is_active'              => 1);
          $result = $this->managementMenuInterface->updateMenusSecond($data, $params->idEdit);
        } else {
          $data = array('id_master_menus_third' => $params->idEdit,
                        'id_master_menus_second' => $params->menuSecondIdEdit,
                        'menus_third_name'      => $params->menuNameEdit,
                        'menus_third_route'     => $params->menuRouteEdit,
                        'updated_by'            =>  Auth::user()->usernameEdit,
                        'is_active'             => 1);
          $result = $this->managementMenuInterface->updateMenusThird($data, $params->idEdit);
        }
    		return $result;

    }

    public function updateStatus($id, $condition, $level)
    {
        $condition == "nonactive" ? $condition=0 : $condition=1;
        $getDataMenusSecondByIdMasterMenus = $this->managementMenuInterface->getDataMenusSecondByIdMasterMenus($id);

        if ($level == 'grandparent') {
          $data = array('id_master_menus' => $id,
                        'is_active'       => $condition,
                        'updated_by'      => Auth::user()->username);
          $this->managementMenuInterface->updateMenus($data, $id);
          $this->managementMenuInterface->updateMenusSecondByIdMasterMenu($data, $id);


          //child
          foreach ($getDataMenusSecondByIdMasterMenus as $key) {
            $data = array('id_master_menus_second' => $key->id_master_menus_second,
                          'is_active'       => $condition,
                          'updated_by'      => Auth::user()->username);
            $this->managementMenuInterface->updateMenusThirdByIdMenuSecond($data, $key->id_master_menus_second);
          }

        } else if ($level == 'parent') {

          $data = array('id_master_menus_second' => $id,
                        'is_active'       => $condition,
                        'updated_by'      => Auth::user()->username);
          $this->managementMenuInterface->updateMenusSecond($data, $id);

          $this->managementMenuInterface->updateMenusThirdByIdMenuSecond($data, $id);

        } else if ($level == 'child') {
          $data = array('id_master_menus_third' => $id,
                        'is_active'       => $condition,
                        'updated_by'      => Auth::user()->username);
          $this->managementMenuInterface->updateMenusThird($data, $id);

        }
    }

    public function getDataMenusSecondByIdMasterMenus($id)
    {
      $data= $this->managementMenuInterface->getDataMenusSecondByIdMasterMenus($id);
      return $data;
    }

    public function getDataMenu($id,$level){
        if($level == "grandparent"){
    			$data = $this->managementMenuInterface->getDataMenusById($id);
    		}else if($level == "parent"){
    			$data = $this->managementMenuInterface->getDataMenusSecondById($id);
    		}else{
    			$data = $this->managementMenuInterface->getDataMenusThirdById($id);
    		}
    		return $data;
    }


}
