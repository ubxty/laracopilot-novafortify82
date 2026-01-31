<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'short_description',
        'full_description',
        'project_type',
        'github_url',
        'demo_url',
        'documentation_url',
        'stars',
        'forks',
        'tags',
        'is_featured',
        'is_published'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'stars' => 'integer',
        'forks' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('name')) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}