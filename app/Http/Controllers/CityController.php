<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityGroup;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function getAllCity(){
        $city = City::select('id', 'name', 'cep', 'group_id')->get();
        foreach ($city as $key => $value) {

            $city = array();
            $city['id']   = $value->id;
            $city['name'] = $value->name;
            $city['cep']  = $value->cep;
            $cityGroup = $value->cityGroup()->first();
            $city['group_name'] = $cityGroup->name;

            $cities[] = $city;
        }
        return response($cities, 200);
    }

    public function createCity(Request $request){

        $cityGroup = CityGroup::select('id')->get();

        if(array_key_exists($request->group_id, json_decode($cityGroup))) {
            $city              = new City;
            $city->name        = $request->name;
            $city->cep         = $request->cep;
            $city->group_id    = $request->group_id;
            $city->save();

            return response()->json(["message" => "City record created"], 201);
        }

        return response()->json(["message" => "City not found"], 404);
    }

    public function getCity($id){
        if (City::where('id', $id)->exists()) {
            $city = City::select('id', 'name', 'cep', 'group_id')->where('id', $id)->get();
            $cityGroup = $city[0]->cityGroup()->first();
            $city[0]['group_name'] = $cityGroup->name;

            return response($city[0], 200);
        } else {
            return response()->json([
                "message" => "City not found"
            ], 404);
        }
    }

    public function updateCity(Request $request, $id){
        $post = $request->all();
        $cityGroup = CityGroup::select('id')->get();

        if (City::where('id', $id)->exists()) {
            $city = City::find($id);
            $city->name = is_null($post[0]['name']) ? $city->name : $post[0]['name'];
            $city->cep = is_null($post[0]['name']) ? $city->cep : $post[0]['cep'];
            $city->group_id = is_null($post[0]['group_id']) ? $city->group_id : $post[0]['group_id'];
            $city->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "City not found"
            ], 404);

        }
    }

    public function deleteCity($id){
        if(City::where('id', $id)->exists()) {
            $city = City::find($id);
            $city->delete();

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
