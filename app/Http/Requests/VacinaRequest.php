<?php

namespace App\Http\Requests;

class VacinaRequest extends AbstractRequest
{

    public function rules()
    {
        return [
            'imunobiologico' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'lote' => 'required|string|max:255',
            'data_validade' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'numero_doses' => 'required|integer|min:1',
            'intervalo_minimo' => 'required|integer|min:1'
        ];
    }
    public function messages()
    {
        return [
            'data_validade.after_or_equal' => 'O campo data validade deve ser uma data posterior ou igual a hoje.'
        ];
    }
}
