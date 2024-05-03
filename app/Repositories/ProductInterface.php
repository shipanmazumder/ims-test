<?php

namespace App\Repositories;

interface ProductInterface
{
    public function all();

    public function store($data);

    public function findById($id);

    public function update($data, $id);

    public function destroy($id);
}
