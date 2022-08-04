<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $primaryKey='pro_id';
   
    protected $table='provinces';
    
    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'pro_name',
	      	
    );
}
