<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use App\Models\Denda;
use App\Models\Peminjaman;

class CalculateDendaCommandTest extends TestCase
{
    use RefreshDatabase; // Refreshes the database before each test

    /** @test */
    public function it_calculates_denda_for_overdue_peminjamans()
    {
        // Arrange: Create a Peminjaman record with a past return date and 'DiKonfirmasi' status
        $peminjaman = Peminjaman::factory()->create([
            'tgl_kembali' => Carbon::now()->subDays(5), // Example: 5 days overdue
            'status' => 'DiKonfirmasi',
            'denda' => null, // Ensure denda is null initially
        ]);

        // Act: Run the artisan command app:calculate-denda
        $this->artisan('app:calculate-denda')
            ->expectsOutput('Denda calculation completed.')
            ->assertExitCode(0); // Assert that the command exits successfully

        // Assert: Check that the denda record is created and updated correctly
        $this->assertDatabaseHas('dendas', [
            'no_peminjaman' => $peminjaman->no_peminjaman,
            'peminjamans_id' => $peminjaman->id,
            'status' => 'unpaid',
            // Add other assertions as per your database structure and expectations
        ]);

        $this->assertDatabaseHas('peminjamans', [
            'id' => $peminjaman->id,
            'denda' => 1000, // Ensure denda amount is updated correctly
        ]);
    }

    // Add more test methods for different scenarios as needed
}
