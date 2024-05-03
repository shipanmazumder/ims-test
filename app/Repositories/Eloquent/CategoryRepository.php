<?php

namespace App\Repositories\Eloquent;

use App\Http\Resources\CategoryResources;
use App\Models\Category;
use App\Repositories\CategoryInterface;
use App\Repositories\EloquentInterface;

class CategoryRepository implements CategoryInterface
{
    public function all(){
        $categories=Category::all();
        return CategoryResources::collection($categories);
    }

    public function store($data){

    }

    public function findById($id){

    }

    public function update($data, $id){

    }

    public function destroy($id){

    }
}
