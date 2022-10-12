<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class CitaMedicaController extends BaseController
{
    public function index(Request $request)
    {
        $term = $request->paciente_id ?? null;

        $citas_medicas
            = CitaMedica::paginate(10);

        if ($term == null) {
            return response()->json([
                "success" => true,
                "data" => $citas_medicas
            ]);
        }
        return response()->json([
            "success" => true,
            "data" => $citas_medicas->where('paciente_id', $term)
        ]);


    }

    public function show($id)
    {
        $cita = CitaMedica::find($id);

        if (is_null($cita)) {
            return $this->sendError('Cita not found.');
        }

        return $this->sendResponse($cita, 'Cita retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'paciente_id' => 'required',
            'doctor_id' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $cita = CitaMedica::create($input);
        return response()->json([
            "success" => true,
            "data" => $cita
        ]);
    }

    public function update(Request $request, CitaMedica $cita)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'estado' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $cita->estado = $input['estado'];
        $cita->save();

        return $this->sendResponse($cita, 'Cita updated successfully.');
    }
}
