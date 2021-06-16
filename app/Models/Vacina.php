<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    use HasFactory;

    protected $table = 'vacinas';
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['doses'];
    protected $fillable = [
        'imunobiologico',
        'fabricante',
        'lote',
        'data_validade',
        'numero_doses',
        'intervalo_minimo'
    ];

    public function doses()
    {
        return $this->hasMany(Dose::class);
    }

    protected function getDosesAttribute()
    {
        return $this->doses()->get();
    }

}
