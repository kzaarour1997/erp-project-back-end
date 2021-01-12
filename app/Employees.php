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
}