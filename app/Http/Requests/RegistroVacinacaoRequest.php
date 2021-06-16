<?php

namespace App\Http\Requests;


class RegistroVacinacaoRequest extends AbstractRequest
{

    public function rules()
    {

        return [
            'data_vacinacao' => 'required|date|date_format:Y-m-d|before_or_equal:today',
            'vacina_id'      => 'required|exists:vacinas,id',
            'paciente_id'    => 'required|exists:pacientes,id',
            'dose_id'        => 'required|exists:doses,id',
            'reincidencia'   => 'required|boolean'
        ];
    }
    public function messages()
    {
        return [
            'data_vacinacao.before_or_equal' => 'O campo data vacinacao deve ser uma data anterior ou igual a hoje.'
        ];
    }
}
