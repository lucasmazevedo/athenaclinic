<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Modalidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['abbr' => 'CR', 'name' => 'Radiografia Computadorizada'],
            ['abbr' => 'CT', 'name' => 'Tomografia Computadorizada'],
            ['abbr' => 'DX', 'name' => 'Radiografia digital '],
            ['abbr' => 'ECG', 'name' => 'Eletrocardiografia'],
            ['abbr' => 'ES', 'name' => 'Endoscopia'],
            ['abbr' => 'MG', 'name' => 'Mamografia'],
            ['abbr' => 'MR', 'name' => 'Ressonância magnética'],
            ['abbr' => 'NM', 'name' => 'Medicina nuclear'],
            ['abbr' => 'US', 'name' => 'Ultrassom'],
            ['abbr' => 'OT', 'name' => 'Outro'],
        ];

        foreach ($rows as $mod) {
            Modalidade::firstOrCreate([
                'abbr' => $mod['abbr'],
                'name' => $mod['name']
            ]);
        }
    }
}
