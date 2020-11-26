<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * summary
 */
class MyModel extends Model
{
    /**
     * summary
     */
   use SoftDeletes;
}