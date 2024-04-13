<?php

namespace Database\Seeders;

use App\Models\LokerModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LokerModel::create([
            'judul' => 'Lowongan Untuk Developer',
            'posisi' => 'Programmer',
            'minimal_pendidikan' => 'D3,S1',
            'minimal_pengalaman' => '1 Tahun',
            'tanggal_berakhir' => '2024-04-14',
            'usia_maks' => 30,
            'keterangan' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquam cursus erat, id tincidunt eros eleifend eu. Donec quis nisl in lorem tincidunt eleifend. Quisque cursus et arcu nec interdum. Aenean a elit nisi. Aliquam tortor purus, ultrices vitae eleifend in, sagittis faucibus metus. Sed maximus varius imperdiet. Donec porta sollicitudin nibh, egestas tincidunt elit egestas quis. Nullam condimentum, urna et tempor vestibulum, risus nisl tincidunt risus, in tempor purus leo nec magna. Cras eget varius neque. Sed in lectus est. Aenean nec efficitur libero, ut tincidunt lorem. Duis rhoncus ligula in est tempus lacinia. Phasellus egestas gravida feugiat. Nulla nec sapien molestie, auctor elit sit amet, hendrerit risus.',
        ]);
        LokerModel::create([
            'judul' => 'Lowongan Untuk Analyst',
            'posisi' => 'Programmer',
            'minimal_pendidikan' => 'D3 Jurusan SI',
            'minimal_pengalaman' => '0-1 Tahun',
            'tanggal_berakhir' => '2024-04-14',
            'usia_maks' => 30,
            'keterangan' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquam cursus erat, id tincidunt eros eleifend eu. Donec quis nisl in lorem tincidunt eleifend. Quisque cursus et arcu nec interdum. Aenean a elit nisi. Aliquam tortor purus, ultrices vitae eleifend in, sagittis faucibus metus. Sed maximus varius imperdiet. Donec porta sollicitudin nibh, egestas tincidunt elit egestas quis. Nullam condimentum, urna et tempor vestibulum, risus nisl tincidunt risus, in tempor purus leo nec magna. Cras eget varius neque. Sed in lectus est. Aenean nec efficitur libero, ut tincidunt lorem. Duis rhoncus ligula in est tempus lacinia. Phasellus egestas gravida feugiat. Nulla nec sapien molestie, auctor elit sit amet, hendrerit risus.',
        ]);
    }
}
