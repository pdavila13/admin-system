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
        $petitionTypes = [
            'VPN3e', 
            'Firewall JX', 
            'Firewall NUS',
        ];

        foreach ($petitionTypes as $petitionTypeName) {
            PetitionType::create(['name' => $petitionTypeName]);
        }
    }
}