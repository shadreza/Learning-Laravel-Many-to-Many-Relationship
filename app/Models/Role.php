<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // adding mass assignment
    // allowing insertion by name
    protected $fillable = [
        'name'
    ];

    // this is for the many to many relationship
    // Role model will call this function
    // user table & pivot table will be processed
    // for create -> new user will be added and the pivot table will change
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
