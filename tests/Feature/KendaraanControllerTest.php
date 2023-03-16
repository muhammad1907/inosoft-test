<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\KendaraanRepository;
use App\Http\Controllers\KendaraanController;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Log;



class KendaraanControllerTest extends TestCase
{
    public function testIndex()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);
    
        $kendaraan1 = $kendaraanRepository->create([
            'tahun_keluaran' => 2021,
            'harga' => 10000000,
            'warna' => 'merah',
        ]);
        $kendaraan2 = $kendaraanRepository->create([
            'tahun_keluaran' => 2022,
            'harga' => 20000000,
            'warna' => 'biru',
        ]);

        $controller = new KendaraanController($kendaraanRepository);

        $response = $controller->index();

        $this->assertSame(200, $response->getStatusCode());
    }

    // /**
    //  * Test show method.
    //  *
    //  * @return void
    //  */
    public function testShow()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);
        $kendaraan = $kendaraanRepository->create([
            'tahun_keluaran' => 2021,
            'harga' => 10000000,
            'warna' => 'merah',
        ]);

        $controller = new KendaraanController($kendaraanRepository);

        
        $response = $controller->show($kendaraan->id);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStoreWithValidData()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);

        $controller = new KendaraanController($kendaraanRepository);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'tahun_keluaran' => 2021,
            'harga' => 10000000,
            'warna' => 'merah',
        ]);

        $response = $controller->store($request);
       
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStoreWithInvalidData()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);

        $controller = new KendaraanController($kendaraanRepository);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'tahun_keluaran' => '',
            'harga' => '',
            'warna' => '',
        ]);

        $response = $controller->store($request);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUpdateWithValidData()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);

        $controller = new KendaraanController($kendaraanRepository);

        // create a kendaraan and get its id
        $kendaraan->tahun_keluaran = 2021;
        $kendaraan->harga = 10000000;
        $kendaraan->warna = 'merah';
        $kendaraan->save();
        $id = $kendaraan->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'tahun_keluaran' => 2022,
            'harga' => 12000000,
            'warna' => 'biru',
        ]);

        $response = $controller->update($request, $id);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUpdateWithInvalidData()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);

        $controller = new KendaraanController($kendaraanRepository);

        // create a kendaraan and get its id
        $kendaraan->tahun_keluaran = 2021;
        $kendaraan->harga = 10000000;
        $kendaraan->warna = 'merah';
        $kendaraan->save();
        $id = $kendaraan->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'tahun_keluaran' => 'invalid',
            'harga' => 'invalid',
            'warna' => '',
        ]);

        $response = $controller->update($request, $id);

        $this->assertSame(200, $response->getStatusCode());

    }

    public function testDestroy()
    {
        $kendaraan = new Kendaraan();
        $kendaraanRepository = new KendaraanRepository($kendaraan);

        $controller = new KendaraanController($kendaraanRepository);

        $kendaraan->tahun_keluaran = 2021;
        $kendaraan->harga = 10000000;
        $kendaraan->warna = 'merah';
        $kendaraan->save();
        $id = $kendaraan->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'tahun_keluaran' => 'invalid',
            'harga' => 'invalid',
            'warna' => '',
        ]);

        $response = $controller->destroy($kendaraan->id);

        $this->assertSame(200, $response->getStatusCode());
    }
}
