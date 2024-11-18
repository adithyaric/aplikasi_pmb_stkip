<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rencana extends Model
{
     use HasFactory;

    protected $table = "rencana";
    protected $guarded = ["id"];
}
