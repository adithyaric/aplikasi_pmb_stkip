<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;

    protected $table = "attachment";
    protected $guarded = ["id"];

    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class,'id','penerimaan_id');
    }
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class,'id','penerimaan_id');
    }
}
