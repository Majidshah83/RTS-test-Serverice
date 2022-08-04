<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploymentRecords extends Model
{
    //
    
    protected $primaryKey='employee_id';
   
    protected $table='employment_records';

    public $timestamps  = false;

    protected $fillable = array(

	      	'organization_employer_name1',
	      	'job_title1',
	      	'duration_from1',
	      	'duration_to1',
            'organization_employer_name2',
            'job_title2',
            'duration_from2',
            'duration_to2',
            'organization_employer_name3',
            'job_title3',
            'duration_from3',
            'duration_to3',
	      	'candidate_id'

    );

}

