<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityGroupRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name' => 'required',
            'description' => 'required'
        ];
    }

    public function messages(){
        return[
            'name.required' => 'this field is required',
            'description.required' => 'this field is required'
        ];
    }
}
