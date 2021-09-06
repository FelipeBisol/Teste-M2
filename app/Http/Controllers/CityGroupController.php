<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityGroup;
use App\Http\Resources\CityGroupResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CityGroupController extends Controller{

    public function index(){
        $cityGroup = CityGroup::all();
        return CityGroupResource::collection($cityGroup);
    }

    public function show($id){
        if (CityGroup::findOrFail($id)->exists()){
            $cityGroup = CityGroup::findOrFail($id);
            return new CityGroupResource($cityGroup);
        }
    }

    public function store(Request $request){

        $valid = Validator::make($request->all(),[
            "name"              => "required|string",
            "description"        => "required|string",
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $cityGroup              = new CityGroup;
        $cityGroup->name        = $request->input('name');
        $cityGroup->description = $request->input('description');
        $cityGroup->save();

        return new CityGroupResource($cityGroup);
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(),[
            "name"              => "required|string",
            "description"        => "required|string",
        ]);

        if($valid->fails()){
            return response("Validation error", 400);
        }

        $cityGroup = CityGroup::findOrFail($request->id);
        $cityGroup->name = $request->input('name');
        $cityGroup->description = $request->input('description');
        $cityGroup->save();

        return new CityGroupResource($cityGroup);
    }

    public function destroy($id){
        $cityGroup = CityGroup::findOrFail($id);
        $cityGroup->delete();
        return new CityGroupResource($cityGroup);
    }
}
