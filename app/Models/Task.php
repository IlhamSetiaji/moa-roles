<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $guarded=['id'];

    public function master_classes()
    {
        return $this->belongsTo(MasterClass::class,'master_class_id');
    }

    public function mentee_tasks()
    {
        return $this->hasMany(MenteeTask::class);
    }
}
