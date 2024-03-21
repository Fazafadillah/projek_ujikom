<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menu";
    protected $guarded = ["id"];
    protected $fillable = ["jenis_id", "name", "harga", "stok", "image",  "deskripsi"];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    // public function stok()
    // {
    //     return $this->hasMany(Stok::class, 'menu_id', 'id');
    // }
}
