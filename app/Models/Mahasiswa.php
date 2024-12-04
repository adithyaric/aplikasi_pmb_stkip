<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;

    protected $table = 'mahasiswa';

    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id', 'jurusan_id');
    }

    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class, 'id', 'penerimaan_id');
    }

    public function gelombang()
    {
        return $this->hasOne(Gelombang::class, 'id', 'gelombang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
