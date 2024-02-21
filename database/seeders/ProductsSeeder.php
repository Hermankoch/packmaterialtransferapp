<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //import the products from the csv file
        $file = fopen(base_path('database/seeders/products.csv'), 'r');
        while ($row = fgetcsv($file, 1000, ','))
        {
            \App\Models\Product::create([
                'inventoryId' => $row[0],
                'description' => $row[1],
            ]);
        }
        fclose($file);
    }
}
