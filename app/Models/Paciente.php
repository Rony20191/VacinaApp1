<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function vacinas()
    {
        return $this->belongsToMany(Vacina::class, 'paciente_vacinas', 'paciente_id', 'vacina_id')->withPivot('data_vacinacao', 'dose_id');
    }
}
