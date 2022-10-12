<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosticoController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->paciente_id ?? null;
        $data = Diagnostico::paginate(10);

        if ($term == null) {
            return response()->json([
                "success" => true,
                "data" => $data
            ]);
        }
        return response()->json([
            "success" => true,
            "data" => $data->where('paciente_id', $term)
        ]);
    }

    public function show($id)
    {
        $data = Diagnostico::find($id);

        if (is_null($data)) {
            return $this->sendError('Diagnostico not found.');
        }

        return $this->sendResponse($data, 'Diagnostico retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'descripcion' => 'required',
            'paciente_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $data = Diagnostico::create($input);
        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }

    public function update(Request $request, Diagnostico $data)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'descripcion' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data->descripcion = $input['descripcion'];
        $data->save();

        return $this->sendResponse($data, 'Paciente updated successfully.');
    }
}
