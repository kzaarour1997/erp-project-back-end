<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Employees_Projects_Roles extends Pivot
{
 protected $table = "employees_roles_projects";

 protected $fillable = [
     'role_id', 'project_id' , 'employee_id'
 ];
 
}
