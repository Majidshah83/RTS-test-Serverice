<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job_Type extends Model
{
    //

    protected $primaryKey='job_type_id';

    protected $table='job_typs';

    public $timestamps  = false;
    protected $fillable = array(
        'type_name',
        'test_criteria',
        'job_id',
      'result_status'
);
    public function jobType(){

        return $this->hasOne( 'App\Model\Projects','ad_id','job_id' );

    }

    

    public function answer(){

        return $this->hasOne( 'App\Models\AnswerKey','post_id','job_type_id' );

    }


}
