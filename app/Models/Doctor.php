<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres', 'apellidos', 'edad', 'genero', 'direccion', 'oficina_id','estado'
    ];

    public function oficinas()
    {
        return $this->hasOne(Oficina::class);
    }

}
