<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'date_start',
        'date_end',
        'statuses',
    ];

    protected $casts = [
        'statuses' => 'array',
    ];

    public function gelombangs()
    {
        return $this->belongsToMany(Gelombang::class, 'gelombang_announcement');
    }
}
