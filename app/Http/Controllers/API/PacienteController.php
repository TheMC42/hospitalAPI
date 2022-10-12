<?php

namespace App\Http\Controllers\API;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Support\Facades\Validator;

class PacienteController extends BaseController
{
    public function index()
    {

        $pacientes = Paciente::all();
        return response()->json([
            "success" => true,
            "data" => $pacientes
        ]);
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);

        if (is_null($paciente)) {
            return $this->sendError('Paciente not found.');
        }

        return $this->sendResponse($paciente, 'Paciente retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nombres' => 'required',
            'apellidos' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $paciente = Paciente::create($input);
        return response()->json([
            "success" => true,
            "data" => $paciente
        ]);
    }

    public function update(Request $request, Paciente $paciente)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nombres' => 'required',
            'apellidos' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $paciente->nombres = $input['nombres'];
        $paciente->apellidos = $input['apellidos'];
        $paciente->save();

        return $this->sendResponse($paciente, 'Paciente updated successfully.');
    }
}
