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

use App\Services\IsAdmin\LogActivitiesService;

// =============== end default use controller ===============

class LogActivitiesController extends Controller
{
    private $logActivitiesService;

    public function __construct()
    {
        $this->logActivitiesService =  app(LogActivitiesService::class);
    }

    private $routeView = 'logs/';

    public function index()
    {
          return view($this->routeView.'indexLogActivities');
    }

    public function getDataForDataTable()
    {
        $getDataLogActivities = $this->logActivitiesService->getDataLogActivities();
        return $getDataLogActivities;
    }
}
