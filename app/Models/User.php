<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'laracon_uuid',
        'laracon_badge_scanned'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'laracon_badge_scanned' => 'boolean'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function opensourceProjects()
    {
        return $this->hasMany(OpensourceProject::class);
    }
}