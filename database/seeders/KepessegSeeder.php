<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepessegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kepessegek = [
            ['nev' => 'Teleportálás', 'leiras' => 'Képesség helyek közötti azonnali utazásra', 'tipus' => 'magikus'],
            ['nev' => 'Hangulatváltás', 'leiras' => 'Mások hangulatának befolyásolása', 'tipus' => 'mentalis'],
            ['nev' => 'Szupererő', 'leiras' => 'Emberfölötti fizikai erő', 'tipus' => 'fizikai'],
            ['nev' => 'Repülés', 'leiras' => 'Gravitáció legyőzése', 'tipus' => 'fizikai'],
            ['nev' => 'Időmanipuláció', 'leiras' => 'Idő lassítása vagy gyorsítása', 'tipus' => 'magikus'],
            ['nev' => 'Láthatatlanság', 'leiras' => 'Láthatatlanná válás', 'tipus' => 'magikus'],
            ['nev' => 'Gondolatolvasás', 'leiras' => 'Mások gondolatainak olvasása', 'tipus' => 'mentalis'],
            ['nev' => 'Alakváltoztatás', 'leiras' => 'Különböző formák felvétele', 'tipus' => 'magikus'],
        ];

        foreach ($kepessegek as $kepesseg) {
            \App\Models\Kepesseg::create($kepesseg);
        }
    }
}
