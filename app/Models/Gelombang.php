<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gelombang extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }
}
