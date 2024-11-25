<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lulusan extends Model
{
    use SoftDeletes;

    protected $table = 'lulusan';

    protected $guarded = ['id'];
}
