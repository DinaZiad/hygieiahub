<?php

namespace App\Exports;

use App\Models\Questionnaire1;
use App\Models\QuestionnaireOne;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class dataExport implements FromCollection, WithHeadings
{
    protected $dates;

    public function __construct()
    {
        $this->dates = collect();

        // Start from 6 days ago up to today
        for ($i = 6; $i >= 0; $i--) {
            $this->dates->push(Carbon::today()->subDays($i)->format('Y-m-d'));
        }
    }

    public function collection()
    {
        $items = [
            'King Fitted Sheets',
            'King Flat Sheets',
            'King Duvet Covers',
            'King Mattress Protector',
            'Queen Fitted Sheets',
            'Queen Flat Sheets',
            'Queen Duvet Covers',
            'Queen Mattress Protector',
            'Single Fitted Sheets',
            'Single Flat Sheets',
            'Single Duvet Covers',
            'Single Mattress Protector',
            'Bath Towels',
            'Hand Towels',
            'Face Cloths',
            'Bath Mats',
        ];

        $collection = collect();

        foreach ($items as $item) {
            $row = [$item]; // Start row with the item name

            $totalProvided = 0;
            $totalRemoved = 0;

            foreach ($this->dates as $date) {
                $providedSum = QuestionnaireOne::whereDate('created_at', $date)
                    ->get()
                    ->sum(function ($q) use ($item) {
                        $provided = json_decode($q->provided_items, true);
                        return isset($provided[$item]) ? (int)$provided[$item] : 0;
                    });

                $removedSum = QuestionnaireOne::whereDate('created_at', $date)
                    ->get()
                    ->sum(function ($q) use ($item) {
                        $removed = json_decode($q->removed_items, true);
                        return isset($removed[$item]) ? (int)$removed[$item] : 0;
                    });

                // Always push a number even if 0
                $net = $providedSum - $removedSum;
                $row[] = $net ?? 0;

                $totalProvided += $providedSum;
                $totalRemoved += $removedSum;
            }

            $row[] = $totalProvided;
            $row[] = $totalRemoved;
            $row[] = $totalProvided - $totalRemoved; // Missing

            $collection->push($row);
        }

        return $collection;
    }

    public function headings(): array
    {
        $headers = ['Item'];

        foreach ($this->dates as $date) {
            $headers[] = Carbon::parse($date)->format('m/d/Y'); // <-- MM/DD/YYYY now
        }

        $headers[] = 'Total Provided';
        $headers[] = 'Total Removed';
        $headers[] = 'Missing';

        return $headers;
    }
}
