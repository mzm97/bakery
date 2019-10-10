<?php

use Illuminate\Database\Seeder;
use App\Reg;

class RegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regs')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
        Reg::insert([
            'days' => '30',
            'reg_code' => Hash::make('abc_de@12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
