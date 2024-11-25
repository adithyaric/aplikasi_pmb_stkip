<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemilikKartu extends Model
{
    use SoftDeletes;

    protected $table = 'pemilikkartu';

    protected $guarded = ['id'];
}
