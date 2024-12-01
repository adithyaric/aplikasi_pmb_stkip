<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function gelombang()
    {
        return $this->belongsToMany(Gelombang::class, 'gelombang_kelas');
    }
}
