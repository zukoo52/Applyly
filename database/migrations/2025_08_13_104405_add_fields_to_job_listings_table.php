<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add FK only if missing
        if (! Schema::hasColumn('job_listings', 'user_id')) {
            Schema::table('job_listings', function (Blueprint $table) {
                $table->foreignId('user_id')->after('id')
                      ->constrained()        // references users(id)
                      ->cascadeOnDelete();
            });
        }

        // Add other columns only if missing (safe to re-run)
        Schema::table('job_listings', function (Blueprint $table) {
            if (! Schema::hasColumn('job_listings', 'salary'))               $table->integer('salary');
            if (! Schema::hasColumn('job_listings', 'tags'))                 $table->string('tags')->nullable();
            if (! Schema::hasColumn('job_listings', 'job_type'))             $table->enum('job_type', [
                                                                              'Full-Time','Part-Time','Contract','Temporary',
                                                                              'Internship','Volunteer','On-Call'
                                                                            ])->default('Full-Time');
            if (! Schema::hasColumn('job_listings', 'remote'))               $table->boolean('remote')->default(false);
            if (! Schema::hasColumn('job_listings', 'requirements'))         $table->text('requirements')->nullable();
            if (! Schema::hasColumn('job_listings', 'benefits'))             $table->text('benefits')->nullable();
            if (! Schema::hasColumn('job_listings', 'address'))              $table->string('address')->nullable();
            if (! Schema::hasColumn('job_listings', 'city'))                 $table->string('city');
            if (! Schema::hasColumn('job_listings', 'state'))                $table->string('state');
            if (! Schema::hasColumn('job_listings', 'zipcode'))              $table->string('zipcode')->nullable();
            if (! Schema::hasColumn('job_listings', 'contact_email'))        $table->string('contact_email');
            if (! Schema::hasColumn('job_listings', 'contact_phone'))        $table->string('contact_phone')->nullable();
            if (! Schema::hasColumn('job_listings', 'company_name'))         $table->string('company_name');
            if (! Schema::hasColumn('job_listings', 'company_description'))  $table->text('company_description')->nullable();
            if (! Schema::hasColumn('job_listings', 'company_logo'))         $table->string('company_logo')->nullable();
            if (! Schema::hasColumn('job_listings', 'company_website'))      $table->string('company_website')->nullable();
        });
    }

    public function down(): void
    {
        // Drop FK + column only if present
        if (Schema::hasColumn('job_listings', 'user_id')) {
            Schema::table('job_listings', function (Blueprint $table) {
                // default FK name: job_listings_user_id_foreign
                try { $table->dropForeign(['user_id']); } catch (\Throwable $e) {}
                $table->dropColumn('user_id');
            });
        }

        $cols = [
            'salary','tags','job_type','remote','requirements','benefits',
            'address','city','state','zipcode','contact_email','contact_phone',
            'company_name','company_description','company_logo','company_website',
        ];

        $toDrop = array_values(array_filter($cols, fn ($c) => Schema::hasColumn('job_listings', $c)));
        if ($toDrop) {
            Schema::table('job_listings', function (Blueprint $table) use ($toDrop) {
                $table->dropColumn($toDrop);
            });
        }
    }
};
