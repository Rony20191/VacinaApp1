<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dose extends Model
{
    use HasFactory;

    protected $table = 'doses';
    protected $fillable = [
        'nome',
        'vacina_id'
    ];
    protected $hidden = ['created_at', 'updated_at', 'vacina_id'];
}
