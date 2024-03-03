<?php

namespace Database\Seeders;

use App\Models\Sectional;
use App\Models\OperationalSector;
use Illuminate\Database\Seeder;

class SectionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sectional::factory(6)->create();

        Sectional::create([
            'operational_sector_id' => OperationalSector::where('name', 'ZONA CANA')->first()->id ??  OperationalSector::all()->random()->id,
            'code' => generateCode(Sectional::class),
            'name' => 'CAUCANA'
        ]);

        Sectional::create([
            'operational_sector_id' => OperationalSector::where('name', 'ZONA PACIFICO')->first()->id ??  OperationalSector::all()->random()->id,
            'code' => generateCode(Sectional::class),
            'name' => 'PIE DE MONTE'
        ]);

        Sectional::create([
            'operational_sector_id' => OperationalSector::where('name', 'ZONA PACIFICO')->first()->id ??  OperationalSector::all()->random()->id,
            'code' => generateCode(Sectional::class),
            'name' => 'TUMACO RURAL'
        ]);

        Sectional::create([
            'operational_sector_id' => OperationalSector::where('name', 'ZONA PACIFICO')->first()->id ??  OperationalSector::all()->random()->id,
            'code' => generateCode(Sectional::class),
            'name' => 'TUMACO URBANO'
        ]);
    }
}
