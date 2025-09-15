<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Poster extends Authenticatable
{
        /**
     * The authentication guard for Poster.
     *
     * @var string
     */
    protected $guard = 'poster';
    
    protected $table = 'posters';
    protected $fillable = ['phone', 'is_verified', 'is_active', 'otp'];
}
