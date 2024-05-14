<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("point_types")->insert([
            ['type' => 'Swiper_add','points'=>0.03],
            ['type' => 'Swiper_del','points'=>0.01],
            ['type' => 'Image','points'=>0.3],
            ['type' => 'Reel','points'=>0.3],
            ['type' => 'Achievement','points'=>0.25]
        ]);
    }
}
