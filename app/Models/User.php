<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nisn',
        'roles',
        'photo',
        'password_sementara',
        'photo',
        'gelombang_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaction::class);
    }

    public function attact()
    {
        return $this->hasOne(Attachments::class);
    }

    public function biodata()
    {
        return $this->hasOne(Biodata::class);
    }

    public function lulusan()
    {
        return $this->hasOne(Lulusan::class);
    }

    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class);
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class);
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class);
    }

    public function rencana()
    {
        return $this->hasOne(Rencana::class);
    }

    public function pemilikkartu()
    {
        return $this->hasOne(PemilikKartu::class);
    }

    public function gelombang()
    {
        return $this->hasOne(Gelombang::class, 'id', 'gelombang_id');
    }
}
