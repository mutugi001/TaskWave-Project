<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Member extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'profile_picture',
        'user_id',
        'team_id',
    ];

    public function teams()
    {
        return $this->belongsToMany(
            Team::class,        // Related model
            'member_team',      // Pivot table name
            'member_id',        // FK on pivot for this model
            'team_id'           // FK on pivot for related model
        );;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


