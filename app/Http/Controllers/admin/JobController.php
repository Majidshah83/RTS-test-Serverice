<?php

namespace App\Http\Controllers\admin;

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
use App\Model\PaperPattern;
use Carbon\Carbon;
use DB;
use Session;
use Redirect;

class JobController extends Controller
{
    //
    public function currentJobs()

    {
    	# code...
            $allProjects=Projects::all();
    	    return view('admin.jobs.current_jobs')->with('allProjects',$allProjects);

    }


    public function createJobs()

    {
    	# code...

    	    return view('admin.jobs.add_jobs');

    }

       public function addJobs(Request $request)

    {
    	# code...

                $this->validate($request, [
                  'job_title' => 'required|max:1000',
                  'ad_image' => 'image|mimes:jpg,png,jpeg|max:5000',
                  'apply_type'=>'required|max:255',
                ]);

                DB::beginTransaction();
                try{

                  $ad_image = $request->ad_image;
                  $fileName = time().'.'.$ad_image->getClientOriginalName();
                  $destinationPath = public_path('/public/projectimages');
                  $ad_image->move($destinationPath,$fileName);
                  $ad_form = $request->ad_form;
                  if(!empty($ad_form)){
                    $form = time().'.'.$ad_form->getClientOriginalName();
                    $destinationPath = public_path('/public/projectimages');
                    $ad_form->move($destinationPath,$form);
                  }else{
                    $form = null;
                  }
                  $sql=Projects::create(array(
                      'ad_title' => $request->job_title,
                      'ad_last_date_submission' => $request->job_last_date,
                      'ad_image' =>$fileName,
                      'ad_form'=>$form,
                      'status'=>$request->apply_type,
                  ));

                if($sql){

                        DB::commit();

                }

                if(!empty($request->post_type)){

                  $id=$sql->ad_id;
                  foreach (explode(',', $request->post_type) as $key => $value) {
                      # code...
                      Job_Type::create(array(

                            'type_name' => $value,
                            'job_id'=>$id,

                      ));
                  }

                }

                if($sql){

                        Session::flash('success', 'New project upload succcesfully');
                        DB::commit();
                        return redirect('/current/projects');

                  }else{

                        Session::flash('success', 'New project upload succcesfully');
                        return redirect('/current/projects');

                }

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    // return Redirect::back();
                    return $e->getMessage().''.$e->getLine();
                }

    }


    public function editProject($id)

    {
        # code...
        $editProjects=Projects::where('ad_id',$id)->get()->first();
        return view('admin.jobs.edit_project')->with('editProject',$editProjects);

    }


    public function updateProject(Request $request){


                $this->validate($request, [
                      'job_title' => 'required|max:1000',
                      'job_last_date' => 'required|max:255',
                ]);

                DB::beginTransaction();

                try{

                    if($request->ad_image!=null){

                      $this->validate($request, [
                        'ad_image' => 'image|mimes:jpg,png,jpeg|max:5000',
                      ]);

                    }if($request->ad_image!=null){

                          $ad_image =$request->ad_image;
                          $fileName = time().'.'.$ad_image->getClientOriginalName();
                          $destinationPath = public_path('/public/projectimages');
                          $Image = $fileName;
                          $ad_image->move($destinationPath,$fileName);

                    }else{

                           $Image =$request->old_image;

                    }

                     if($request->ad_form!=null){

                      $this->validate($request, [
                        'ad_form' => 'required',
                      ]);

                    }if($request->ad_form!=null){


                          $ad_form = $request->ad_form;
                          $form = time().'.'.$ad_form->getClientOriginalName();
                          $destinationPath = public_path('/public/projectimages');
                          $newForm = $form;
                          $ad_form->move($destinationPath,$form);

                    }else{

                           $newForm =$request->old_form;

                    }


                    $update = array(

                          'ad_title' => $request->job_title,
                          'ad_last_date_submission' => $request->job_last_date,
                          'ad_image' =>$Image,
                          'ad_form' =>$newForm,
                          'status'=>$request->apply_type,

                    );

                    $sql = Projects::where('ad_id', $request->id)->update($update);

                    if($sql){

                        Session::flash('update', 'Project Updated Successfully');
                        DB::commit();
                        return redirect('/current/projects');


                    }else{

                        Session::flash('update', 'Project Not Updated Successfully');
                        return redirect('/current/projects');


                    }

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    // return Redirect::back();
                       return $e->getMessage().''.$e->getLine();
                }


    }

    public function projectDelete(Request $request)

