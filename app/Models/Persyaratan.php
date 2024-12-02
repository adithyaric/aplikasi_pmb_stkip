<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persyaratan extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'input_type'];

    public function penerimaan()
    {
        return $this->belongsToMany(Penerimaan::class, 'penerimaan_persyaratan');
    }
}
