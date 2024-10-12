<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;

    protected $table='pimpinan';
    protected $dates = ['tgl_lahir'];
    protected $fillable = ['nama', 'no_hp', 'jk', 'tgl_lahir', 'tmpt_lahir', 'alamat'];
}
