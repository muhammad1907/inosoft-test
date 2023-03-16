<?php

namespace App\Repositories;

use App\Models\Mobil;

class MobilRepository
{
    protected $mobil;

    public function __construct(Mobil $mobil)
    {
        $this->mobil = $mobil;
    }

    public function getAll()
    {
        return $this->mobil->all();
    }

    public function getById($id)
    {
        return $this->mobil->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->mobil->create($data);
    }

    public function update($id, array $data)
    {
        $mobil = $this->getById($id);
        $mobil->update($data);
        return $mobil;
    }

    public function delete($id)
    {
        $mobil = $this->getById($id);
        $mobil->delete();
    }
}