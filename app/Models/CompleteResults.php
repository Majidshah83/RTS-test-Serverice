<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompleteResults extends Model
{
    protected $table='complete_results';
    protected $fillable = [
        'post_id','result_file'
        ];


}
