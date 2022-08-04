<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateInfo extends Model
{
    //
    protected $primaryKey='candidate_id';
    protected $table='candidate_info';

    public function academic(){
        return $this->hasOne('App\Model\AcademicInfo','candidate_id','candidate_id');
    }

    public function Results(){
        return $this->hasOne('App\Model\UploadResult','candidate_id','candidate_id');
    }

    public function intermediate(){
        return $this->hasOne('App\Model\Intermediate','candidate_id','candidate_id');
    }

    public function bachelor(){

        return $this->hasOne('App\Model\Bachelors','candidate_id','candidate_id');

    }
    public function eligibility(){

        return $this->hasOne('App\Model\Eligibility','candidate_id','id');

    }

    public function master(){

        return $this->hasOne('App\Model\Masters','candidate_id','candidate_id');

    }

    public function professional1(){

        return $this->hasOne('App\Model\Professional1','candidate_id','candidate_id');

    }

    public function professional2(){

        return $this->hasOne('App\Model\Professional2','candidate_id','candidate_id');

    }

    public function employmentRecord(){

        return $this->hasOne('App\Model\EmploymentRecords','candidate_id','candidate_id');

    }

    public function totalExpirence(){

        return $this->hasOne('App\Model\TotalExpirence','candidate_id','candidate_id');

    }

    public function testCity(){

        return $this->hasOne('App\Model\Cities','city_id','test_city_id');

    }

    public function post(){

        return $this->hasOne('App\Model\Projects','ad_id','job_id');

    }

    public function desiredPost(){

        return $this->hasOne('App\Model\Job_Type','job_type_id','post_id');

    }

    public function provinces(){

        return $this->hasOne('App\Model\Province','pro_id','province');

    }


    public function rollSlip(){

        return $this->hasOne('App\Model\RollSlip','candidate_id','candidate_id');

    }

    protected $fillable = array(

      	'full_name',
      	'father_name',
        'booking_id',
        'transaction_id',
      	'nic',
      	'gender',
      	'date_of_birth',
      	'marital_status',
      	'postal_address',
      	'mailing_address',
      	'province',
      	'district_id',
      	'phone_no',
      	'mobile_no',
      	'residential',
      	'religion',
      	'disabled',
      	'g_servent',
      	'test_city_id',
      	'upload_image',
      	'domicile',
      	'bank_code',
      	'deposit_date',
      	'photo',
      	'educational_certificates',
      	'domicile_cnic',
        'bank_name',
      	'bank_slip',
      	'post_id',
        'status',
        'roll_slip_status',
      	'job_id'

    );

}
