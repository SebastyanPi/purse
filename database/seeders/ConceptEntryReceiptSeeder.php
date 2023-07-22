<?php

namespace Database\Seeders;
use App\Models\ConceptEntryReceipt;
use Illuminate\Database\Seeder;

class ConceptEntryReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ConceptEntryReceipt::create([
            'name' => 'Financieros',
            'state' => true,
            'debe' => 1,
            'haber' => 2
        ]);

        ConceptEntryReceipt::create([
            'name' => 'Particulares',
            'state' => true,
            'debe' => 1,
            'haber' => 2
        ]);

        ConceptEntryReceipt::create([
            'name' => 'Otros',
            'state' => true,
            'debe' => 1,
            'haber' => 4
        ]);
    }
}
