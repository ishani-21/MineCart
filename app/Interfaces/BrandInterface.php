<?php

namespace App\Interfaces;

interface BrandInterface
{
    public function store(array $data);

    public function changeStatus(array $data);

    public function update(array $data);
}
