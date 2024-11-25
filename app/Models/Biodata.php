<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biodata extends Model
{
    use SoftDeletes;

    protected $table = 'biodata';

    protected $guarded = ['id'];
}
