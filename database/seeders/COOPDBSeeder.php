<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Nominee;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class COOPDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Eduardo Lazaro III',
            'email' => 'elazaro@poea.gov.ph',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Ricky Capin',
            'email' => 'rcapin@poea.gov.ph',
            'password' => Hash::make('admin123'),
            'nominee_id' => 1,
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Jeri Barinaga',
            'email' => 'jbarinaga@poea.gov.ph',
            'password' => Hash::make('admin123'),
            'nominee_id' => 2,
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'jdoe@poea.gov.ph',
            'password' => Hash::make('password'),
            'nominee_id' => 3,
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jdoe2@poea.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Test Doe',
            'email' => 'tdoe2@poea.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Test2 Doe',
            'email' => 't2doe2@poea.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Test3 Doe',
            'email' => 't3doe2@poea.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        Category::create([
            'name' => 'President',
            'max_selection' => 1,
        ]);

        Category::create([
            'name' => 'Vice President',
            'max_selection' => 1,
        ]);

        Category::create([
            'name' => 'Secretary',
            'max_selection' => 1,
        ]);

        Category::create([
            'name' => 'Officers',
            'max_selection' => 2,
        ]);

        Nominee::create([
            'user_id' => 2,
            'category_id' => 1,
            'nominated_by' => 1
        ]);

        Nominee::create([
            'user_id' => 3,
            'category_id' => 1,
            'nominated_by' => 1
        ]);

        Nominee::create([
            'user_id' => 1,
            'category_id' => 2,
            'nominated_by' => 2
        ]);
    }
}