    {
        # code...
                $id=$request->id;
                $allCandidate=CandidateInfo::where('job_id',$request->id)->get();

                foreach ($allCandidate as $key => $value) {

                  # code...

                    CandidateInfo::where('candidate_id',$value->candidate_id)->delete();
                    AcademicInfo::where('candidate_id',$value->candidate_id)->delete();
                    Intermediate::where('candidate_id',$value->candidate_id)->delete();
                    Bachelors::where('candidate_id',$value->candidate_id)->delete();
                    Masters::where('candidate_id',$value->candidate_id)->delete();
                    Professional1::where('candidate_id',$value->candidate_id)->delete();
                    Professional2::where('candidate_id',$value->candidate_id)->delete();
                    EmploymentRecords::where('candidate_id',$value->candidate_id)->delete();
                    TotalExpirence::where('candidate_id',$value->candidate_id)->delete();


                }

                $delete=Projects::where('ad_id',$id)->delete();
                $deletePost=Job_Type::where('job_id',$id)->delete();


                if($delete){

                  return "Project Deleted Successfully";

                }else{

                  return "Project Not Deleted Successfully";

                }

    }

    public function postApplyCandidate($id)

    {

      # code...

            $allCandidate=CandidateInfo::where('job_id',$id)->get();
            $totalCandidate=CandidateInfo::where('job_id',$id)->get()->count();
            $projectInfo=Projects::where('ad_id',$id)->get()->first();

            $all_Post=Job_Type::where('job_id',$id)->get();


            return view('admin.jobs.apply_candidate')->with('id',$id)->with('allCandidate',$allCandidate)->with('projectInfo',$projectInfo)->with('totalCandidate',$totalCandidate)->with('all_Post', $all_Post);;

    }



    public function addApplyCandidate($id)

    {

      # code...

            $allCity=Cities::all();
            $allProvince=Province::all();
            $jobType=Job_Type::where('job_id',$id)->get();
            $projectInfo=Projects::where('ad_id',$id)->get()->first();


            return view('admin.jobs.add_apply_candidate')->with('id',$id)->with('allCity',$allCity)->with('allProvince',$allProvince)->with('jobType',$jobType)->with('projectInfo',$projectInfo);

    }

    public static function desirdPostCount($id){

          return CandidateInfo::where('post_id',$id)->get()->count();

      }

    public function addCandidateInfo(Request $request)

