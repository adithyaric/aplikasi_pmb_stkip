<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penerimaan extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'jalur_penerimaan';

    public function persyaratan()
    {
        return $this->belongsToMany(Persyaratan::class, 'penerimaan_persyaratan');
    }

    public function gelombang()
    {
        return $this->belongsToMany(Gelombang::class, 'gelombang_penerimaan');
    }
}
