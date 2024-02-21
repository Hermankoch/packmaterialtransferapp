<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            [
                'code' => '10PMA0',
                'name' => 'ROEPERSFONTEIN',
                'abbr' => 'RF'
            ],
            [
                'code' => '10PMA1',
                'name' => 'YARONA',
                'abbr' => 'Y'
            ],
            [
                'code' => '10PMA2',
                'name' => 'RF ONGEVOU',
                'abbr' => 'RFO'
            ],
            [
                'code' => '10PMA3',
                'name' => 'RF SENTRAAL',
                'abbr' => 'RFS'
            ],
            [
                'code' => '10PMA4',
                'name' => 'YARONA PUNNET',
                'abbr' => 'YP'
            ],
            [
                'code' => '10PMA5',
                'name' => 'RF PLAKKERS',
                'abbr' => 'RFP'
            ],
            [
                'code' => 'PMNEW',
                'name' => 'NEWGRO',
                'abbr' => 'NG'
            ],
            [
                'code' =>  'PMNEW2',
                'name' => 'NEWGRO ONGEVOU',
                'abbr' => 'NGO'
            ],
        ];
        foreach ($warehouses as $warehouse) {
            \App\Models\Warehouse::create($warehouse);
        }
    }
}
