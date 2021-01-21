<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Repositories\IsAdmin\Logs;

// =============== start default use repository ===============
use Auth;
use DB;

use App\Repositories\IsAdmin\Logs\Interfaces\LogActivitiesInterface as LogActivitiesInterface;
use App\Models\MasterAccessLog;
// =============== end default use repository ===============


class LogActivitiesRepository implements LogActivitiesInterface
{

    public function getDataLogActivities()
    {
        $getData = MasterAccessLog::get();
        return $getData;
    }


}
