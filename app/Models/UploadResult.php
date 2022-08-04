<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadResult extends Model

{
    //
    protected $primaryKey='id';
    protected $table='upload_results';
    public $timestamps  = false;
    public function CandidateInfo(){
        return $this->belongsTo('App\Model\CandidateInfo','candidate_id','candidate_id');
    }
    protected $fillable = array(
	      	'marks',
	      	'candidate_id',
    );


}
