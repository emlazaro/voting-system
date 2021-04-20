<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
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
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Jeri Barinaga',
            'email' => 'jbarinaga@poea.gov.ph',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'jdoe@poea.gov.ph',
            'password' => Hash::make('password'),
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
            'name' => 'Board of Directors',
            'max_selection' => 1,
        ]);

        Category::create([
            'name' => 'Audit and Inventory Committee',
            'max_selection' => 1,
        ]);

        Category::create([
            'name' => 'Election Committee',
            'max_selection' => 1,
        ]);

        Nominee::create([
            'category_id' => 1,
            'user_id' => 2
        ]);

        Nominee::create([
            'category_id' => 1,
            'user_id' => 3
        ]);

        Nominee::create([
            'category_id' => 2,
            'user_id' => 1
        ]);

        Nominee::create([
            'category_id' => 2,
            'user_id' => 4
        ]);

        Nominee::create([
            'category_id' => 2,
            'user_id' => 5
        ]);

        Nominee::create([
            'category_id' => 3,
            'user_id' => 6
        ]);

        // Vote::create([
        //     'voter_id' => 1,
        //     'nominee_id' => 1
        // ]);

        // Vote::create([
        //     'voter_id' => 1,
        //     'nominee_id' => 3
        // ]);

        // Vote::create([
        //     'voter_id' => 2,
        //     'nominee_id' => 1
        // ]);

        // Vote::create([
        //     'voter_id' => 2,
        //     'nominee_id' => 4
        // ]);
    }
}
