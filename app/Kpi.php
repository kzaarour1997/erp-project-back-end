<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    protected $table = 'kpi';

    protected $fillable = [ 'name' , 'value' , 'employees_id' ];

    public function employees_kpi(){

        return $this->belongsTo(Employees::class , 'employees_id' , 'id');
        }
}