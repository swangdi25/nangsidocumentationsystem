<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    protected $table='tbl_divisions';
    protected $primaryKey = 'id';
    protected $fillable = ['id','division','agency_id'];
    public $timestamps = false;

}
