<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpensourceProject extends Model
{
    use HasFactory;

    protected $table = 'opensource_projects';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'github_url',
        'demo_url',
        'image_url',
        'tags',
        'stars',
        'forks',
        'featured',
        'active'
    ];

    protected $casts = [
        'tags' => 'array',
        'stars' => 'integer',
        'forks' => 'integer',
        'featured' => 'boolean',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}