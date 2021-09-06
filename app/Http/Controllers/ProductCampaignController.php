<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\ProductCampaign;
use App\Http\Resources\ProductCampaignResource;
use Illuminate\Support\Facades\Validator;

class ProductCampaignController extends Controller
{
    public function index(){
        $productCampaign = ProductCampaign::all();

        return ProductCampaignResource::collection($productCampaign);
    }

    public function show($id){
        $productCampaign = ProductCampaign::findOrFail($id);

        return new ProductCampaignResource($productCampaign);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(),[
            "discount_type"     => "required|string",
            "discount_value"    => "required|int",
            "campaigns_id"      => "required|exists:App\Models\Campaign,id",
            "products_id"       => "required|exists:App\Models\Product,id"
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $productCampaignId = $request->input('products_id');
        $price = Product::findOrFail($productCampaignId)->price;
        $price = ProductCampaign::setDiscount($price, $request->input('discount_type'), $request->input('discount_value'));

        $productCampaign                    = new ProductCampaign;
        $productCampaign->discount_type     = $request->input('discount_type');
        $productCampaign->discount_value    = $request->input('discount_value');
        $productCampaign->campaigns_id      = $request->input('campaigns_id');
        $productCampaign->products_id       = $request->input('products_id');
        $productCampaign->price             = $price;
        $productCampaign->save();

        return new ProductCampaignResource($productCampaign);
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(),[
            "discount_type"     => "required|string",
            "discount_value"    => "required|int",
            "campaigns_id"      => "required|exists:App\Models\Campaign,id",
            "products_id"       => "required|exists:App\Models\Product,id"
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $productCampaignId = $request->input('products_id');
        $price = Product::findOrFail($productCampaignId)->price;
        $price = ProductCampaign::setDiscount($price, $request->input('discount_type'), $request->input('discount_value'));

        $productCampaign                    = ProductCampaign::findOrFail($id);
        $productCampaign->discount_type     = $request->input('discount_type');
        $productCampaign->discount_value    = $request->input('discount_value');
        $productCampaign->campaigns_id      = $request->input('campaigns_id');
        $productCampaign->products_id       = $request->input('products_id');
        $productCampaign->price             = $price;
        $productCampaign->save();

        return new ProductCampaignResource($productCampaign);
    }

    public function destroy($id) {
        $productCampaign = ProductCampaign::findOrFail($id);
        $productCampaign->delete();

        return new ProductCampaignResource($productCampaign);
    }
}
