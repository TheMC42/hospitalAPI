<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitaMedicasResource;
use App\Models\CitaMedica;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class CitaMedicaController extends BaseController
{
    public function index(Request $request)
    {
        return CitaMedicasResource::collection(
            CitaMedica::with('paciente')->get()
        );
    }

    public function show(CitaMedica $citaMedica)
    {
//        $cita = CitaMedica::find($id);
//
//        if (is_null($cita)) {
//            return $this->sendError('Cita not found.');
//        }
//
//        return $this->sendResponse($cita, 'Cita retrieved successfully.');

        return new CitaMedicasResource($citaMedica);
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
