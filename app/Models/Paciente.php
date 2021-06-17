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
    protected $appends = ['iniciais'];
    protected $hidden = ['created_at', 'updated_at'];

    public function vacinas()
    {
        return $this->belongsToMany(Vacina::class, 'paciente_vacinas', 'paciente_id', 'vacina_id')->withPivot('data_vacinacao', 'dose_id');
    }
    protected function getIniciaisAttribute()
    {
        return $this->iniciais();
    }
    protected function iniciais(){
        $nomeAux = [];
        $nomes = explode(" ", $this->getAttribute('nome'));
        if(!empty($nomes)){
            foreach ($nomes as $nome){
                array_push($nomeAux,ucfirst($nome[0]));
            }
        }

        return  implode('.',$nomeAux);
    }

}
