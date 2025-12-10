<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriak = [
            ['nev' => 'Mágikus', 'leiras' => 'Mágikus erőkkel rendelkező lények'],
            ['nev' => 'Mutáns', 'leiras' => 'Genetikailag módosított vagy mutált lények'],
            ['nev' => 'Digitális Lény', 'leiras' => 'Virtuális vagy digitális létezők'],
            ['nev' => 'Mitológiai', 'leiras' => 'Mitológiából ismert lények modern változatai'],
            ['nev' => 'Időutazó', 'leiras' => 'Időn át utazó különleges lények'],
        ];

        foreach ($kategoriak as $kategoria) {
            \App\Models\Kategoria::create($kategoria);
        }
    }
}
