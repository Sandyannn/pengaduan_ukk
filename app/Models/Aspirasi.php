<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $fillable = [
        'input_aspirasis_id',
        'user_id',
        'feedback',
        'tg_feedback'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function input_aspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'input_aspirasis_id');
    }
}
