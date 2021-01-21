<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\Management\ManagementUser\Interfaces;

interface ManagementUserInterface {

  public function getDataUsers();

  public function getDataUsersById($id);

  public function getCheckUserDouble($username, $email, $condition);

  public function getDataUsersPaging();

  public function getSearchDataUsersPaging($params);

  public function getDataUserJoinRoleById();

  public function store($data);

  public function update($data, $id);
}
