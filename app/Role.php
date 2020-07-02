<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'tbl_roles';
    protected $primaryKey = 'id';
    protected $fillable = ['id','Role'];
    public $timestamps = false;
}
