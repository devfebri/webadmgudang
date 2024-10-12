<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;
    protected $table='teknisi';
    protected $fillable=['nama','no_hp','jk','tgl_lahir','tmpt_lahir','alamat'];
    protected $dates=['tgl_lahir'];
}
