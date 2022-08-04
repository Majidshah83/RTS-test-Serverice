<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masters extends Model
{
    //
      //
    protected $primaryKey='master_id';
   
    protected $table='masters';

    public $timestamps  = false;

    protected $fillable = array(
	     
	      	'certificate_degree',
	      	'degree_sanad_title',
	      	'specialization_major_subject',
	      	'year_passing',
	      	'obtained_marks_cgpa',
	      	'total_marks_cgpa',
	      	'board_university',
	      	'candidate_id'

    );

}
