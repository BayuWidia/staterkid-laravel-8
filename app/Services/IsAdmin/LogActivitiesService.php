<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Services\IsAdmin;

// =============== start default use service ===============
use Auth;
use Image;
use Hash;
use Ramsey\Uuid\Uuid;

use DataTables;
use Carbon\Carbon;

use App\Repositories\IsAdmin\Logs\Interfaces\LogActivitiesInterface as LogActivitiesInterface;
// =============== end default use service ===============


class LogActivitiesService
{
    private $logActivitiesInterface;

    public function __construct(LogActivitiesInterface $logActivitiesInterface)
    {
        $this->logActivitiesInterface = $logActivitiesInterface;
    }

    public function getDataLogActivities()
    {
      $result = $this->logActivitiesInterface->getDataLogActivities();

      return DataTables::of($result)->removeColumn('id')->make();
    }

}
