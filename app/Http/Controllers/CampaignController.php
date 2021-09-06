<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityGroup;
use App\Models\Campaign;
use App\Http\Resources\CampaignResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CampaignController extends Controller{

    public function index(){
        $campaign = Campaign::where('status', 1)->get();

        return CampaignResource::collection($campaign);
    }

    public function show($id){
        $campaign = Campaign::findOrFail($id);

        return new CampaignResource($campaign);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(),[
            "name"          => "required|string",
            "status"        => "required|int|min:0|max:1",
            "group_id"      => "required|exists:App\Models\CityGroup,id"
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $status = $request->input('stauts');

        if($status = 1){
            $campaign = Campaign::where('status', 1)->get();

            foreach($campaign as $key => $value){
                $campaign = Campaign::findOrFail($value->id);

                $campaign->status      = 0;
                $campaign->save();
            }
        }

        $campaign              = new Campaign;
        $campaign->name        = $request->input('name');
        $campaign->group_id    = $request->input('group_id');
        $campaign->status      = $request->input('status');
        $campaign->save();

        return new CampaignResource($campaign);
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(),[
            "name"          => "required|string",
            "status"        => "required|int|min:0|max:1",
            "group_id"      => "required|exists:App\Models\CityGroup,id"
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $status = $request->input('stauts');

        if($status = 1){
            $campaign = Campaign::where('status', 1)->get();

            foreach($campaign as $key => $value){
                $campaign = Campaign::findOrFail($value->id);

                $campaign->status      = 0;
                $campaign->save();
            }
        }

        $campaign = Campaign::findOrFail($id);

        $campaign->name        = $request->input('name');
        $campaign->group_id    = $request->input('group_id');
        $campaign->status      = $request->input('status');
        $campaign->save();

        return new CampaignResource($campaign);
    }

    public function destroy ($id) {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return new CampaignResource($campaign);
    }
}
