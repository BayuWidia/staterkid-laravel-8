<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\Management\ManagementRole\Interfaces;

interface ManagementRoleInterface {

  public function getCustomManagementRole();

  public function store($data);

  public function update($data, $id);

  public function delInsAccess($params);

  public function getDataById($id);

  public function updateStatus($params);

  public function getDataAllRoleMenuById($id);

  public function getDataAllRoleMenu();

}
