<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Avatar;

class AvatarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $avatar = [
            [
                'image' => 'avatar1.jpg',
                'price' => 50
            ],
            [
                'image' => 'avatar2.jpg',
                'price' => 100
            ],
            [
                'image' => 'avatar3.jpg',
                'price' => 150
            ],
        ];

        foreach($avatar as $a){
            Avatar::create(array_merge($a, [
                'image' => file_get_contents(public_path('asset/avatar/'.$a['image']))
            ]));
        }
    }
}
