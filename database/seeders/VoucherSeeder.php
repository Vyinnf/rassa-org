<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    \App\Models\Voucher::create([
        'name' => 'Diskon 10% Semua Kopi',
        'points_required' => 100,
        'description' => 'Tunjukkan kode ini ke kasir untuk potongan 10% untuk semua menu kopi.',
        'valid_days' => 7,
    ]);

    \App\Models\Voucher::create([
        'name' => 'Gratis Snack Cireng',
        'points_required' => 250,
        'description' => 'Tukar poinmu dengan satu porsi Cireng panas gratis!',
        'valid_days' => 3,
    ]);
}
}
