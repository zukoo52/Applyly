<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\job;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get the text user
        $testuser = User::where('email', 'test@gmail.com')->firstOrFail();

        //get all job ids
        $jobIds = job::pluck('id')->toArray();
        
        //randomly select jobs to BookMArks
        $randomJobId = array_rand($jobIds , 3);

        // attach the selected jobs as bookmarks for the test users
        foreach($randomJobId as $jobID){
            $testuser->bookmarkedJobs()->attach($jobIds[$jobID]);
        }
    }
}
