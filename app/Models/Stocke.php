<?php

namespace App\Models;

use App\Models\MyModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stocke extends MyModel
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
}
