<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\Management\ManagementUser;

// =============== start default use repository ===============
use Auth;
use DB;

use App\Repositories\Management\ManagementUser\Interfaces\ManagementUserInterface as ManagementUserInterface;
use App\Models\MasterUser;
// =============== end default use repository ===============


class ManagementUserRepository implements ManagementUserInterface
{

    public function getDataUsers()
    {
        $getData = MasterUser::all();
        return $getData;
    }

    public function getDataUsersById($id)
    {
        return MasterUser::where('id_master_users',$id)->first();
    }

    public function getCheckUserDouble($username, $email, $condition)
    {
       if ($condition == "") {
          return MasterUser::where('username',$username)->orWhere('email',$email)->first();
       } else {
          return MasterUser::where('id_master_users',$condition)->orWhere('username',$username)->orWhere('email',$email)->count();
       }
    }

    public function getDataUserJoinRoleById()
    {
      $getData = MasterUser::select('master_users.*', 'master_roles.role_name')
                         ->leftjoin('master_roles', 'master_users.role_id', '=', 'master_roles.id_master_roles')
                         ->where('master_users.id_master_users', Auth::user()->id_master_users)
                         ->first();
      return $getData;
    }

    public function getDataUsersPaging()
    {
        $getData = MasterUser::select('master_users.*', 'master_roles.role_name')
                        ->leftjoin('master_roles', 'master_users.role_id', '=', 'master_roles.id_master_roles')
                        ->orderby('master_users.username', 'asc')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15);
        return $getData;
    }

    public function getSearchDataUsersPaging($params)
    {
      $search = $params;
      $getData = MasterUser::select('master_users.*','master_roles.role_name')
                      ->leftjoin('master_roles', 'master_users.role_id', '=', 'master_roles.id_master_roles')
                      ->where(strtolower('master_users.username'),'like',strtolower("%".$search."%"))
                      ->orWhere(strtolower('master_users.fullname'), 'like', strtolower("%".$search."%"))
                      ->orderby('master_users.username', 'asc')
                      ->orderBy('created_at', 'DESC')
                      ->paginate(15);

      return $getData;
    }

    public function store($attributes)
    {
        DB::transaction(function() use($attributes,&$result) {
           $result = MasterUser::create($attributes);
        });
        return $result;
    }

    public function update($data, $id)
    {
        DB::transaction(function() use($data,$id,&$record) {
           $record =  MasterUser::where('id_master_users',$id)->update($data);
        });
        return $record;
    }

}
