<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Http\Controllers\IsAdmin;

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

use App\Services\IsAdmin\LogFilesService;

// =============== end default use controller ===============

class LogFilesController extends Controller
{
    public function __construct()
    {
        $this->logFilesService = app(LogFilesService::class);
    }

    private $routeView = 'logs/';

    public function index()
    {
        $getDataLogFiles = $this->logFilesService->getDataLogFiles();
        return view($this->routeView.'indexLogFiles', compact('getDataLogFiles'));
    }

    public function show($fileName)
    {
        $show = $this->logFilesService->show($fileName);
        return $show;
    }

    public function download($fileName)
    {
        $download = $this->logFilesService->download($fileName);
        return $download;
    }
}
