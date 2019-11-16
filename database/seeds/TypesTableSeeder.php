<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'individual',
            'description' => 'personal grant application'
        ]);

        Type::create([
            'name' => 'corporate',
            'description' => 'corporate grant application'
        ]);
    }
}
