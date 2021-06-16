<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroVacinacao extends Model
{
    use HasFactory;

    protected $table = "paciente_vacinas";
    protected $fillable = [
        "data_vacinacao",
        "vacina_id",
        "paciente_id",
        "dose_id",
        "reincidencia"
    ];
}
