<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\ProductCampaign;

class ProductCampaignController extends Controller
{
    public function getAllProductCampaign(){
        $productCampaign = ProductCampaign::select('id', 'discount_type', 'discount_value', 'campaigns_id', 'products_id')->get();

        foreach ($productCampaign as $key => $value) {
            $productCampaign = array();
            $productCampaign['id']   = $value->id;

            $campaign = $value->campaign()->get();
            return $campaign;
            $product = $value->product()->find($value->id);
            $productCampaign['product'] = $product;
//            setDiscount($price, $type, $value)
            $product[] = $productCampaign;
        }
        return response($product, 200);
    }

    public function createProductCampaign(Request $request){
        $product = Product::select('id')->get();
        $campaign = Campaign::select('id')->get();

        $productCampaign                        = new ProductCampaign;
        $productCampaign->discount_type         = $request[0]['discount_type'];
        $productCampaign->discount_value        = preg_replace("/[^0-9]/", "", $request[0]['discount_value']);
        $productCampaign->campaigns_id          = $request[0]['campaigns_id'];
        $productCampaign->products_id           = $request[0]['products_id'];

        $productCampaign->save();

        return response()->json(["message" => "Product Campaign record created"], 201);
    }
    public function getProductCampaign($id){
        if (Campaign::where('id', $id)->exists()) {
            $campaign = Campaign::select('id', 'name', 'status', 'group_id')->where('id', $id)->get();
            $cityGroup = $campaign[0]->cityGroup()->first();
            $campaign[0]['group_name'] = $cityGroup->name;
            $campaign[0]['status'] = ($campaign[0]['status'] == 1 ? 'Campanha Ativa' : 'Campanha Inativa');

            return response($campaign, 200);
        } else {
            return response()->json([
                "message" => "Product Campaign not found"
            ], 404);
        }
    }

    public function updateProductCampaign(Request $request, $id){
        $post = $request->all();
        if (Campaign::where('id', $id)->exists()) {
            $campaign = Campaign::find($id);
            $campaign->name = is_null($post[0]['name']) ? $campaign->name : $post[0]['name'];
            $campaign->status = is_null($post[0]['status']) ? $campaign->status : $post[0]['status'];
            $campaign->group_id = is_null($post[0]['group_id']) ? $campaign->group_id : $post[0]['group_id'];
            $campaign->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Product Campaign not found"
            ], 404);

        }
    }

    public function deleteProductCampaign ($id) {
        if(Campaign::where('id', $id)->exists()) {
            $campaign = Campaign::find($id);
            $campaign->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Product Campaign not found"
            ], 404);
        }
    }
}
