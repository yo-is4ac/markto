<?php

namespace App\Http\Repositories\Contracts;

interface ListaContract
{
    public function index();
    public function store(string $name);
    public function show(string $id);
}
