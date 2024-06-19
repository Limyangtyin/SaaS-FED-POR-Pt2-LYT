<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get the Admin and Staff roles for the Administrator, Lecturer and Student
        $roleAdmin = Role::whereName('Admin')->first();
        $roleStaff = Role::whereName('Staff')->first();
        $roleClient = Role::whereName('Client')->first();

        // Create Admin User and assign the role to him.
        $userAdmin = User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password1'),
            'email_verified_at' => now(),
        ]);
        $userAdmin->assignRole([$roleAdmin]);

        // Create Staff
        $userStaff = User::create([
            'id' => 2,
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('Password1'),
            'email_verified_at' => now(),
        ]);
        $userStaff->assignRole([$roleStaff]);

        // Create Client
        $userClient = User::create([
            'id' => 3,
            'name' => 'Client',
            'email' => 'client@example.com',
            'password' => Hash::make('Password1'),
            'email_verified_at' => now(),
        ]);
        $userClient->assignRole([$roleClient]);

        // Additional Seed Users
        $seedUsers = [
            [
                'name' => 'Ivanna Vinn',
                'email' => 'ivanna.vinn@example.com',
            ],
            [
                'name' => 'Russ Round',
                'email' => 'russ.hin-around@example.com',
            ],
            [
                'name' => 'Chip Buttie',
                'email' => 'chip.buttie@example.com',
            ],
            [
                'name' => 'Annie Wun',
                'email' => 'annie.wun@example.com',
            ],
            [
                'name' => 'Andy Mann',
                'email' => 'andy.mann@example.com',
            ],
            [
                "name" => "April Schauer",
                "email" => "April.Schauer@example.com",
            ],
            [
                "name" => "Al K. Seltzer",
                "email" => "Al.K.Seltzer@example.com",
            ],
            [
                "name" => "Dee Sember",
                "email" => "Dee.Sember@example.com",
            ],
            [
                "name" => "Jo Kerr",
                "email" => "Jo.Kerr@example.com",
            ],
            [
                "name" => "Izzy Kidding",
                "email" => "Izzy.Kidding@example.com",
            ],
        ];

        $newUsers = [];

        foreach ($seedUsers as $seedUser) {
            $newUser = User::factory()->create($seedUser);
            $newUsers[] = $newUser;
        }

        foreach ($newUsers as $newUser) {
            $newUser->assignRole([$roleClient]);
        }

//         foreach($seedUsers as $seedUser){
//            $newUser = User::create(array_merge($seedUser));
//            $newUser ->assignRole($roleClient);
//        }
    }
}
