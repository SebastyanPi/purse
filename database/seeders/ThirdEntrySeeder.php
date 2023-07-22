<?php

namespace Database\Seeders;
use App\Models\thirdEntry;
use Illuminate\Database\Seeder;

class ThirdEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        thirdEntry::create([
            'cedula' => 1003378106,
            'nombre' => 'Bancolombia',
            'direccion' => 'Calle 12 #28-58',
            'telefono' => 3005350586,
            'actividad' => 1
        ]);
    }
}
