<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';

    protected $fillable = [ 'image' , 'identity' , 'firstname' , 'lastname' , 'email' , 'phone' , 'team_id' ];
     

    public function teams(){

    return $this->belongsTo(Teams::class , 'team_id' , 'id');
    }

    public function kpis(){
        return $this->hasMany(Kpi::class , 'employees_id' , 'id');
    }
    
    // public function projects(){
    //     return $this->belongsToMany(Projects::class , 'employees_roles_projects','employee_id','project_id','role_id');
    // }

    public function roles(){
        return $this->belongsToMany(Roles::class , 'employees_roles_projects', 'employee_id','role_id');
        // 'projects'
    }

    public function projects(){
        return $this->belongsToMany('App\Projects' , 'employees_roles_projects' , 'employee_id' , 'project_id')->using('App\Employees_Projects_Roles')->withPivot('role_id');
    }
    
}