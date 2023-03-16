<?php

namespace App\Repositories;

use App\Models\Motor;

class MotorRepository
{
    protected $motor;

    public function __construct(Motor $motor)
    {
        $this->motor = $motor;
    }

    public function getAll()
    {
        return $this->motor->all();
    }

    public function getById($id)
    {
        return $this->motor->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->motor->create($data);
    }

    public function update($id, array $data)
    {
        $motor = $this->getById($id);
        $motor->update($data);
        return $motor;
    }

    public function delete($id)
    {
        $motor = $this->getById($id);
        $motor->delete();
    }
}
