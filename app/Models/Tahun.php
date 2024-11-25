<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahun extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function gelombang()
    {
        return $this->hasMany(Gelombang::class);
    }
}
