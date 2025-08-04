<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        $marcas = [
            ['nombre' => 'Apple'],
            ['nombre' => 'Samsung'],
            ['nombre' => 'Xiaomi'],
            ['nombre' => 'Sony']
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}