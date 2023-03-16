<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\MobilRepository;
use App\Http\Controllers\MobilController;
use App\Models\Mobil;
use Illuminate\Support\Facades\Log;

class MobilControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);
    
        $Mobil1 = $MobilRepository->create([
            'kendaraan_id' => 2,
            'mesin' => '250cc',
            'kapasitas_penumpang' => 6,
            'tipe' => 'Tipe A'
        ]);
        $Mobil2 = $MobilRepository->create([
            'kendaraan_id' => 2,
            'mesin' => '250cc',
            'kapasitas_penumpang' => 6,
            'tipe' => 'Tipe A'
        ]);

        $controller = new MobilController($MobilRepository);

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
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);
        $Mobil = $MobilRepository->create([
            'kendaraan_id' => 2,
            'mesin' => '250cc',
            'kapasitas_penumpang' => 6,
            'tipe' => 'Tipe A'
        ]);

        $controller = new MobilController($MobilRepository);

        
        $response = $controller->show($Mobil->id);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStoreWithValidData()
    {
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);

        $controller = new MobilController($MobilRepository);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 2,
            'mesin' => '250cc',
            'kapasitas_penumpang' => 6,
            'tipe' => 'Tipe A'
        ]);

        $response = $controller->store($request);
       
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStoreWithInvalidData()
    {
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);

        $controller = new MobilController($MobilRepository);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => '',
            'mesin' => '',
            'kapasitas_penumpang' => '',
            'tipe' => ''
        ]);

        $response = $controller->store($request);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUpdateWithValidData()
    {
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);

        $controller = new MobilController($MobilRepository);

        // create a Mobil and get its id
        $Mobil->kendaraan_id = 1;
        $Mobil->mesin = '150cc';
        $Mobil->kapasitas_penumpang = 4;
        $Mobil->tipe = 'Tipe B';
        
        $Mobil->save();
        $id = $Mobil->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 2,
            'mesin' => '250cc',
            'kapasitas_penumpang' => 6,
            'tipe' => 'Tipe A'
        ]);

        $response = $controller->update($request, $id);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUpdateWithInvalidData()
    {
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);

        $controller = new MobilController($MobilRepository);

        // create a Mobil and get its id
        $Mobil->kendaraan_id = 1;
        $Mobil->mesin = '150cc';
        $Mobil->kapasitas_penumpang = 4;
        $Mobil->tipe = 'Tipe B';
        $Mobil->save();
        $id = $Mobil->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => '',
            'mesin' => ' ',
            'kapasitas_penumpang' => '',
            'tipe' => ''
        ]);

        $response = $controller->update($request, $id);

        $this->assertSame(200, $response->getStatusCode());

    }

    public function testDestroy()
    {
        $Mobil = new Mobil();
        $MobilRepository = new MobilRepository($Mobil);

        $controller = new MobilController($MobilRepository);

        $Mobil->kendaraan_id = 1;
        $Mobil->mesin = '150cc';
        $Mobil->kapasitas_penumpang = 4;
        $Mobil->tipe = 'Tipe B';
        $Mobil->save();
        $id = $Mobil->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => '',
            'mesin' => ' ',
            'kapasitas_penumpang' => '',
            'tipe' => ''
        ]);

        $response = $controller->destroy($Mobil->id);

        $this->assertSame(200, $response->getStatusCode());
    }
}
