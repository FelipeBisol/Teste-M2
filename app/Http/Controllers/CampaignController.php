<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityGroup;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller{

    public function getAllCampaign(){
        $campaign = Campaign::select('id', 'name', 'status', 'group_id')->get();

        foreach ($campaign as $key => $value) {
            $campaign = array();
            $campaign['id']   = $value->id;
            $campaign['name'] = $value->name;
            $campaign['status']  = ($value->stauts = 1 ? 'Campanha Ativa' : 'Campanha Inativa');
            $cityGroup = $value->cityGroup()->first();
            $campaign['group_name'] = $cityGroup->name;

            $campaigns[] = $campaign;
        }
        return response($campaigns, 200);
    }

    public function createCampaign(Request $request){
        $cityGroup = CityGroup::select('id')->get();

        if(array_key_exists($request->group_id, json_decode($cityGroup))) {
            $campaign               = new Campaign;
            $campaign->name         = $request->name;
            $campaign->status       = $request->status;
            $campaign->group_id     = $request->group_id;
            $campaign->save();

            return response()->json(["message" => "Campaign record created"], 201);
        }

        return response()->json(["message" => "Campaign not found"], 404);

    }
    public function getCampaign($id){
        if (Campaign::where('id', $id)->exists()) {
            $campaign = Campaign::select('id', 'name', 'status', 'group_id')->where('id', $id)->get();
            $cityGroup = $campaign[0]->cityGroup()->first();
            $campaign[0]['group_name'] = $cityGroup->name;
            $campaign[0]['status'] = ($campaign[0]['status'] == 1 ? 'Campanha Ativa' : 'Campanha Inativa');

            return response($campaign, 200);
        } else {
            return response()->json([
                "message" => "Campaign not found"
            ], 404);
        }
    }

    public function updateCampaign(Request $request, $id){
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
                "message" => "Campaign not found"
            ], 404);

        }
    }

    public function deleteCampaign ($id) {
        if(Campaign::where('id', $id)->exists()) {
            $campaign = Campaign::find($id);
            $campaign->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Campaign not found"
            ], 404);
        }
    }
}