    {

      # code...
         DB::beginTransaction();
                try{


                if($request->cnic != $request->confirm_cnic){
                    return redirect()->back()->with('error', 'cnic is not match');
                }
                if(CandidateInfo::where([['nic',$request->cnic],['post_id',$request->apply_post]])->exists()){
                    Session::flash('error', 'This Candidate is already register for this post ');
                    return redirect('/add/apply/candidate/'.$request->job_id);
                }

                if($request->picture!=null){
                  $picture =$request->picture;
                  $candidatepicture = time().'.'.$picture->getClientOriginalName();
                  $destinationPath = public_path('/public/candidatepicture');
                  $picture->move($destinationPath,$candidatepicture);
                }else{

                  $candidatepicture=null;
                }

                $sql=CandidateInfo::create(array(

                          'full_name' => $request->name,
                          'father_name' => $request->father_name,
                          'nic' =>$request->cnic,
                          'gender' =>$request->gender,
                          'date_of_birth'=>$request->date_birth,
                          'marital_status'=>$request->marital_status,
                          'religion'=>$request->religion,
                          'postal_address'=>$request->permanent_address,
                          'mailing_address'=>$request->mailing_address,
                          'province'=>$request->province,
                          'district_id'=>$request->district_id,
                          'phone_no'=>"92".''.$request->phone_no,
                          'mobile_no'=>"92".''.$request->mobile_no,
                          'residential'=>$request->residential,
                          'religion'=>$request->religion,
                          'disabled'=>$request->d_person,
                          'g_servent'=>$request->g_servent,
                          'test_city_id'=>$request->select_city,
                          'upload_image'=>$candidatepicture,
                          'bank_code'=>$request->branch_code,
                          'deposit_date'=>$request->deposit_date,
                          'photo'=>$request->photo,
                          'educational_certificates'=>$request->educational_certificates,
                          'domicile_cnic'=>$request->domicile_cnic,
                          'bank_name'=>$request->bank,
                          'bank_slip'=>$request->bank_slip,
                          'post_id'=>$request->apply_post,
                          'domicile'=>$request->domicile,
                          'status'=>$request->status,
                          'job_id'=>$request->job_id,


                  ));

                  if($sql){
                       DB::commit();
                  }

                  //Academic Information

                  AcademicInfo::create(array(

                          'certificate_degree' => $request->matric,
                          'degree_sanad_title' => $request->matric_degree_name,
                          'specialization_major_subject' =>$request->matric_major_subject,
                          'year_passing' =>$request->matric_passing_year,
                          'obtained_marks_cgpa'=>$request->matric_obtained_marks,
                          'total_marks_cgpa'=>$request->matric_total_marks,
                          'board_university'=>$request->matric_institute,
                          'candidate_id'=>$sql->candidate_id,

                  ));

                  Intermediate::create(array(

                          'certificate_degree' => $request->intermediate,
                          'degree_sanad_title' => $request->intermediate_degree_name,
                          'specialization_major_subject' =>$request->intermediate_major_subject,
                          'year_passing' =>$request->intermediate_passing_year,
                          'obtained_marks_cgpa'=>$request->intermediate_marks,
                          'total_marks_cgpa'=>$request->intermediate_total_marks,
                          'board_university'=>$request->intermediate_institute,
                          'candidate_id'=>$sql->candidate_id,

                    ));

                    Bachelors::create(array(

                          'certificate_degree' => $request->bachelors,
                          'degree_sanad_title' => $request->bachelors_degree_name,
                          'specialization_major_subject' =>$request->bachelors_major_subject,
                          'year_passing' =>$request->bachelors_passing_year,
                          'obtained_marks_cgpa'=>$request->bachelors_marks,
                          'total_marks_cgpa'=>$request->bachelors_total_marks,
                          'board_university'=>$request->bachelors_institute,
                          'candidate_id'=>$sql->candidate_id,

                    ));

                    Masters::create(array(

                          'certificate_degree' => $request->masters,
                          'degree_sanad_title' => $request->masters_degree_name,
                          'specialization_major_subject' =>$request->masters_major_subject,
                          'year_passing' =>$request->masters_passing_year,
                          'obtained_marks_cgpa'=>$request->masters_marks,
                          'total_marks_cgpa'=>$request->masters_total_marks,
                          'board_university'=>$request->masters_institute,
                          'candidate_id'=>$sql->candidate_id,

                    ));

                    Professional1::create(array(

                          'certificate_degree' => $request->professional1,
                          'degree_sanad_title' => $request->professional1_degree_name,
                          'specialization_major_subject' =>$request->professional1_major_subject,
                          'year_passing' =>$request->professional1_passing_year,
                          'obtained_marks_cgpa'=>$request->professional1_marks,
                          'total_marks_cgpa'=>$request->professional1_total_marks,
                          'board_university'=>$request->professional1_institute,
                          'candidate_id'=>$sql->candidate_id,

                    ));

                    Professional2::create(array(

                          'certificate_degree' => $request->professional2,
                          'degree_sanad_title' => $request->professional2_degree_name,
                          'specialization_major_subject' =>$request->professional2_major_subject,
                          'year_passing' =>$request->professional2_passing_year,
                          'obtained_marks_cgpa'=>$request->professional2_marks,
                          'total_marks_cgpa'=>$request->professional2_total_marks,
                          'board_university'=>$request->professional2_institute,
                          'candidate_id'=>$sql->candidate_id,

                    ));

                  //Employment Record

                    EmploymentRecords::create(array(

                          'organization_employer_name1' => $request->employer_name,
                          'job_title1' => $request->job_title,
                          'duration_from1' =>$request->job_from,
                          'duration_to1' =>$request->job_to,

                          'organization_employer_name2' => $request->employer_name2,
                          'job_title2' => $request->job_title2,
                          'duration_from2' =>$request->job_from2,
                          'duration_to2' =>$request->job_to2,

                          'organization_employer_name3' => $request->employer_name3,
                          'job_title3' => $request->job_title3,
                          'duration_from3' =>$request->job_from3,
                          'duration_to3' =>$request->job_to3,

                          'candidate_id'=>$sql->candidate_id,

                  ));



                   TotalExpirence::create(array(

                              'days' => $request->days,
                              'month' =>$request->months,
                              'years' =>$request->years,
                              'candidate_id'=>$sql->candidate_id,

                    ));



                  if($sql){

                          Session::flash('success', 'Candidate Add Successfully');
                          DB::commit();
                          return redirect('/add/apply/candidate/'.$request->job_id);

                  }else{

                          Session::flash('error', 'Candidate Not Add Successfully');
                          return redirect('/add/apply/candidate/'.$$request->job_id);

                  }

                  //Checking Document

                  }catch (\Exception $e){
                      DB::rollback();
                      Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                      return Redirect::back();
                      // return $e->getMessage().''.$e->getLine();
                  }


    }

     public function updateCandidateInfo(Request $request)

