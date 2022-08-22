<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
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
            'email' => 'elazaro@dmw.gov.ph',
            'password' => Hash::make('admin123'),
            'phone_number' => '+639774739819',
            'role' => 'admin',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Ricky Capin',
            'email' => 'rcapin@dmw.gov.ph',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Jeri Barinaga',
            'email' => 'jbarinaga@dmw.gov.ph',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'jdoe@dmw.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jdoe2@dmw.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Test1 Doe',
            'email' => 'test1@dmw.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Test2 Doe',
            'email' => 'test2@dmw.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Test3 Doe',
            'email' => 'test3@dmw.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        Category::create([
            'name' => 'Board of Directors',
            'max_selection' => 2,
        ]);

        Category::create([
            'name' => 'Audit and Inventory Committee',
            'max_selection' => 2,
        ]);

        Category::create([
            'name' => 'Election Committee',
            'max_selection' => 2,
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
