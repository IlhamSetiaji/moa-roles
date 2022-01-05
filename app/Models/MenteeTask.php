<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenteeTask extends Model
{
    use HasFactory;
    protected $table='mentee_tasks';
    protected $guarded=['id'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function mentee_task_files()
    {
        return $this->belongsToMany(User::class,'mentee_task_files','user_id','mentee_task_id')->withPivot('file_name')->withTimestamps();
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
}
