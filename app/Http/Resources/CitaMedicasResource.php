<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CitaMedicasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>(string)$this->id,
            'estado'=>(boolean)$this->estado,
            'paciente'=> [
               'nombres'=> (string)$this->paciente->nombres,
               'apellidos'=> (string)$this->paciente->apellidos,
               'edad'=> (string)$this->paciente->edad
            ],
            'doctor'=> [
                'nombres'=> (string)$this->doctor->nombres,
                'apellidos'=> (string)$this->doctor->apellidos,
            ],
            'createdAt'=>$this->created_at->format('d/m/Y'),
            'updatedAt'=>$this->updated_at->format('d/m/Y'),
        ];
    }
}
