<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Services\Management;

// =============== start default use service ===============
use Auth;
use Ramsey\Uuid\Uuid;

use App\Repositories\Management\ManagementRole\Interfaces\ManagementRoleInterface as ManagementRoleInterface;
// =============== end default use service ===============


class ManagementRoleService
{

    private $managementRoleInterface;

    public function __construct(ManagementRoleInterface $managementRoleInterface)
    {
        $this->managementRoleInterface = $managementRoleInterface;
    }


    public function getCustomManagementRole()
    {
        $result = $this->managementRoleInterface->getCustomManagementRole();

        return $result;
    }

    public function store($params)
    {
        $data = array("id_master_roles" => Uuid::uuid4(),
                      "role_name"       => $params->roleName,
                      "description"     => $params->description,
                      "is_active"       => "1",
                      "created_by"      => Auth::user()->username,);
        $result = $this->managementRoleInterface->store($data);
        return $result;
    }

    public function getDataById($id)
    {
        $result = $this->managementRoleInterface->getDataById($id);
        return $result;
    }

    public function update($params)
    {
        $data = array("id_master_roles" => $params->idMasterRoles,
                      "role_name"       => $params->roleName,
                      "description"     => $params->description,
                      "updated_by"      => Auth::user()->username,);
        $result = $this->managementRoleInterface->update($data, $params->idMasterRoles);
        return $result;
    }

    public function delInsAccess($params)
    {
      // dd($params);
      $data = array('roleId'           => $params->roleId,
                    'idListMenuHeader' => $params->idListMenuHeader,
                    'status'           => 1,
                    'createdBy'        => Auth::user()->username);
      $data = $this->managementRoleInterface->delInsAccess($data);
      return $data;
    }

    public function updateStatus($params)
    {
        $params['status']==1 ? $params['status']=0 : $params['status']=1;
        $params['updated_by'] = Auth::user()->username;
        $result = $this->managementRoleInterface->updateStatus($params);
        return $result;
    }

    public function getDataAllRoleMenuById($id)
    {
        $result = $this->managementRoleInterface->getDataAllRoleMenuById($id);
        return $result;
    }

    public function getDataAllRoleMenu()
    {
        $result = $this->managementRoleInterface->getDataAllRoleMenu();
        return $result;
    }

}
