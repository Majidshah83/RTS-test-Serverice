<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
USE App\Model\Projects;
use App\Model\Job_Type;
use App\Model\Cities;
use App\Model\Province;
use App\Model\CandidateInfo;
use App\Model\AcademicInfo;
use App\Model\EmploymentRecords;
use App\Model\TotalExpirence;
use App\Model\Intermediate;
use App\Model\Bachelors;
use App\Model\Masters;
use App\Model\Professional1;
use App\Model\Professional2;
use App\Model\TestCenter;
use App\Model\RollSlip;
use App\Model\UploadResult;
use App\Model\SingleResult;
use App\Model\CompleteResults;
use Carbon\Carbon;
use DB;
use Session;
use Redirect;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allProjects=Projects::all();
        return view('admin.jobs.result')->with('allProjects',$allProjects);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $ProjectInfo = Projects::where('ad_id', $id)->get()->first();
        $allPost = Job_Type::where('job_id', $id)->get();
        return view('admin.jobs.upload_result')->with('ProjectInfo', $ProjectInfo)->with('allPost', $allPost);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //


        $this->validate($request, [
            'ad_id' => 'required',
            'job_title' => 'required',
            'post_id'=>'required',
            'result'=>'required',
        ]);

        return $request->all();

        if($request->hasFile('result')) {
            $path = $request->file('result')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $candidate = $this->CheckCandiate($request,$value->cnic);
                    if(!$candidate) {
                        continue;
                    }
                    $arr[] = ['marks' => $value->marks,'candidate_id'=> $candidate->candidate_id];
                }
                if(empty($arr)){
                    return redirect()->back()->with('error', 'Candiate not found.');
                }
                $sql=DB::table('upload_results')->insert($arr);
                if(!$sql){
                    return redirect()->back()->with('error', 'Not Uploaded');
                }
                $postType = Job_Type::where('job_type_id',$request->post_id)->update(['result_status' => true]);
                return redirect()->back()->with('success', 'Result uploaded successfully');
            }
        }
        return redirect()->back()->with('error', 'File not found.');
    }

    /*
      * @param $request
      * $return $candiate
    */

    public function CheckCandiate(Request $request,$cnic){
        $candidate=CandidateInfo::where([['nic',$cnic],['post_id',$request->post_id]])->get()->first();
        return $candidate;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $results = UploadResult::whereHas('CandidateInfo',function ($query) use ($id) {
            $query->whereJobId($id);
        })->get();
        return view('admin.jobs.total_result')->with('results',$results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ProjectInfo = Projects::where('ad_id', $id)->get()->first();
        $allPost = Job_Type::where('job_id', $id)->get();
        return view('admin.jobs.update_result')->with('ProjectInfo', $ProjectInfo)->with('allPost', $allPost);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'ad_id' => 'required',
            'job_title' => 'required',
            'post_id'=>'required',
            'result'=>'required',
        ]);
        if($request->hasFile('result')) {
            $path = $request->file('result')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $candidate = $this->CheckCandiate($request,$value->cnic);
                    $result_exist = UploadResult::where('candidate_id',$candidate->candidate_id)->get()->first();
                    if(!$candidate && !$result_exist) {
                        continue;
                    }
                    $arr= ['marks' => $value->marks];
                    $update = UploadResult::whereCandidateId($candidate->candidate_id)->update($arr);
                    if(!$update){
                        continue;
                    }
                }
                return redirect()->back()->with('success', 'Result Update successfully');
            }
        }
        return redirect()->back()->with('error', 'File not found.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resultStatusChange(Request $request){
        if($request->result_status == 0){
            $update_project = ['result_status' => false];
        }else{
            $complete_result = 0;
            if($request->complete_result){
                $complete_result = 1;
            }
            $update_project = ['result_status' => true,'complete_result' => $complete_result];
        }
        $sql = Projects::where('ad_id',$request->ad_id)->update($update_project);
        if(!$sql){
            return redirect()->back()->with('error','Changes not save');
        }
        return redirect()->back()->with('success','Changes save');
    }
}
