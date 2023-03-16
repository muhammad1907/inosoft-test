<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KendaraanRepository;
use App\Models\Mobil;
use App\Models\Motor;

class KendaraanController extends Controller
{
    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function index()
    {
        $kendaraan = $this->kendaraanRepository->getAll();
        foreach ($kendaraan as &$item) {
            $mobil = Mobil::where('kendaraan_id', $item->id)->get();
            $motor = Motor::where('kendaraan_id', $item->id)->get();
            $item->mobil = $mobil;
            $item->motor = $motor;
        }

        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $kendaraan;
        return response()->json($data);
    }

    public function show($id)
    {
        $kendaraan = $this->kendaraanRepository->getById($id);

        
        $mobil = Mobil::where('kendaraan_id', $id)->get();
        $motor = Motor::where('kendaraan_id', $id)->get();

        $kendaraan->mobils = $mobil;
        $kendaraan->motors = $motor;


        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $kendaraan;
        return response()->json($data);
        
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'tahun_keluaran' => 'required|integer',
            'harga' => 'required',
            'warna' => 'required|string',
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'insert failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }

        $data_kendaraan = $request->all();
        
        $kendaraan = $this->kendaraanRepository->create($data_kendaraan);

        $data['code'] = 200;
        $data['message'] = 'sucessfully create kendaraan';
        $data['errors'] = false;

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'tahun_keluaran' => 'required|integer',
            'harga' => 'required',
            'warna' => 'required|string',
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'update failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }

        $data_kendaraan = $request->all();
        $kendaraan = $this->kendaraanRepository->update($data_kendaraan, $id);
       
        $data['code'] = 200;
        $data['message'] = 'sucessfully update kendaraan';
        $data['errors'] = false;

        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->kendaraanRepository->delete($id);

        $data['code'] = 200;
        $data['message'] = 'sucessfully delete kendaraan';
        $data['errors'] = false;

        return response()->json($data);
 
    }
}
