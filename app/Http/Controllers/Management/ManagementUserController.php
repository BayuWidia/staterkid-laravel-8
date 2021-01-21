<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Http\Controllers\Management;

// =============== start default use controller ===============
use Auth;
use DB;
use Validator;
use Hash;
use Image;
use Alert;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Management\LockRequest;
use App\Http\Requests\Management\ManagementUserRequest;
use App\Http\Requests\Management\ManagementUserPasswordRequest;

use App\Services\IsAdmin\ConcatenateService as ConcatenateService;
use App\Services\Management\ManagementUserService as ManagementUserService;
use App\Services\Management\ManagementRoleService as ManagementRoleService;

// =============== end default use controller ===============

class ManagementUserController extends Controller
{
    private $concatenateService;
    private $managementUserService;
    private $managementRoleService;

    public function __construct(ConcatenateService $concatenateService, ManagementUserService $managementUserService, ManagementRoleService $managementRoleService)
    {
        $this->concatenateService = $concatenateService;
        $this->managementUserService = $managementUserService;
        $this->managementRoleService = $managementRoleService;
    }

    private $routeView = 'Management/ManagementUser/';

    public function index()
    {
          $getDataUsersPaging = $this->managementUserService->getDataUsersPaging();
          $getDataRole = $this->managementRoleService->getCustomManagementRole();
          return view($this->routeView.'indexManagementUser', compact('getDataUsersPaging','getDataRole'));
    }

    public function search(Request $request)
  	{
  		    $search = $request->search;
          $getDataUsersPaging = $this->managementUserService->getSearchDataUsersPaging($search);
          $getDataRole = $this->managementRoleService->getCustomManagementRole();
  		    return view($this->routeView.'indexManagementUser', compact('getDataUsersPaging','getDataRole'));
  	}

    public function store(ManagementUserRequest $request)
    {
          $condition ="";
          $checkDoubleUser  = $this->managementUserService->getCheckUserDouble($request->username, $request->email, $condition);
          if ($checkDoubleUser != null) {
            return redirect()->route('managementuser.index')->with('messagefail', 'Username atau Email tersebut sudah tersedia.');

          } else {
            $process = $this->managementUserService->store($request);
            return redirect()->route('managementuser.index')->with('message', 'Data tersebut telah ditambahkan.');
         }
    }

    public function update(ManagementUserRequest $request)
    {
          $condition = $request->idMasterUsersEdit;
          $checkDoubleUser  = $this->managementUserService->getCheckUserDouble($request->usernameEdit, $request->emailEdit, $condition);
          if ($checkDoubleUser > 1) {
            return redirect()->route('managementuser.index')->with('messagefail', 'Username atau Email tersebut sudah tersedia.');

          } else {
            $process = $this->managementUserService->update($request);
            return redirect()->route('managementuser.index')->with('message', 'Data tersebut telah diubah.');
         }

    }

    public function updateStatus($id, $condition)
    {
          $this->managementUserService->updateStatus($id, $condition);
          return redirect()->route('managementuser.index')->with('message', 'Data tersebut telah diubah.');
    }

    public function updPassword(ManagementUserPasswordRequest $request)
    {
        $process = $this->managementUserService->updPassword($request);
        return redirect()->route('managementuser.index')->with('message', 'Data tersebut telah diubah Password.');
    }

    public function bind($id)
    {
        $get = $this->managementUserService->getDataUsersById($id);
        return $get;
    }

    public function profile()
    {
        $getData = $this->managementUserService->getDataUserJoinRoleById();
          return view($this->routeView.'profileUser', compact('getData'));
    }

    public function updatepasswordByUser(ManagementUserPasswordRequest $request)
    {
      // dd($request->all());
      if($request->password != $request->passwordConfirmation) {
        return redirect()->route('managementuser.profile')->with('messagefail', 'Password dan Konfirmasi tidak valid.');
      }

      $get = $this->managementUserService->getDataUsersById($request->id);
      if(Hash::check($request->oldPassword, $get->password)) {
        $get = $this->managementRoleService->updatepasswordByUser($request->id);
        return redirect()->route('managementuser.profile')->with('message', 'Data tersebut telah diubah.');
      } else {
        return redirect()->route('managementuser.profile')->with('messagefail', 'Password lama tidak valid.');
      }
    }

    public function lockscreen(LockRequest $request)
    {
        $get = $this->concatenateService->getUserById(Auth::user()->id_master_users);
        if(Hash::check($request->password, $get[0]->password)) {
          return redirect()->route('dashboard');
        } else {
          return redirect()->route('login.index')->with('failedLogin', 'Periksa Kembali Password Anda.')->withInput();
        }
    }

}
