<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penerimaan extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'jalur_penerimaan';
}
