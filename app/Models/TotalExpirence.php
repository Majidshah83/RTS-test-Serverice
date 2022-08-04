<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalExpirence extends Model
{
    //
     //
    protected $primaryKey='exp_id';
   
    protected $table='total_experience';

    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'days',
	      	'month',
	      	'years',
	      	'candidate_id'
	      	
    );

}
