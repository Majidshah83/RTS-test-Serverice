<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollSlip extends Model
{
    //
    
    protected $primaryKey='id';
   
    protected $table='rollno_slips';

    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'roll_no_slip',
	      	'test_date',
	      	'test_time',
	      	'test_center',
	      	'candidate_id'
	      	
    );
    public function centerName(){

        return $this->hasOne('App\Model\TestCenter','center_id','test_center');

    }
    public function projects(){

        return $this->hasOne('App\Model\Projects','roll_id','id');

    }
    
    

}
