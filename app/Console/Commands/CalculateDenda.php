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
    protected $description = 'Calculate overdue fines for confirmed borrowings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Retrieve overdue borrowings that haven't had denda calculated yet
            $overduePeminjamans = Peminjaman::whereDate('tgl_kembali', '<', Carbon::now())
                ->where('status', 'konfirmasi')
                ->whereNull('denda')
                ->get();

            // Iterate through each overdue borrowing
            foreach ($overduePeminjamans as $peminjaman) {
                $tgl_kembali = Carbon::parse($peminjaman->tgl_kembali);
                $lama_terlambat = $tgl_kembali->diffInDays(Carbon::now());

                // Calculate denda (assuming 1000 IDR per day overdue)
                $dendaAmount = ceil($lama_terlambat / 1000) * 1000;

                // Create a Denda record for the overdue borrowing
                Denda::create([
                    'no_peminjaman' => $peminjaman->no_peminjaman,
                    'peminjamans_id' => $peminjaman->id,
                    'status' => 'unpaid', // Adjust status as per your application's logic
                    'total_denda' => number_format($dendaAmount, 0, ',', '.'), // Format as IDR
                    'lama_terlambat' => $lama_terlambat,
                ]);

                // Update the Peminjaman record with the calculated denda amount
                $peminjaman->update(['denda' => $dendaAmount]);
            }

            // Log success message to console
            $this->info('Denda calculation completed.');

        } catch (\Exception $e) {
            // Log and display any errors that occur during the process
            $this->error('Error calculating denda: ' . $e->getMessage());
        }
    }
}
