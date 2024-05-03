<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResources;
use App\Repositories\CategoryInterface;
use App\Repositories\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     /**
     * Product Repository instance.
     */
    protected $product;
     /**
     * Category Repository instance.
     */
    protected $category;

    protected $data=[];

    public function __construct(CategoryInterface $category, ProductInterface $product) {
        $this->product = $product;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data["categories"]=$this->category->all();
        $this->data["add"]=true;
        return view('product',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest
     */
    public function store(ProductRequest $request)
    {
        $this->product->store($request);
        return redirect()->route("product.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $single=$this->product->findById($id);
        $this->data["categories"]=$this->category->all();
        $this->data["edit"]=true;
        $this->data["single"]=$single;
        return view('product',$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $this->product->update($request,$id);
        return redirect()->route("product.index");
    }
    /**
     * Update the specified resource in storage.
     */
    public function products()
    {
        $data=$this->product->all();
        return response()->json([
            "status"=>true,
            "code"=>200,
            "message"=>"All Products",
            "data"=>ProductResources::collection($data)
           ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data=$this->product->destroy($id);
       return response()->json([
        "status"=>true,
        "code"=>200,
        "message"=>"Delete Product",
        "data"=>$data
       ]);
    }
}
