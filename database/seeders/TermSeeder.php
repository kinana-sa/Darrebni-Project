<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::create([
            'term_name' => 'دورة تشرين 2022',
            'collage_id' => '1'
        ]);
        Term::create([
            'term_name' => 'دورة ايار 2023',
            'collage_id' => '1'
        ]);
        Term::create([
            'term_name' => 'دورة اذار 2020',
            'collage_id' => '6'
        ]);
    }
}