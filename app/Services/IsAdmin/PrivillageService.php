<?php

namespace App\Services\IsAdmin;

use Auth;
use App\Repositories\IsAdmin\Privillage\Interfaces\PrivillageInterface;

class PrivillageService
{

    public function getPrivillage()
    {
        $privillageInterface = app(PrivillageInterface::class);
        $result = $privillageInterface->getPrivillage();

        return $result;
    }

}
