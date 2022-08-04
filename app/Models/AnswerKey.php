<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerKey extends Model
{
   
    protected $table='answer_key';

    protected $fillable = array(
      	'post_id',
      	'key'
    );

}
