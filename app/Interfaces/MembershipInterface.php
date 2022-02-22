<?php

namespace App\Interfaces;

interface MembershipInterface
{
    public function store(array $data);

    public function update(array $data);
}
