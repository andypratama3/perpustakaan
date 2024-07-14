<?php

namespace App\Console\Commands;

use App\Models\Denda;
use App\Models\Peminjaman;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class CalculateDenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-denda';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghitung Denda Perhari Jika Telah Melakukan Peminjaman';

    /**
     * Execute the console command.
     */

     public function handle()
     {
         $overduePeminjamans = Peminjaman::whereDate('tgl_kembali', '<', Carbon::now())
             ->whereNull('denda')
             ->get();

         foreach ($overduePeminjamans as $peminjaman) {
             $tgl_kembali = Carbon::parse($peminjaman->tgl_kembali);
             $lama_terlambat = $tgl_kembali->diffInDays(Carbon::now());

             // Example: Calculate denda based on business logic (e.g., fixed rate per day)
             $dendaAmount = $lama_terlambat * 1000;

            // Store denda record in the 'dendas' table
            Denda::create([
                'no_peminjaman' => $peminjaman->no_peminjaman,
                'peminjamans_id' => $peminjaman->id,
                'status' => 'unpaid', // Adjust status as per your application's logic
                'total_denda' => number_format($dendaAmount, 0, ',', '.'), // Format as IDR
                'lama_terlambat' => $lama_terlambat,
            ]);

            // Update 'denda' field in 'Peminjaman' table
            $peminjaman->update(['denda' => $dendaAmount]);
         }

         $this->info('Denda calculation completed.');
     }
}
