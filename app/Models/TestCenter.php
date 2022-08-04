<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestCenter extends Model
{
    //
    protected $primaryKey='center_id';
   
    protected $table='test_center';

    public function city(){

        return $this->hasOne('App\Model\Cities','city_id','city_id');

    }
    
    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'center_name',
	      	'city_id',
	      	'candidate_per_center'
	      	
    );


}
