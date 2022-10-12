<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;
    protected $fillable = [
        'tiempo_por_paciente', 'estado'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
