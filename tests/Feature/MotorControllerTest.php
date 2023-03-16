<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\MotorRepository;
use App\Http\Controllers\MotorController;
use App\Models\Motor;
use Illuminate\Support\Facades\Log;

class MotorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);
    
        $Motor1 = $MotorRepository->create([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);
        $Motor2 = $MotorRepository->create([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $controller = new MotorController($MotorRepository);

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
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);
        $Motor = $MotorRepository->create([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $controller = new MotorController($MotorRepository);

        
        $response = $controller->show($Motor->id);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStoreWithValidData()
    {
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);

        $controller = new MotorController($MotorRepository);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $response = $controller->store($request);
       
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStoreWithInvalidData()
    {
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);

        $controller = new MotorController($MotorRepository);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $response = $controller->store($request);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUpdateWithValidData()
    {
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);

        $controller = new MotorController($MotorRepository);

        // create a Motor and get its id
        $Motor->kendaraan_id = 1;
        $Motor->mesin = '150cc';
        $Motor->tipe_suspensi= 'apa saja';
        $Motor->tipe_transmisi = 'Tipe B';
        
        $Motor->save();
        $id = $Motor->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $response = $controller->update($request, $id);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUpdateWithInvalidData()
    {
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);

        $controller = new MotorController($MotorRepository);

        // create a Motor and get its id
        $Motor->kendaraan_id = 1;
        $Motor->mesin = '150cc';
        $Motor->tipe_suspensi= 'apa saja';
        $Motor->tipe_transmisi = 'Tipe B';
        $Motor->save();
        $id = $Motor->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $response = $controller->update($request, $id);

        $this->assertSame(200, $response->getStatusCode());

    }

    public function testDestroy()
    {
        $Motor = new Motor();
        $MotorRepository = new MotorRepository($Motor);

        $controller = new MotorController($MotorRepository);

        $Motor->kendaraan_id = 1;
        $Motor->mesin = '150cc';
        $Motor->tipe_suspensi= 'apa saja';
        $Motor->tipe_transmisi = 'Tipe B';
        $Motor->save();
        $id = $Motor->id;

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'kendaraan_id' => 3,
            'mesin' => '150cc',
            'tipe_suspensi' => 'apa aja',
            'tipe_transmisi' => 'apa dong'
        ]);

        $response = $controller->destroy($Motor->id);

        $this->assertSame(200, $response->getStatusCode());
    }
}
