<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $primaryKey='dist_id';
   
    protected $table='districts';

    public function province(){

        return $this->hasOne('App\Model\Province','pro_id','pro_id');

    }
    
    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'dist_name',
	      	'pro_id'
	      	
    );

}
