<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];
}
