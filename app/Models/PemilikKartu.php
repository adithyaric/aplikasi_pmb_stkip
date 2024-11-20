<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikKartu extends Model
{
    use HasFactory;

    protected $table = 'pemilikkartu';

    protected $guarded = ['id'];
}
