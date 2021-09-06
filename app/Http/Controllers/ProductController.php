<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $product = Product::get();

        return ProductResource::collection($product);
    }

    public function show($id){
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(),[
            "name"    => "required|string",
            "price"   => "required|int",
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $product              = new Product;
        $product->name        = $request->input('name');
        $product->price       = $request->input('price');
        $product->save();

        return new ProductResource($product);
    }


    public function update(Request $request, $id){
        $valid = Validator::make($request->all(),[
            "name"    => "required|string",
            "price"   => "required|int",
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $product = Product::findOrFail($request->id);
        $product->name        = $request->input('name');
        $product->price       = $request->input('price');
        $product->save();

        return new ProductResource($product);
    }

    public function destroy ($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return new ProductResource($product);
    }
}
