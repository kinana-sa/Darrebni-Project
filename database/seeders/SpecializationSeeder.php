<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Specialization = [
            'اوتومات',
            'المترجمات',
            'قواعد المعطيات',
            'الذكاء الاصطناعي',
            'هندسة البرمجيات',
            'خوارزميات',
            'امن المعلومات',
            'الشبكات',
            'داتابيز'

        ];
        foreach ($Specialization as $sp) {
            Specialization::create([
                'specialization_name' => $sp,
                'collage_id' => '1'
            ]);
        }
    }
}