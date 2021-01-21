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
// =============== end default use service ===============


class LogFilesService
{
      public function getDataLogFiles()
      {
          $getBreadcrumb = null;
          if (!file_exists(storage_path('logs'))) {
              return [];
          }

          $logFiles = \File::allFiles(storage_path('logs'));

          // Sort files by modified time DESC
          usort($logFiles, function ($a, $b) {
              return -1 * strcmp($a->getMTime(), $b->getMTime());
          });

          return $logFiles;
      }

      public function show($fileName)
      {
          if (file_exists(storage_path('logs/'.$fileName))) {
              $path = storage_path('logs/'.$fileName);

              return response()->file($path, ['content-type' => 'text/plain']);
          }

          return 'Invalid file name.';
      }

      public function download($fileName)
      {
          if (file_exists(storage_path('logs/'.$fileName))) {
              $path = storage_path('logs/'.$fileName);
              $downloadFileName = env('APP_ENV').'.'.$fileName;

              return response()->download($path, $downloadFileName);
          }

          return 'Invalid file name.';
      }

}
