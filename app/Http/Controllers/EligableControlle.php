<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Models\Projects;
use App\Models\Job_Type;
use App\Models\Cities;
use App\Models\Province;
use App\Models\CandidateInfo;
use App\Models\AcademicInfo;
use App\Models\EmploymentRecords;
use App\Models\TotalExpirence;
use App\Models\Intermediate;
use App\Models\Bachelors;
use App\Models\Masters;
use App\Models\Professional1;
use App\Models\Professional2;
use App\Models\TestCenter;
use App\Models\RollSlip;
use App\Models\Eligibility;
use App\Models\UploadResult;
use App\Models\SingleResult;
use \setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Response;

use Carbon\Carbon;
use DB;
use Session;
use Redirect;
use Auth;
use PDF;
use App\Mail\SendMailable;
use Mail;
class EligableControlle extends Controller
{
    public function applicationList(){
        $projects = Projects::orderBy("ad_id",'desc')->get();
      
     
        return view('frontend.eligable.eligible')->with('projects',$projects);
    }
    public function applicationStatus($id='') {
        if ($id){
            $postType = Job_Type::where('job_id',$id)->get();
            $projectId = $id;
            return view('frontend.eligable.statusdetails')
                ->with('postType', $postType)
                ->with('projectId', $projectId);
        }else {
            return redirect('/application-lists');
        }
    }

    public function checkEligibilityStatus(Request $request) {

        $candidateInfo = CandidateInfo::where('nic', $request->cnic)
                                        ->where('job_id', $request->project_id)
                                        ->where('post_id', $request->post_id)
                                        ->first();
        if ($candidateInfo) {
            $cnic = $candidateInfo->nic;
            $name = $candidateInfo->full_name;
            $status = $candidateInfo->status;
            $table = '<table class="table table-responsive table-bordered table-hover">'.'
                        <thead><th>CNIC</th><th>Name</th><th>Status</th></thead>'.'
                        <tbody><td>'.$cnic.'</td><td>'.$name.'</td><td>'.$status.'</td></tbody></table>';
            $arr = array('result' => $table, 'msg' => 'Found Successfully!', 'status' => true);
        }else {
            $arr = array('result' => '', 'msg' => 'Record Not Found!, Please try again later', 'status' => false);
        }
        return Response()->json($arr);
    }

   
}
