<?php

namespace App\Http\Controllers;
use App\Models\CandidateInfo;
use App\Models\Job_Type;
use App\Models\Projects;
use App\Models\News;
use App\Models\UploadResult;
use App\Models\PaperPattern;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $all_projects = Projects::orderBy("ad_id",'desc')->get();

        return view('frontend.project.index')->with('all_projects',$all_projects);
    }
    public function projectDetail($id){
        
        $postType=Job_Type::where('job_id',$id)->get();
       
		return view('frontend.project.detail')->with('postType',$postType);

    }
}
