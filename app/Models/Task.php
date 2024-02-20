<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['task_time', 'title', 'description', 'admin_id'];

    // Define relationship with Administrator
    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'admin_id');
    }

    // Define accessor to get the formatted task time
    public function getFormattedTaskTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['task_time'])->format('Y-m-d H:i:s');
    }
}
