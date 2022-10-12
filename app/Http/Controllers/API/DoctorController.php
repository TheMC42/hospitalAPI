<?php

namespace App\Http\Controllers\API;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Support\Facades\Validator;

class DoctorController extends BaseController
{
    public function index()
    {
        $doctores = Doctor::paginate(10);
        return response()->json([
            "success" => true,
            "data" => $doctores
        ]);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (is_null($doctor)) {
            return $this->sendError('Doctor not found.');
        }

        return $this->sendResponse($doctor, 'Doctor retrieved successfully.');
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
        $doctor = Doctor::create($input);
        return response()->json([
            "success" => true,
            "data" => $doctor
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nombres' => 'required',
            'apellidos' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $doctor->nombres = $input['nombres'];
        $doctor->apellidos = $input['apellidos'];
        $doctor->save();

        return $this->sendResponse($doctor, 'Doctor updated successfully.');
    }
}
