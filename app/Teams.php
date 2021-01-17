<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    protected $fillable = [     
        'name'
     ];

    public function employees(){
        return $this->hasMany(Employees::class , 'team_id' , 'id');
    }

    public function projects(){
        return $this->belongsToMany(Projects::class , 'teams_projects','team_id','project_id');
    }


}