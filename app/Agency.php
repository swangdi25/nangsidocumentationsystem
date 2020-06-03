<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $table='tbl_agencies';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','dispatch_no'];
    public $timestamps = false;
}
