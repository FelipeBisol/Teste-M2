<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityGroup;
use App\Models\City;
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index(){
        $city = City::all();

       return CityResource::collection($city);
    }

    public function show($id){
        $city = City::findOrFail($id);

        return new CityResource($city);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(),[
            "name"          => "required|string",
            "cep"           => "required|string",
            "group_id"      => "required|exists:App\Models\CityGroup,id"
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $city              = new City;
        $city->name        = $request->input('name');
        $city->group_id    = $request->input('group_id');
        $city->cep         = $request->input('cep');
        $city->save();

        return new CityResource($city);
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(),[
            "name"          => "required|string",
            "cep"           => "required|string",
            "group_id"      => "required|exists:App\Models\CityGroup,id"
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $city = City::findOrFail($request->id);
        $city->name         = $request->input('name');
        $city->group_id     = $request->input('group_id');
        $city->cep          = $request->input('cep');
        $city->save();

        return new CityResource($city);
    }

    public function destroy($id){
        $city = City::findOrFail($id);
        $city->delete();
        return new CityResource($city);
    }
}
