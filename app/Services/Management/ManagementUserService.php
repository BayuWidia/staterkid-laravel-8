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

use App\Repositories\Management\ManagementUser\Interfaces\ManagementUserInterface;
// =============== end default use service ===============


class ManagementUserService
{
    public function __construct()
    {
        $this->managementuserInterface = app(ManagementUserInterface::class);
    }

    public function getDataUsersById($id)
    {
      $result = $this->managementuserInterface->getDataUsersById($id);
      return $result;
    }

    public function getCheckUserDouble($username, $email, $condition)
    {
      $result = $this->managementuserInterface->getCheckUserDouble($username, $email, $condition);
      return $result;
    }

    public function getDataUserJoinRoleById()
    {
      $result = $this->managementuserInterface->getDataUserJoinRoleById();
      return $result;
    }

    public function getDataUsersPaging()
    {
      $result = $this->managementuserInterface->getDataUsersPaging();
      return $result;
    }

    public function getSearchDataUsersPaging($params)
    {
      $result = $this->managementuserInterface->getSearchDataUsersPaging($params);
      return $result;
    }

    public function store($params)
    {
        $file = $params->file('urlPhoto');
        $photoName = '';
        if($file!="") {
        $photoName = Auth::user()->username.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->fit(128,128)->save('images/user/'. $photoName);
        }

        $data = array('id_master_users' => Uuid::uuid4(),
                      'role_id'         => $params->roleId,
                      'username'        => $params->username,
                      'fullname'        => $params->fullname,
                      'email'           => $params->email,
                      'password'        => Hash::make($params->password),
                      'url_photo'       => $photoName,
                      'login_count'     => 0,
                      'created_by'      =>  Auth::user()->username,
                      'is_active'       => $params->status);
        $result = $this->managementuserInterface->store($data);
        return $result;
    }

    public function update($params)
    {
        $file = $params->file('urlPhotoEdit');
        $data=array('id_master_users' => $params->idMasterUsersEdit,
                    'username'        => $params->usernameEdit,
                    'role_id'         => $params->roleIdEdit,
                    'fullname'        => $params->fullnameEdit,
                    'email'           => $params->emailEdit,
                    'is_active'       => $params->statusEdit,
                    'updated_by'      => Auth::user()->username);
        $arrTemp = array();
        if($file!="") {
          $photoName = Auth::user()->username.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->fit(128,128)->save('images/user/'. $photoName);

          $arrTemp = array('url_photo' => $photoName);
        }

        $data = array_merge($data, $arrTemp);

        $result = $this->managementuserInterface->update($data, $params->idMasterUsersEdit);
    }

    public function updPassword($params)
    {
      $data = array('id_master_users' => $params->idMasterUsersPassword,
                    'password'        => Hash::make($params->passwordPass),
                    'updated_by'      => Auth::user()->username);
     $result = $this->managementuserInterface->update($data, $params->idMasterUsersPassword);
    }

    public function updatepasswordByUser($params)
    {
        $data = array('id_master_users' => $params->idMasterUsers,
                      'fullname'        => $params->fullname,
                      'password'        => Hash::make($params->password),
                      'updated_by'      => Auth::user()->username);
        $result = $this->managementuserInterface->update($data, $params->idMasterUsers);
    }

    public function updateStatus($id, $condition)
    {
        $condition == "nonactive" ? $condition=0 : $condition=1;
        $data = array('id_master_users' => $id,
                      'is_active'       => $condition,
                      'updated_by'      => Auth::user()->username);
        $result = $this->managementuserInterface->update($data, $id);
    }

    public function updateCountLogin($getCounter, $latLoginAt, $latLoginIp, $id, $auth)
    {
        $data = array('id_master_users' => $id,
                      'login_count'     => $getCounter,
                      'last_login_at'   => $latLoginAt,
                      'last_login_ip'   => $latLoginIp,
                      'updated_by'      => $auth);
        $result = $this->managementuserInterface->update($data, $id);
    }
}