    {

      # code...
         DB::beginTransaction();
                try{

                if($request->picture!=null){

                  $picture =$request->picture;
                  $candidatepicture = time().'.'.$picture->getClientOriginalName();
                  $destinationPath = public_path('/public/candidatepicture');
                  $picture->move($destinationPath,$candidatepicture);

                }else{

                  $candidatepicture=$request->old_picture;

                }

                $candidateInfo=array(

                          'full_name' => $request->name,
                          'father_name' => $request->father_name,
                          'nic' =>$request->cnic,
                          'gender' =>$request->gender,
                          'date_of_birth'=>$request->date_birth,
                          'marital_status'=>$request->marital_status,
                          'religion'=>$request->religion,
                          'postal_address'=>$request->permanent_address,
                          'mailing_address'=>$request->mailing_address,
                          'province'=>$request->province,
                          'district_id'=>$request->district_id,
                          'phone_no'=>$request->phone_no,
                          'mobile_no'=>$request->mobile_no,
                          'residential'=>$request->residential,
                          'religion'=>$request->religion,
                          'disabled'=>$request->d_person,
                          'g_servent'=>$request->g_servent,
                          'test_city_id'=>$request->select_city,
                          'upload_image'=>$candidatepicture,
                          'bank_code'=>$request->branch_code,
                          'deposit_date'=>$request->deposit_date,
                          'photo'=>$request->photo,
                          'educational_certificates'=>$request->educational_certificates,
                          'domicile_cnic'=>$request->domicile_cnic,
                          'bank_slip'=>$request->bank_slip,
                          'post_id'=>$request->apply_post,
                          'domicile'=>$request->domicile,
                          'status'=>$request->status,
                          'job_id'=>$request->job_id,


                  );

                  $update_candidate_info=CandidateInfo::where('candidate_id',$request->candidate_id)->update($candidateInfo);

                  //Academic Information

                  $intermediateAcadmic=array(

                            'certificate_degree' => $request->matric,
                            'degree_sanad_title' => $request->matric_degree_name,
                            'specialization_major_subject' =>$request->matric_major_subject,
                            'year_passing' =>$request->matric_passing_year,
                            'obtained_marks_cgpa'=>$request->matric_obtained_marks,
                            'total_marks_cgpa'=>$request->matric_total_marks,
                            'board_university'=>$request->matric_institute,


                  );

                  $update_matricInfo=AcademicInfo::where('candidate_id',$request->candidate_id)->update($intermediateAcadmic);

                  $intermediate=array(

                          'certificate_degree' => $request->intermediate,
                          'degree_sanad_title' => $request->intermediate_degree_name,
                          'specialization_major_subject' =>$request->intermediate_major_subject,
                          'year_passing' =>$request->intermediate_passing_year,
                          'obtained_marks_cgpa'=>$request->intermediate_marks,
                          'total_marks_cgpa'=>$request->intermediate_total_marks,
                          'board_university'=>$request->intermediate_institute,


                    );

                  $update_intermediate=Intermediate::where('candidate_id',$request->candidate_id)->update($intermediate);

                  $bachelors=array(

                        'certificate_degree' => $request->bachelors,
                        'degree_sanad_title' => $request->bachelors_degree_name,
                        'specialization_major_subject' =>$request->bachelors_major_subject,
                        'year_passing' =>$request->bachelors_passing_year,
                        'obtained_marks_cgpa'=>$request->bachelors_marks,
                        'total_marks_cgpa'=>$request->bachelors_total_marks,
                        'board_university'=>$request->bachelors_institute,


                  );

                  $update_bachelorInfo=Bachelors::where('candidate_id',$request->candidate_id)->update($bachelors);

                  $masters=array(

                        'certificate_degree' => $request->masters,
                        'degree_sanad_title' => $request->masters_degree_name,
                        'specialization_major_subject' =>$request->masters_major_subject,
                        'year_passing' =>$request->masters_passing_year,
                        'obtained_marks_cgpa'=>$request->masters_marks,
                        'total_marks_cgpa'=>$request->masters_total_marks,
                        'board_university'=>$request->masters_institute,

                  );

                  $update_masterInfo=Masters::where('candidate_id',$request->candidate_id)->update($masters);

                  $professional1=array(

                        'certificate_degree' => $request->professional1,
                        'degree_sanad_title' => $request->professional1_degree_name,
                        'specialization_major_subject' =>$request->professional1_major_subject,
                        'year_passing' =>$request->professional1_passing_year,
                        'obtained_marks_cgpa'=>$request->professional1_marks,
                        'total_marks_cgpa'=>$request->professional1_total_marks,
                        'board_university'=>$request->professional1_institute,


                  );

                  $update_professional=Professional1::where('candidate_id',$request->candidate_id)->update($professional1);

                  $professional2=array(

                        'certificate_degree' => $request->professional2,
                        'degree_sanad_title' => $request->professional2_degree_name,
                        'specialization_major_subject' =>$request->professional2_major_subject,
                        'year_passing' =>$request->professional2_passing_year,
                        'obtained_marks_cgpa'=>$request->professional2_marks,
                        'total_marks_cgpa'=>$request->professional2_total_marks,
                        'board_university'=>$request->professional2_institute,

                  );

                  $update_professional=Professional2::where('candidate_id',$request->candidate_id)->update($professional2);

                  //Employment Record

                  $employmentRecord=array(

                            'organization_employer_name1' => $request->employer_name,
                            'job_title1' => $request->job_title,
                            'duration_from1' =>$request->job_from,
                            'duration_to1' =>$request->job_to,

                            'organization_employer_name2' => $request->employer_name2,
                            'job_title2' => $request->job_title2,
                            'duration_from2' =>$request->job_from2,
                            'duration_to2' =>$request->job_to2,

                            'organization_employer_name3' => $request->employer_name3,
                            'job_title3' => $request->job_title3,
                            'duration_from3' =>$request->job_from3,
                            'duration_to3' =>$request->job_to3,


                  );

                  $update_employmentRecord=EmploymentRecords::where('candidate_id',$request->candidate_id)->update($employmentRecord);

                  $totalExpirence=array(

                      'days' => $request->days,
                      'month' =>$request->months,
                      'years' =>$request->years,

                  );

                  $update_totalExperince=TotalExpirence::where('candidate_id',$request->candidate_id)->update($totalExpirence);



                  if($update_candidate_info or $update_matricInfo or $update_intermediate or $update_bachelorInfo or $update_masterInfo or $update_professional or $update_professional or $update_employmentRecord or $update_totalExperince){

                          Session::flash('success', 'Candidate info updated successfully');
                          DB::commit();
                          return redirect('post/apply/candidate/'.$request->job_id);

                  }else{

                          Session::flash('error', 'Candidate info not updated successfully');
                          return redirect('post/apply/candidate/'.$request->job_id);

                  }

                  //Checking Document

                  }catch (\Exception $e){
                      DB::rollback();
                      Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                      return Redirect::back();
                      return $e->getMessage().''.$e->getLine();
                  }

    }

