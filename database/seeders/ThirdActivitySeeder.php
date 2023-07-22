<?php

namespace Database\Seeders;
use App\Models\thirdActivity;
use Illuminate\Database\Seeder;

class ThirdActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        thirdActivity::create([
            'nombre' => 'Entidad Bancaria'
        ]);
    }
}
