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

use App\Services\Management\ManagementUserService;
use App\Services\Management\ManagementRoleService;

// =============== end default use controller ===============

class ManagementUserController extends Controller
{
    public function __construct()
    {
        $this->managementUserService = app(ManagementUserService::class);
        $this->managementRoleService = app(ManagementRoleService::class);
    }

    private $routeView = 'Management/ManagementUser/';
    private $routeViewProfile = 'profile/';

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
        return view($this->routeViewProfile.'indexProfile');
    }

    public function updatepasswordByUser(ManagementUserPasswordRequest $request)
    {
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
