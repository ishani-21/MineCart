<?php

namespace App\Interfaces;

interface CategoryInterface
{
    public function store(array $data);
    public function update(array $data,$id);
    public function subupdate(array $data);
    public function catchangestatus(array $data);
    public function subdelete(array $data);
}