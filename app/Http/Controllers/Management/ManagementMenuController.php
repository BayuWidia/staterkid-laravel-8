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

use App\Services\Management\ManagementMenuService;

// =============== end default use controller ===============

class ManagementMenuController extends Controller
{
    public function __construct()
    {
        $this->managementMenuService = app(ManagementMenuService::class);
    }

    private $routeView = 'Management/ManagementMenu/';

    public function index()
    {
        $data = $this->managementMenuService->getDataMenus();
        return view($this->routeView.'indexManagementMenu', compact('data'));
    }

    public function store(Request $request)
    {
        $process = $this->managementMenuService->store($request);
        return redirect()->route('managementmenu.index')->with('message', 'Data tersebut telah ditambahkan.');
    }

    public function update(Request $request)
    {
        $process = $this->managementMenuService->update($request);
        return redirect()->route('managementmenu.index')->with('message', 'Data tersebut telah diubah.');
    }

    public function updateStatus($id, $condition, $level)
    {
        $this->managementMenuService->updateStatus($id, $condition, $level);
        return redirect()->route('managementmenu.index')->with('message', 'Data tersebut telah diubah.');
    }

    public function getDataMenusSecondByIdMasterMenus($id)
    {
        $data= $this->managementMenuService->getDataMenusSecondByIdMasterMenus($id);
        return $data;
    }

    public function getDataMenu($id, $level)
    {
        $data= $this->managementMenuService->getDataMenu($id, $level);
        return $data;
    }


}
