<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DateFormat;
use App\Models\TimeFormat;
use Carbon\Carbon;

class DateTimeFormatSeeder extends Seeder
{
    public function run(): void
    {
        // 📅 Date Formats
        $dateFormats = [
            'd-m-Y', 'd/m/Y', 'm-d-Y', 'Y-m-d', 'j M Y',
            'd F Y', 'D, d M Y', 'l, d F Y', 'Y/m/d', 'd.m.Y',
            'M d, Y', 'F d, Y', 'Y', 'm/Y', 'M Y'
        ];

        foreach ($dateFormats as $format) {
            DateFormat::updateOrCreate(
                ['format' => $format],
                ['example' => Carbon::now()->format($format)]
            );
        }

        // ⏰ Time Formats
        $timeFormats = [
            'H:i:s', 'h:i:s A', 'H:i', 'h:i A', 'g:i A',
            'G:i:s', 'H:i:s.v'
        ];

        foreach ($timeFormats as $format) {
            TimeFormat::updateOrCreate(
                ['format' => $format],
                ['example' => Carbon::now()->format($format)]
            );
        }
        $this->command->info('Date And Time Format seeded successfully!');
    }
}
