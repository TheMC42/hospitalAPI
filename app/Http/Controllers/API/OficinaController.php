<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Oficina;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OficinaController extends BaseController
{
    public function index()
    {
        $oficinas = Oficina::paginate(10);
        return response()->json([
            "success" => true,
            "data" => $oficinas
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tiempo_por_paciente' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $oficina = Oficina::create($input);
        return response()->json([
            "success" => true,
            "data" => $oficina
        ]);
    }
}
