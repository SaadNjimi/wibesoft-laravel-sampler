<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    // Define relationship with Task
    public function tasks()
    {
        return $this->hasMany(Task::class, 'admin_id');
    }
}