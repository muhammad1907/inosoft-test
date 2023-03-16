<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository
{
    protected Kendaraan $kendaraan;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }

    public function getAll(): \Illuminate\Support\Collection
    {
        return $this->kendaraan->all();
    }

    public function getById(string $id): Kendaraan
    {
        
        return $this->kendaraan->findOrFail($id);
    }

    public function create(array $data): Kendaraan
    {
        return $this->kendaraan->create($data);
    }

    public function update(array $data, string $id): Kendaraan
    {
        $kendaraan = $this->getById($id);
        $kendaraan->update($data);
        return $kendaraan;
    }

    public function delete(string $id): void
    {
        $kendaraan = $this->getById($id);
        $kendaraan->delete();
    }
}
