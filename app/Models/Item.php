<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table='item';
    protected $fillable=['nama','serial_number','status','type','jenis','owner','supplier_id','stok'];
}
