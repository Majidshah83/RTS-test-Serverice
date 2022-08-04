<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SingleResult extends Model
{
    //
    protected $primaryKey='id';
    protected $table='upload_results';
      
    public function candidateinfo(){
        return $this->hasOne('App\Model\CandidateInfo','candidate_id','candidate_id');
    }

    public $timestamps  = false;
    protected $fillable = array(
      	'result',
      	'job_id',
      	'post_id',
      	'cnic',
      	'candidate_id'
    );
}
