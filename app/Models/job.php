<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class job extends Model
{
    use HasFactory;
    protected $table = 'job_listings';
    protected $fillable = [
        'title',
        'description',
        'salary',
        'tags',
        'job_type',
        'remote',
        'requirements',
        'benefits',
        'address',
        'city',
        'state',
        'zipcode',
        'contact_email',
        'contact_phone',
        'company_name',
        'company_description',
        'company_logo',
        'company_website',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relation to BookMark
    public function bookmarkedByusers(): BelongsToMany
    {
        return $this->belongsToMany(user::class, 'job_user_bookmarks')->withTimestamps();
    }
    //realation to applicant
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
