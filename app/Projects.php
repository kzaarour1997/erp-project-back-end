<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = "projects";
    
    protected $fillable = [
        'project_name' , 'description'
    ];
    
    public function employees(){
        return $this->belongsToMany(Employees::class);
    }
    public function team(){
        return $this->belongsToMany(Teams::class);
    }

}
