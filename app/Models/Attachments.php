<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachments extends Model
{
    use SoftDeletes;

    protected $table = 'attachment';

    protected $guarded = ['id'];

    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class, 'id', 'penerimaan_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id', 'penerimaan_id');
    }
}
