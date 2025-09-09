<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Option 1: Disable foreign key checks temporarily (Recommended for development)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables in correct order (child tables first, then parent tables)
        DB::table('job_listings')->truncate();
        DB::table('users')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('job_user_bookmarks')->truncate();

        // Option 2: Alternative approach using proper deletion order
        // DB::transaction(function () {
        //     // Delete child records first
        //     DB::table('job_listings')->delete();
        //     // Then delete parent records
        //     DB::table('users')->delete();
        // });
        $this->call(TestUserSeeder::class);
        $this->call(RandomUserSeeder::class);
        $this->call(JobSeeder::class);
         $this->call(BookmarkSeeder::class);
    }
}
