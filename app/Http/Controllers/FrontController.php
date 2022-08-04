<?php

namespace App\Http\Controllers;
use App\Models\CandidateInfo;
use App\Models\Job_Type;
use App\Models\Projects;
use App\Models\News;
use App\Models\UploadResult;
use App\Models\PaperPattern;

use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function index() {
        $latestProjects = Projects::orderBy("ad_id",'desc')->take(3)->get();
        $latestNews = News::orderBy("id",'desc')->take(10)->get();
        $applicationstatus = Projects::orderBy("ad_id",'desc')->get();
        $projectsWithResult = Projects::where('result_status', '!=', 0)->orderBy("ad_id",'desc')->get();

        return view('frontend.home')
                ->with('latestProjects', $latestProjects)
                ->with('projectsWithResult', $projectsWithResult)
                ->with('applicationstatus', $applicationstatus)
                ->with('latestNews',$latestNews);
        
       
    }

    public function aboutUs() {
        return view('frontend.pages.about');
    }

    public function contactUs() {
        return view('frontend.pages.contact');
    }
   
    public function results() {
        return view('frontend.pages.result');
    }
   
    
    
  
}
