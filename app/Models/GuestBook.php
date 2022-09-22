<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    protected $fillable = ['username', 'email', 'link', 'text', 'captcha', 'IP', 'browser'];
}
