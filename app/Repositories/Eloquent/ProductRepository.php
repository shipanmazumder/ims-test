<?php

namespace App\Repositories\Eloquent;

use App\Http\Resources\ProductResources;
use App\Models\MasterProduct;
use App\Repositories\ProductInterface;

class ProductRepository implements ProductInterface
{
    public function all(){
        return MasterProduct::with("category")->orderBy("id","desc")->get();
    }

    public function store($data){
        $category_id=$data->category_id;
        $product_name=$data->product_name;
        $selling_price=$data->selling_price;
        // $restaurant_id=$data->restaurant_id;
        $restaurant_id=1;

        $product=MasterProduct::create([
            "category_id"=>$category_id,
            "product_name"=>$product_name,
            "selling_price"=>$selling_price,
            "restaurant_id"=>$restaurant_id,
        ]);
        return $product;
    }

    public function findById($id){
        $product= MasterProduct::with("category")->where("id",$id)->firstOrFail();
        return $product;
    }

    public function update($data, $id){
        $category_id=$data->category_id;
        $product_name=$data->product_name;
        $selling_price=$data->selling_price;
        // $restaurant_id=$data->restaurant_id;
        $restaurant_id=1;

        $product=$this->findById($id);
        $product->category_id=$category_id;
        $product->product_name=$product_name;
        $product->selling_price=$selling_price;
        $product->restaurant_id=$restaurant_id;
        $product->save();

        return $product;

    }

    public function destroy($id){
        $product=$this->findById($id);
        $product->delete();
        return $product;
    }
}
