<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'reviewing',
            'description' => 'Application is under review by the management'
        ]);

        Status::create([
            'name' => 'verifying',
            'description' => 'Verifying information submitted with the applicant'
        ]);

        Status::create([
            'name' => 'approved',
            'description' => 'Grant approved'
        ]);

        Status::create([
            'name' => 'denied',
            'description' => 'Grant denied'
        ]);
    }
}
