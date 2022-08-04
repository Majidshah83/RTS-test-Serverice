<?php

 namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //

    protected $primaryKey='ad_id';

    protected $table='advertisement_jobs';
    
    protected $fillable = array(

        'ad_title',
        'ad_last_date_submission',
        'ad_image',
        'ad_form',
      'status',
      'result_status',
      'complete_result'

);
    public function jobType(){

        return $this->hasOne('App\Model\Job_Type','job_id','ad_id');

    }

    public function resultProject(){

        return $this->hasOne('App\Model\UploadResult','job_id','ad_id');

    }

    public function paperPattern(){

        return $this->hasOne('App\Model\PaperPattern','job_id','ad_id');

    }

  

}
