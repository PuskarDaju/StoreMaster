<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class regSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    

        //here
         $startDate = Carbon::create(2024, 1, 1);
        $endDate = Carbon::now();

        $cashierId = 1;

        // Loop through each month from startDate to endDate
        $current = $startDate->copy()->startOfMonth();

        while ($current->lte($endDate)) {
            // Generate random number of transactions for this month (at least 1)
            $transactionsCount = rand(1, 5);

            for ($i = 0; $i < $transactionsCount; $i++) {
                // Random day in current month
                $day = rand(1, $current->daysInMonth);

                $billDate = $current->copy()->day($day)
                    ->setTime(rand(8, 20), rand(0, 59), rand(0, 59));

                // Create unique bill number (e.g. B20240615001)
                $billNumber = 'B' . $billDate->format('Ymd') . Str::padLeft((string) rand(1, 999), 3, '0');

                // Create bill
                $billId = DB::table('bills')->insertGetId([
                    'bill_number' => $billNumber,
                    'cashier_id' => $cashierId,
                    'total_amount' => 0, // temp 0, will update after items
                    'paid_amount' => 0,  // temp 0
                    'change_amount' => 0, // temp 0
                    'created_at' => $billDate,
                    'updated_at' => $billDate,
                ]);

                $totalAmount = 0;

                // Add 1 to 5 bill items
                $itemsCount = rand(1, 5);

                for ($j = 0; $j < $itemsCount; $j++) {
                    $productId = rand(1, 25);
                    $quantity = rand(1, 10);
                    $price = rand(100, 1000); // random unit price
                    $subtotal = $quantity * $price;

                    $totalAmount += $subtotal;

                    DB::table('bill_items')->insert([
                        'bill_id' => $billId,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $subtotal,
                        'created_at' => $billDate,
                        'updated_at' => $billDate,
                    ]);
                }

                // Update bill total, paid and change (assume fully paid, no change)
                DB::table('bills')->where('id', $billId)->update([
                    'total_amount' => $totalAmount,
                    'paid_amount' => $totalAmount,
                    'change_amount' => 0,
                ]);
            }

            $current->addMonth();
        }

        $this->command->info('Bills and bill items seeded from Jan 2024 to today.');
    

    


    }
}
