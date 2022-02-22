<?php

namespace App\Interfaces\Seller;

interface CategoryInterface
{
    public function showCategory();

    public function storeCategory(array $request);

    public function selectCategory(array $request);
}
