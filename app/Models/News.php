<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // 
    protected $primaryKey='id';
    protected $table='news';
    protected $fillable = array(
	      	'project_id',
	      	'news',
            'annoucement_type'
    );
    public function Project(){
        return $this->hasOne('App\Model\Projects','ad_id','project_id');
    }


}
