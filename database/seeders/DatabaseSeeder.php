<?php

namespace Database\Seeders;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $users = User::factory(10)->create();
         $colocation = Colocation::factory()->create();
         $owner = $users->random();

         $colocation->users()->attach($owner->id, [
        'role' => 'owner',
        'joined_at' => now(),
        ]);

        $members = $users->where('id' , '!=' ,$owner->id)->random(3); 
       
         $colocation->users()->attach($members->pluck('id'), [
            'role' => 'member',
            'joined_at' => now(),
         ]);
        
    }
}
