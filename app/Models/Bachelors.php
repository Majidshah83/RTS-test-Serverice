<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bachelors extends Model
{
    //
    protected $primaryKey='bachelor_id';
   
    protected $table='bachelors';

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
