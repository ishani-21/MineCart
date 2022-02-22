<?php

namespace App\Interfaces\Seller;

interface BrandInterface
{
    public function showBrand();
    public function getBrand(array $array);
    public function selectedBrand(array $array);
}
