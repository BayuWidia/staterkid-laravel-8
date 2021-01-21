<?php

namespace App\Services\IsAdmin;

use Auth;
use App\Repositories\IsAdmin\Privillage\Interfaces\PrivillageInterface as PrivillageInterface;

class PrivillageService
{

    private $privillageInterface;

    public function __construct(PrivillageInterface $privillageInterface)
    {
        $this->privillageInterface = $privillageInterface;
    }

    public function getPrivillage()
    {
        $result = $this->privillageInterface->getPrivillage();

        return $result; 
    }

}
