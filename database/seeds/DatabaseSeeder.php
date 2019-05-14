<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $year = date('Y');

        // User
        $user = \App\User::create([
            'name' => 'Demo',
            'email' => 'demo@example.com',
            'password' => '$2y$10$Uv55v7f1V4HR6fFupy8RxOhC54wMFx.jToF/S7jvKqPh7XpO8hOae' // demopass
        ]);

        // Space
        $space = \App\Space::create([
            'currency_id' => 1,
            'name' => 'Demo Space'
        ]);

        $user->spaces()->attach($space);

        // Tags
        $tagBills = \App\Tag::create(['space_id' => $space->id, 'name' => 'Bills']);
        $tagFood = \App\Tag::create(['space_id' => $space->id, 'name' => 'Food']);
        $tagTransport = \App\Tag::create(['space_id' => $space->id, 'name' => 'Transport']);

        for ($i = 1; $i < 12; $i ++) {
            // Income
            \App\Earning::create([
                'space_id' => $space->id,
                'happened_on' => $year . '-' . $i . '-24',
                'description' => 'Wage',
                'amount' => 25000
            ]);

            // Bills
            \App\Spending::create([
                'space_id' => $space->id,
                'tag_id' => $tagBills->id,
                'happened_on' => $year . '-' . $i . '-01',
                'description' => 'Phone Subscription',
                'amount' => 2500
            ]);

            \App\Spending::create([
                'space_id' => $space->id,
                'tag_id' => $tagBills->id,
                'happened_on' => $year . '-' . $i . '-01',
                'description' => 'Car Insurance',
                'amount' => 4500
            ]);

            // Food
            for ($j = 0; $j < rand(1, 10); $j ++) {
                \App\Spending::create([
                    'space_id' => $space->id,
                    'tag_id' => $tagFood->id,
                    'happened_on' => $year . '-' . $i . '-' . rand(1, 28),
                    'description' => '-',
                    'amount' => 250 * rand(1, 5)
                ]);
            }

            // Transport
            for ($j = 0; $j < rand(1, 3); $j ++) {
                \App\Spending::create([
                    'space_id' => $space->id,
                    'tag_id' => $tagTransport->id,
                    'happened_on' => $year . '-' . $i . '-' . rand(1, 28),
                    'description' => '-',
                    'amount' => 1000 * rand(1, 5)
                ]);
            }
        }
    }
}
