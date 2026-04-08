<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['ket_kategori'];

    public function input_aspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'kategori_id');
    }
}