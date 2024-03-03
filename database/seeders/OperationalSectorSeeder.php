<?php

namespace Database\Seeders;

use App\Models\OperationalSector;
use Illuminate\Database\Seeder;

class OperationalSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // OperationalSector::factory(6)->create();
        OperationalSector::create([
            'code' =>   generateCode(OperationalSector::class),
            'name' => 'ZONA PACIFICO'
        ]);

        OperationalSector::create([
            'code' =>   generateCode(OperationalSector::class),
            'name' => 'ZONA CANA'
        ]);
    }
}
