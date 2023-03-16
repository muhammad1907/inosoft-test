<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PenjualanRepository;
use App\Models\Mobil;
use App\Models\Motor;
use App\Models\User;

class PenjualanController extends Controller
{
    public function __construct(PenjualanRepository $penjualanRepository)
    {
        $this->penjualanRepository= $penjualanRepository;
    }

    public function index()
    {
        $penjualan = $this->penjualanRepository->getAll();
        foreach ($penjualan as &$item) {
            $mobil = Mobil::where('_id', $item->mobil_motor_id)->get();
            $motor = Motor::where('_id', $item->mobil_motor_id)->get();
            $user = User::where('_id', $item->user_id)->first();
            $item->mobil = $mobil;
            $item->motor = $motor;
            $item->user = $user;
        }

        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $penjualan;
        return response()->json($data);
    }

    public function show($id)
    {
        $penjualan = $this->penjualanRepository->getById($id);

        
        $mobil = Mobil::where('_id', $penjualan->mobil_motor_id)->get();
        $motor = Motor::where('_id', $penjualan->mobil_motor_id)->get();
        $user = User::where('_id', $penjualan->user_id)->first();

        $penjualan->mobils = $mobil;
        $penjualan->motors = $motor;
        $penjualan->user = $user;


        $data['code'] = 200;
        $data['message'] = 'sucessfully retrieved';
        $data['errors'] = false;
        $data['data'] = $penjualan;
        return response()->json($data);
        
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|string',
            'mobil_motor_id' => 'required|string',
            'jenis_kendaraan' => 'required|string',
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'insert failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }

        $data_penjualan = $request->all();
        
        $penjualan = $this->penjualanRepository->create($data_penjualan);

        $data['code'] = 200;
        $data['message'] = 'sucessfully create penjualan';
        $data['errors'] = false;

        return response()->json($data);
    }
}