    public function candidateDelete(Request $request){

              $id=$request->id;
              $delete=CandidateInfo::where('candidate_id',$id)->delete();
              $deleteEmployment=EmploymentRecords::where('candidate_id',$id)->delete();
              $deleteAcademicInfo=AcademicInfo::where('candidate_id',$id)->delete();
              $deleteIntermediateInfo=Intermediate::where('candidate_id',$id)->delete();
              $deleteBachelorsInfo=Bachelors::where('candidate_id',$id)->delete();
              $deleteMasters=Masters::where('candidate_id',$id)->delete();
              $deleteProfessional1=Professional1::where('candidate_id',$id)->delete();
              $deleteProfessional2=Professional2::where('candidate_id',$id)->delete();
              $deleteAcademicInfo=TotalExpirence::where('candidate_id',$id)->delete();
              $deleteAcademicInfo=RollSlip::where('candidate_id',$id)->delete();


    }

    public function editCandidateInfo($id){

              $allCity=Cities::all();
              $allProvince=Province::all();
              $candidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
              $jobType=Job_Type::where('job_id',$candidateInfo->job_id)->get();

              return view('admin.jobs.editCandidateInfo')->with('allCity',$allCity)->with('allProvince',$allProvince)->with('jobType',$jobType)->with('candidateInfo',$candidateInfo);

    }


    public function userProfile($id){

              $candidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
              return view('admin.jobs.user_profile')->with('candidateInfo',$candidateInfo);

    }

    public function infoMessage($id){

              $projectInfo=Projects::where('ad_id',$id)->get()->first();
              return view('admin.jobs.info_message')->with('projectInfo',$projectInfo)->with('id',$id);

    }

