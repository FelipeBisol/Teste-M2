<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityGroup;
use Illuminate\Support\Facades\DB;

class CityGroupController extends Controller
{

    public function getAllCityGroups(){
        $cityGroup = CityGroup::select('id', 'name', 'description')->get();
        return response($cityGroup, 200);
    }

    public function createCityGroup(Request $request){
        $cityGroup              = new CityGroup;
        $cityGroup->name        = $request->name;
        $cityGroup->description = $request->description;
        $cityGroup->save();

        return response()->json(["message" => "City Group record created"], 201);
    }
    public function getCityGroup($id){
        if (CityGroup::where('id', $id)->exists()) {
            $cityGroup = CityGroup::select('id', 'name', 'description')->where('id', $id)->get();
            return response($cityGroup, 200);
        } else {
            return response()->json([
                "message" => "City Group not found"
            ], 404);
        }
    }

    public function updateCityGroup(Request $request, $id){
        $post = $request->all();
        if (CityGroup::where('id', $id)->exists()) {
            $cityGroup = CityGroup::find($id);
            $cityGroup->name = is_null($post[0]['name']) ? $cityGroup->name : $post[0]['name'];
            $cityGroup->description = is_null($post[0]['description']) ? $cityGroup->description : $post[0]['description'];
            $cityGroup->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "City group not found"
            ], 404);

        }
    }

    public function deleteCityGroup ($id) {
        if(CityGroup::where('id', $id)->exists()) {
            $cityGroup = CityGroup::find($id);
            $cityGroup->delete();

            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "City not found"
            ], 404);
          }
    }
}
