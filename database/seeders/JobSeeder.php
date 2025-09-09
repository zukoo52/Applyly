<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listing from the files
        $jobListings = include database_path('seeders/data/job_listings.php');

        // get test user id
        $testUserID = User::where('email', 'test@gmail.com')->value('id');

        // get other users id without test user because it already get
        $userIds = User::where('email', '!=', 'test@gmail.com')->pluck('id')->toArray();

        foreach ($jobListings as $index => &$listing) {

            if ($index < 2) {
                // assign first 2 joblisting to text user
                $listing['user_id'] = $testUserID;
            } else {
                // Assign user id to listings
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }


            //times stamp
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        DB::table('job_listings')->insert($jobListings);
        echo 'Jobs Created Sucssesfully';
    }
}
