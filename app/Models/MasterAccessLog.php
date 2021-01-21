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

class MasterAccessLog extends Model
{

    /**
     * Define table name.
     */
    protected $table = "master_access_logs";

    protected $guarded = [];

    /**
     * autoincrement or sequence die.
     *
     * @return bool
     */
    public $incrementing = false;
}
