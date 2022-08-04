<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
	protected $primaryKey='id';
   
    protected $table='eligibility';

    protected $fillable = array(
	      	'candidate_id',
	      	'post_id',
	      	'status'
    );
	public function candidates(){

        return $this->hasOne('App\Models\CandidateInfo','candidate_id','candidate_id');

    }
}
