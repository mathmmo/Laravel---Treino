<?php

namespace App\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $hidden = ['password', 'remember_token',];
    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'password','permission'];
}