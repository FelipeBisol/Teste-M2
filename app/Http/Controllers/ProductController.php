<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getAllProduct(){
        $product = Product::select('id', 'name', 'price')->get();
        return response($product, 200);
    }

    public function createProduct(Request $request){
        $product              = new Product;
        $product->name        = $request->name;
        $product->price       = preg_replace("/[^0-9]/", "", $request->price);;
        $product->save();

        return response()->json(["message" => "Product record created"], 201);
    }

    public function getProduct($id){
        if (Product::where('id', $id)->exists()) {
            $product = Product::select('id', 'name', 'price')->where('id', $id)->get();
            return response($product, 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }

    public function updateProduct(Request $request, $id){
        $post = $request->all();
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->name = is_null($post[0]['name']) ? $product->name : $post[0]['name'];
            $product->price = is_null($post[0]['price']) ? $product->description : $post[0]['price'];
            $product->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);

        }
    }

    public function deleteProduct ($id) {
        if(Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }
}
