<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(["name" => 'Sebastyan Enrique Pineda Aguilera', "email" => 'sepipiag@gmail.com', 'password' => bcrypt('h')]);
        $this->call(ConsecutiveSeeder::class);
        $this->call(DebeSeeder::class);
        $this->call(ElaboradoSeeder::class);
        $this->call(HaberSeeder::class);
        $this->call(ConceptoSeeder::class);
        $this->call(PasswordPrivilegesSeeder::class);
        $this->call(OtherConceptosSeeder::class);
        $this->call(ConceptDischargeReceiptSeeder::class);
        $this->call(ConceptEntryReceiptSeeder::class);
        $this->call(ThirdActivitySeeder::class);
        $this->call(ThirdEntrySeeder::class);
    }
}
