<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Models;

// =============== start default use model ===============
use Illuminate\Database\Eloquent\Model;
// =============== start default use model ===============

class MasterMenusThird extends Model
{

    /**
     * Define table name.
     */
    protected $table = "master_menus_third";

    protected $guarded = [];

    /**
     * autoincrement or sequence die.
     *
     * @return bool
     */
    public $incrementing = false;
}
