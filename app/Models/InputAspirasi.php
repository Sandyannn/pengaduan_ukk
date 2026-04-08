<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $fillable = [
        'kategori_id',
        'user_id',
        'status',
        'lokasi',
        'keterangan',
        'tg_input',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'input_aspirasis_id');
    }
}
