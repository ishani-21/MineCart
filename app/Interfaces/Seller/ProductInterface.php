<?php

namespace App\Interfaces\Seller;

interface ProductInterface
{
    public function all();

    public function show($id);

    public function create();

    public function store(array $request);

    public function edit($id);

    public function update(array $request);

    public function delete(array $request);

    public function removeImages(array $request);
}
