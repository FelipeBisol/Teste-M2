<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\CityGroup;
use App\Models\Product;

class DbSeeder extends Seeder
{
    public function run(){
        $cityGroup = CityGroup::create([
            'name'           => 'Cidade Grande',
            'description'    => 'Cidade grande é um termo comumente usado em urbanismo para designar cidades que abriguem mais de 500 mil habitantes.',
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ]);

        $cityGroup->cities()->create([
            'name'  => 'Porto Alegre',
            'cep' => '04870470',
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ]);

        $cityGroup->campaigns()->create([
            'name' => 'Doacao',
            'status' => '1',
        ]);

        $product = Product::create([
            'name' => 'Calça colorida',
            'price' => '19990'
        ]);

        $product->campaigns()->attach($product, [
            'discount_type' => 'fixed',
            'discount_value' => '1000',
            'price' => '18990',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
