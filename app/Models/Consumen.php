<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consumen extends Model
{
    use HasFactory;

    protected $table='consumen';
    protected $dates = ['tgl_lahir'];
    protected $fillable = ['nama', 'no_hp', 'jk', 'tgl_lahir', 'tmpt_lahir', 'alamat'];

    public function instalasi(): HasMany
    {
        return $this->hasMany(Instalasi::class);
    }
}
