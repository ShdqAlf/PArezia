<?php

namespace Database\Seeders;

use App\Models\KriteriaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KriteriaModel::create([
            'nama_kriteria' => 'Administrasi',
            'kode_bobot' => 'C1',
            'nilai_bobot' => '0.15',
            'jenis_kriteria' => 'Benefit'
        ]);
        KriteriaModel::create([
            'nama_kriteria' => 'Interview ',
            'kode_bobot' => 'C2',
            'nilai_bobot' => '0.2',
            'jenis_kriteria' => 'Benefit'
        ]);
        KriteriaModel::create([
            'nama_kriteria' => 'Testing ',
            'kode_bobot' => 'C3',
            'nilai_bobot' => '0.35',
            'jenis_kriteria' => 'Benefit'
        ]);
        KriteriaModel::create([
            'nama_kriteria' => 'Tes Psikotes ',
            'kode_bobot' => 'C4',
            'nilai_bobot' => '0.3',
            'jenis_kriteria' => 'Benefit'
        ]);
    }
}