    public function infoMessageCandidate(Request $request){

                $this->validate($request, [
                      'job_title' => 'required|max:1000',
                      'info_message' => 'required',
                ]);

                DB::beginTransaction();

                try{

                  $infoMessage=$request->info_message;
                  $job_id=$request->id;

                  $allCandidate=CandidateInfo::where('job_id',$job_id)->get();
                  foreach ($allCandidate as $key => $value) {
                    # code...

                    $type = "xml";
                    $id = "92test8";
                    $pass = "honor569";
                    $lang = "English";
                    $mask = "SMS4CONNECT";

                    // Data for text message

                    $to =$value->mobile_no;
                    $message ="Dear".' '.$value->full_name.':'.' '.$infoMessage;
                    $message = urlencode($message);

                    // Prepare data for POST request

                    $data =
                    "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;

                    // Send the POST request with cURL
                    $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url');

                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch); //This is the result from SMS4CONNECT
                    curl_close($ch);


                  }

                  if($infoMessage){

                          Session::flash('success', 'Info message send successfully');
                          DB::commit();
                          return redirect('/post/apply/candidate/'.$request->id);

                  }else{

                          Session::flash('error', 'Info message not send successfully');
                          return redirect('/post/apply/candidate/'.$request->id);

                  }

                  //Checking Document

                  }catch (\Exception $e){
                      DB::rollback();
                      Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                      return Redirect::back();
                      return $e->getMessage().''.$e->getLine();
                  }


    }


  // Generate Roll Slip

 /*   public function rollSlip($id){

      $allCitySpace=CandidateInfo::selectRaw('count(candidate_id) candidate_id,test_city_sid')->orderBy('candidate_id', 'DESC')->groupBy('test_city_id')->get();

      return view('admin.jobs.testcity_space')->with('id',$id)->with('allCitySpace',$allCitySpace);

    }*/

    public function rollSlip($id){

      $allCities=Cities::all();
      $jobType=Job_Type::where('job_id',$id)->get();

      return view('admin.jobs.generate_rollslip')->with('id',$id)->with('allCities',$allCities)->with('jobType',$jobType);

    }

    //Static Class

    public static function totalSpaceCenter($id){

       return TestCenter::where('city_id',$id)->get()->SUM('candidate_per_center');

    }

    public function selectCenter(Request $request){


        $id=$request->city;
        $allCenter=TestCenter::where('city_id',$id)->get();

        echo '<option value="">'.'Selecte Center'.'</option>';

        foreach($allCenter as $allCenters){

          echo '<option value="'.$allCenters->center_id.'">'.$allCenters->center_name.'</option>';

        }


    }

    public function availabelCandidate(Request $request){

              $id=$request->city;
              $allCandidate=CandidateInfo::where('test_city_id',$id)->where('roll_slip_status',"no")->where('status',"Eligible")->get()->count();

              return $allCandidate;



    }

    public function selectCenterSpace(Request $request){


            $id=$request->center;
            $allCenter=TestCenter::where('center_id',$id)->get()->first();

            return  $allCenter->candidate_per_center;


    }

    public function addRollSlip(Request $request){


          $this->validate($request, [

              'time' => 'required',
              'date' => 'required',
              'center'=>'required',
              'center'=>'required',

          ]);

          /*DB::beginTransaction();

          try{
*/

              $time=$request->time;
              $date=$request->date;
              $test_city=$request->city;
              $test_center=$request->center;
              $job_id=$request->id;
            $post_id=$request->post_id;
              $total_availabel_candidate=$request->total_availabel_candidate;

              if(empty($total_availabel_candidate)){

                     Session::flash('error', 'Candidate not availabel this city');
               //      DB::commit();
                     return redirect('/generate/roll/slip/'.$job_id);

              }

                  $candidate_info=CandidateInfo::where('job_id',$job_id)->where('post_id',$post_id)->where('test_city_id',$test_city)->where('roll_slip_status','!=',"yes")->take($total_availabel_candidate)->get();

              if(CandidateInfo::where('job_id',$job_id)->where('test_city_id',$test_city)->where('post_id',$post_id)->where('roll_slip_status','!=',"yes")->take($total_availabel_candidate)->exists()){

          //    DB::commit();

                   $strat_roll_slip=$request->st_roll;

              foreach($candidate_info as $candidate){

                  $rollSlip=$test_city.''.$candidate->candidate_id;
                  $sql=RollSlip::create(array(
                    'roll_no_slip'=>$strat_roll_slip,
                    'test_date' =>$date,
                    'test_time' =>$time,
                    'test_center'=>$test_center,
                    'candidate_id' =>$candidate->candidate_id,
                  ));

                  $update=array('roll_slip_status'=>"yes");
                  CandidateInfo::where('candidate_id',$candidate->candidate_id)->update($update);

                  $strat_roll_slip++;


                }

              }

          if($sql){

                  Session::flash('success', 'Roll no slip generated successfully');
                  DB::commit();
                  return redirect('/generate/roll/slip/'.$job_id);

          }else{

                  Session::flash('error', 'Roll no slip not generated successfully');
                  return redirect('/generate/roll/slip/'.$job_id);

          }

/*          }catch (\Exception $e){

                  DB::rollback();
                  Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                  return Redirect::back();
                  // return $e->getMessage().''.$e->getLine();

          }*/


    }

    public function rollSlipView($id){


               $candidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
        return view('admin.jobs.roll_no_slip')->with('candidateInfo',$candidateInfo);


    }

    public function candidateMessage($id){

        $candidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
        return view('admin.jobs.candidate_message')->with('candidateInfo',$candidateInfo);

    }

    public function candidateMessageInfo(Request $request){


                $this->validate($request, [

                      'candidate_name' => 'required|max:1000',
                      'candidate_nic' => 'required',

                ]);

              DB::beginTransaction();

              try{

                $infoMessage=$request->candidate_name;
                $candidate_id=$request->id;
                $candidate_information=CandidateInfo::where('candidate_id',$candidate_id)->get()->first();
                $mobile_no=$request->mobile_no;
                $candidate_info=$request->info_message;

              // Configuration variables

                $type = "xml";
                $id = "92test8";
                $pass = "honor569";
                $lang = "English";
                $mask = "SMS4CONNECT";

                // Data for text message

                $to=$mobile_no;
                $message="Dear".' '.$candidate_information->full_name.' '. $candidate_info;
                $message=urlencode($message);

                // Prepare data for POST request

                $data =
                "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;

                // Send the POST request with cURL
                $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url');

                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch); //This is the result from SMS4CONNECT
                curl_close($ch);


                if($infoMessage){

                        Session::flash('success', 'Info message send successfully');
                        DB::commit();
                        return redirect('/post/apply/candidate/'.$request->job_id);

                }else{

                        Session::flash('error', 'Info message not send successfully');
                        return redirect('/post/apply/candidate/'.$request->job_id);

                }

                //Checking Document

                }catch (\Exception $e){

                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                    /*                      return $e->getMessage().''.$e->getLine();
                    */

              }


    }


    public function editResult($id)

    {
      # code...
          $editResult=UploadResult::where('id',$id)->get()->first();
          return view('admin.jobs.editresult')->with('editResult',$editResult);

    }


    public function updateResult(Request $request){



          DB::beginTransaction();

          try{

          if($request->result!=null){
            $result=$request->result;
            $result1 = time().'.'.$result->getClientOriginalName();
            $destinationPath = public_path('/public/UploadResult');
            $result->move($destinationPath,$result1);

          }else{
            $result1=$request->old_result;
          }
          $update=array(
              'result'=>$result1,
          );
          $sql=UploadResult::where('id',$request->id)->update($update);
          if($sql){
                    Session::flash('success', 'Result update successfully');
                    DB::commit();
                    return redirect('/result');
          }else{
                    Session::flash('error', 'Result not update successfully');
                    return redirect('/result');
          }
          }catch (\Exception $e){

                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    // return Redirect::back();
                    return $e->getMessage().''.$e->getLine();

          }


    }

    public function resultDelete(Request $request)

    {
        # code...
                $id=$request->id;

                $delete=UploadResult::where('id',$id)->delete();

                if($delete){

                 return "result Deleted Successfully";

                }else{

                 return "result Not Deleted Successfully";

                }

    }




    public function testCriteria($id){

            return view('admin/jobs/test_criteria')->with('id',$id);


    }


    public function addTestCriteria(Request $request){

          $test_criteria = $request->test_criteria;
          $fileName = time().'.'.$test_criteria->getClientOriginalName();
          $destinationPath = public_path('/public/testcriteria');
          $test_criteria->move($destinationPath,$fileName);
          $update=array('test_criteria'=>$fileName);
          $sql=Job_Type::where('job_type_id',$request->post_id)->update($update);
          if($sql){
            Session::flash('success', 'Test Criteria Uploaded successfully');
            return redirect('current/projects');
          }else{
            Session::flash('error', 'Test Criteria Not Uploaded successfully');
            return redirect('current/projects');
          }

    }

    public function singleResult($id){

            $CandidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
            $allPost=Job_Type::where('job_id',$CandidateInfo->job_id)->get();

      return view('admin.jobs.upload_single_result')->with('allPost',$allPost)->with('CandidateInfo',$CandidateInfo);

    }

    public function addSingleResult(Request $request)
    {
        if(SingleResult::where('job_id',$request->ad_id)->where('post_id',$request->post_id)->where('cnic',$request->nic)->exists()){

          Session::flash('error','Result Already Uploaded');
          return  redirect::back();

        }else{

          $result=['result'=>$request->result,'job_id'=>$request->ad_id,'post_id'=>$request->post_id,'cnic'=>$request->nic,'candidate_id'=>$request->candidate_id];
          $sql=SingleResult::create($result);

        if($sql){

          Session::flash('success','upload result');
          return  redirect::back();

        }else{

          Session::flash('error','upload not result');
          return  redirect::back();

        }

        }

    }

    public function paperPattern()
    {
      // return "ddd";
      $allPaperPatterns = PaperPattern::all();
      return view('admin.paperpattern.all_paper_patterns')->with('allPaperPatterns', $allPaperPatterns);
    }

    public function createPaperPattern()
    {
      $allProjects = Projects::all();
      return view('admin.paperpattern.paper_pattern_add')->with('allProjects', $allProjects);
    } 

    public function storePaperPattern(Request $request)
    {
      $this->validate($request, [
            'job_id' => 'required',
            'paper_pattern' => 'required|max:5000|mimes:doc,docx,pdf',
            'status' => 'required'
        ]);

      if($request->hasFile('paper_pattern')) {
            $paper_pattern = $request->paper_pattern;
            $fileName = time().'.'.$paper_pattern->getClientOriginalName();
            $destinationPath = public_path('/public/paperpatterns');
            $paper_pattern->move($destinationPath,$fileName);
        }

        $sql=PaperPattern::create(array(
                      'job_id' => $request->job_id,
                      'file' =>$fileName,
                      'status'=>$request->status
                  ));
        if($sql){

                  Session::flash('success', 'Paper pattern upload succcesfully');
                  DB::commit();
                  return redirect('/paper/pattern');

            }else{

                  Session::flash('success', 'Paper pattern upload succcesfully');
                  return redirect('/paper/pattern');

          }
    }

    public function deletePaperPattern(Request $request)
    {
            $id=$request->id;
            $delete=PaperPattern::where('id',$id)->delete();
           
            if($delete){
             
             return "Paper Pattern Deleted Successfully";
                
            }else{

             return "Paper Pattern Not Deleted Successfully";
           
            }
    }

    public function editPaperPattern($id)
  
    {
        $editPaperPattern = PaperPattern::where('id',$id)->first();
        $allProjects = Projects::all();

        return view('admin.paperpattern.edit_paper_pattern')
                        ->with('editPaperPattern',$editPaperPattern)
                        ->with('allProjects',$allProjects);
            
    }

    public function updatePaperPattern(Request $request)
    {
       // $this->validate($request, [
       //      'job_id' => 'required',
       //      'paper_pattern' => 'required|max:5000|mimes:doc,docx,pdf',
       //      'status' => 'required'
       //  ]);
        // return $request->paper_pattern;
              DB::beginTransaction();
              try{

                if($request->paper_pattern != null){

                  $this->validate($request, [
                    'paper_pattern' => 'required|max:5000|mimes:doc,docx,pdf'
                  ]);

                }

                if($request->paper_pattern != null){
                      $file =$request->paper_pattern;
                      $fileName = time().'.'.$file->getClientOriginalExtension();
                      $destinationPath = public_path('/public/paperpatterns');
                      $Image = $fileName;
                      $file->move($destinationPath,$fileName);

                }else{

                       $Image =$request->old_paper_pattern;

                }

          
                  $update = array(
                    'job_id' => $request->job_id,
                    'file' => $Image,
                    'status'=>$request->status,
                  );

                $sql = PaperPattern::where('id', $request->id)->update($update);
                 
                if($sql){
               
                      Session::flash('update', 'Paper Pattern Updated Successfully');
                      DB::commit(); 
                      return redirect('/paper/pattern');
                  
                }else{

                    Session::flash('update', 'Paper Pattern Not Updated Successfully');
                    return redirect('/paper/pattern');

              } 

          }catch (\Exception $e) {
            DB::rollback();
          // return $e->getMessage().''.$e->getLine();
          Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
          return Redirect::back();
        }
    }


    public function uploadEligibilityLists($id)
    {
        //
        $ProjectInfo = Projects::where('ad_id', $id)->first();
        $allPost = Job_Type::where('job_id', $id)->get();
        return view('admin.jobs.eligible_list')->with('ProjectInfo', $ProjectInfo)->with('allPost', $allPost);
    }

    public function storeEligibilityLists(Request $request)
    {
      $this->validate($request, [
            'ad_id' => 'required',
            'job_title' => 'required',
            'post_id'=>'required',
            'eligible'=>'required',
        ]);

        if($request->hasFile('eligible')) {
            $path = $request->file('eligible')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $candidate = $this->CheckCandiate($request,$value->cnic);
                    if(!$candidate) {
                        continue;
                    }
                    $arr[] = ['post_id' => $request->post_id,'candidate_id'=> $candidate->candidate_id, 'status' => $value->status];
                }
                if(empty($arr)){
                    return redirect()->back()->with('error', 'Candiate not found.');
                }
                $sql=DB::table('eligibility')->insert($arr);
                if(!$sql){
                    return redirect()->back()->with('error', 'Not Uploaded');
                }
                //$postType = Job_Type::where('job_type_id',$request->post_id)->update(['result_status' => true]);
                return redirect()->back()->with('success', 'Eligibility list uploaded successfully');
            }
        }
        return redirect()->back()->with('error', 'File not found.');
    }


    private function CheckCandiate(Request $request,$cnic){
        $candidate=CandidateInfo::where([['nic',$cnic],['post_id',$request->post_id]])->get()->first();
        return $candidate;
    }




}
