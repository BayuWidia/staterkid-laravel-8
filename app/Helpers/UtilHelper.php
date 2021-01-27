<?php

namespace App\Helpers;

class UtilHelper
{

    public static function nameSpaceRouting($params){
        $return = 'App\Http\Controllers\\'.$params;
        return $return;
    }

}
