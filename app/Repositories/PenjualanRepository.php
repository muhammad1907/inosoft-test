<?php

namespace App\Repositories;

use App\Models\Penjualan;

class PenjualanRepository
{
    protected Penjualan $penjualan;

    public function __construct(Penjualan $penjualan)
    {
        $this->penjualan = $penjualan;
    }

    public function getAll(): \Illuminate\Support\Collection
    {
        return $this->penjualan->all();
    }

    public function getById(string $id): Penjualan
    {
        
        return $this->penjualan->findOrFail($id);
    }

    public function create(array $data): Penjualan
    {
        return $this->penjualan->create($data);
    }

   
}
