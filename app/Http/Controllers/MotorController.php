<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MotorRepository;
use App\Http\Resources\MotorResource;

class MotorController extends Controller
{
    protected $motorRepository;

    public function __construct(MotorRepository $motorRepository)
    {
        $this->motorRepository = $motorRepository;
    }

    public function index()
    {
        $motors = $this->motorRepository->getAll();
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $motors;
        return response()->json($data);
    }

    public function show($id)
    {
       
        $motor = $this->motorRepository->getById($id);
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $motor;
       
        return response()->json($data);
    }

    public function store(Request $request)
    {
           
        $validator = \Validator::make($request->all(), [
            'kendaraan_id' => 'required|string',
            'mesin' => 'required',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required'
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'insert failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }

      
        $motor = $this->motorRepository->create($request->all());
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $motor;
        return response()->json($data);
        // return new MotorResource($motor);
    }

    public function update(Request $request, $id)
    {
        
        $validator = \Validator::make($request->all(), [
            'kendaraan_id' => 'required|string',
            'mesin' => 'required',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required'
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'update failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }

        
        $motor = $this->motorRepository->update($id, $request->all());
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $motor;
        return response()->json($data);
        // return new MotorResource($motor);
    }

    public function destroy($id)
    {

        $this->motorRepository->delete($id);
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false; 
        return response()->json($data);
    }
}
