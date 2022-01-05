<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterClass extends Model
{
    use HasFactory;
    protected $table='master_classes';
    protected $guarded=['id'];

    public function users()
    {
        return $this->belongsToMany(User::class,'master_class_user','user_id','master_class_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
