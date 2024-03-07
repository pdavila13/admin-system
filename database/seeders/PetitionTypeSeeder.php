<?php

namespace Database\Seeders;

use App\Models\PetitionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetitionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petitionType = [
            'VPN3e', 
            'Firewall JX', 
            'Firewall NUS',
        ];

        foreach ($petitionType as $petitionTypeName) {
            PetitionType::create(['name' => $petitionTypeName]);
        }
    }
}