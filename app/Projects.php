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
        return $this->belongsToMany(Employees::class , 'employees_roles_projects' , 'employee_id' , 'project_id');
    }
    public function team(){
        return $this->belongsToMany(Teams::class , 'teams_projects'  , 'project_id', 'team_id' );
    }

    public function roles(){
        return $this->belongsToMany(Roles::class , 'employees_roles_projects', 'project_id' ,'role_id' );
        // ,'employee_id' 
    }


}
