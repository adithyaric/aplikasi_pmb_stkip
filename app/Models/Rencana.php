<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rencana extends Model
{
    use SoftDeletes;

    protected $table = 'rencana';

    protected $guarded = ['id'];
}
