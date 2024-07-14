<?php

namespace Database\Factories;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Member;
use App\Models\Bukus;

class PeminjamanFactory extends Factory
{
    protected $model = Peminjaman::class;

    public function definition()
    {
        return [
            'no_peminjaman' => $this->faker->unique()->uuid,
            'members_id' => Member::factory(), // Assuming you have a Members model and factory
            'bukus_id' => Buku::factory(), // Assuming you have a Bukus model and factory
            'tgl_pinjam' => Carbon::now()->subDays(rand(1, 30)), // Example: Random date within the last 30 days
            'tgl_kembali' => Carbon::now()->addDays(rand(1, 14)), // Example: Random date within the next 14 days
            'denda' => null,
            'jumlah' => '100', // Example: Default value for jumlah
            'total_pembayaran' => null,
            'status' => $this->faker->randomElement(['pending', 'processed', 'completed']),
        ];
    }
}
