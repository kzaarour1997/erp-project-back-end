<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams_Projects extends Model
{
    protected $table = "teams_projects";

    protected $fillable = [     
        'team_id','project_id'
     ]; 
}
