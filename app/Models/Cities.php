<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    //
    protected $primaryKey='city_id';
   
    protected $table='cities';

    public function province(){

        return $this->hasOne('App\Model\Province','pro_id','pro_id');

    }
    
    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'city_name',
	      	'pro_id'
	      	
    );
}
