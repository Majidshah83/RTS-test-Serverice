<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperPattern extends Model
{
    protected $primaryKey='id';
   
    protected $table='paper_patterns';

    public function project(){

        return $this->belongsTo('App\Model\Projects','job_id','ad_id');

    }

    protected $fillable = array(
	      	'job_id',
	      	'file',
	      	'status'
    );
}
