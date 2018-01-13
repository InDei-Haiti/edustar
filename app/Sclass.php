<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sclass extends Model
{
    use SoftDeletes;
    
    protected $dates =['deteted_at'];
    
    protected $fillable =['name'];
}
