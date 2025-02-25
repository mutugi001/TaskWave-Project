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
        'team_id',
    ];
}
