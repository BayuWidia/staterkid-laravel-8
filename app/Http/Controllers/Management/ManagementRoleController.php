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
use App\Http\Requests\Management\ManagementRoleRequest;
use Ramsey\Uuid\Uuid;

use App\Services\Management\ManagementRoleService;
use App\Services\Management\ManagementMenuService;

// =============== end default use controller ===============


class ManagementRoleController extends Controller
{
    public function __construct()
    {
        $this->managementRoleService = app(ManagementRoleService::class);;
        $this->managementMenuService  = app(ManagementMenuService::class);;
    }

    private $routeView = 'Management/ManagementRole/';

    public function index()
    {
        $getDataAllRoleMenu = $this->managementRoleService->getDataAllRoleMenu();
        return view($this->routeView . 'indexManagementRole', compact('getDataAllRoleMenu'));
    }

    public function getDataAllRole()
    {
        $datas = $this->managementRoleService->getCustomManagementRole();
        return response()->json(["data"=>$datas]);
    }


    public function edit($id)
    {
        $data = $this->managementRoleService->getDataById($id);
        return response()->json(["info"=>"suksess","data"=>$data]);
    }

    public function store(ManagementRoleRequest $params)
    {
        $process = $this->managementRoleService->store($params);
        return response()->json(["status"=>"success","message"=>"Role Berhasil Ditambahkan"]);
    }

    public function update(ManagementRoleRequest $params)
    {
        $data = $this->managementRoleService->update($params);
        return response()->json(["status"=>"success","message"=>"Role Berhasil Di Update"]);
    }

    public function updateStatus(Request $params)
    {
        $this->managementRoleService->updateStatus($params);
        return response()->json(["status"=>"success","message"=>"Role Status Berhasil Di Update"]);
    }

    public function getDataAllRoleMenuById($id)
    {
        $dataById = $this->managementRoleService->getDataAllRoleMenuById($id);
        return response()->json(["MenuChecked"=>$dataById]);
    }

    public function delInsAccess(Request $params)
    {
      // dd($params);
      $data = $this->managementRoleService->delInsAccess($params);
      return redirect()->route('managementrole.index')->with('message', 'Data tersebut telah diubah.');
    }

    public function destroy($id)
    {
       $result = $this->managementRoleService->destroy($id);
       return redirect()->route($this->route . 'index')->with('success', 'Berhasil');
    }
}
