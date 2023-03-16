<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MobilResource;
use App\Repositories\MobilRepository;

class MobilController extends Controller
{
    private $mobilRepository;

    public function __construct(MobilRepository $mobilRepository)
    {
        $this->mobilRepository = $mobilRepository;
    }

    public function index()
    {
        $mobils = $this->mobilRepository->getAll();
       
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $mobils;
        return response()->json($data);
    }

    public function show(string $id)
    {
        $mobil = $this->mobilRepository->getById($id);
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $mobil;
        return response()->json($data);
    }

    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'kendaraan_id' => 'required|string',
            'mesin' => 'required|string|max:255',
            'kapasitas_penumpang' => 'required|integer',
            'tipe' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'insert failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }


       
        $mobil = $this->mobilRepository->create($request->all());
   

        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $mobil;
        return response()->json($data);
    }

    public function update(Request $request, string $id)
    {
        $validator = \Validator::make($request->all(), [
            'kendaraan_id' => 'required|string',
            'mesin' => 'required|string|max:255',
            'kapasitas_penumpang' => 'required|integer',
            'tipe' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'update failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }

        $mobil = $this->mobilRepository->update($id, $request->all());
        
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $mobil;
        return response()->json($data);
    }

    public function destroy(string $id)
    {
        $this->mobilRepository->delete($id);
        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        return response()->json($data);
    }
}
