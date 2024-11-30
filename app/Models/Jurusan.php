<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'jurusan';

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function user()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function gelombang()
    {
        return $this->belongsToMany(Gelombang::class, 'gelombang_jurusan');
    }
}
