<?php

namespace App\Http\Requests;


class PacienteRequest extends AbstractRequest
{

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:255',
            'cpf' => 'required|string|cpf|unique:pacientes,cpf',
            'data_nascimento' => 'required|date|date_format:Y-m-d|before_or_equal:today'
        ];
    }

    public function messages()
    {
        return [
            'data_nascimento.before_or_equal' => 'O campo data nascimento deve ser uma data anterior ou igual a hoje.'
        ];
    }
}
