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

class CandidateController extends Controller
{
    //
    public function rollnoSlip(){
           
      $mytime =Carbon::now();
      $date=$mytime->toDateString();
       $allProjects=Projects::all();
      
       
      return view('frontend.rollno.index')->with('allProjects',$allProjects);     

     
  }
  public function desiredPost(Request $request){
    
    $desiredPost=Job_Type::where('job_id',$request->project_id)->get();

    echo '<option value="">'.'Selecte Post'.'</option>';

    foreach($desiredPost as $desiredPosts){
      
    echo '<option value="'.$desiredPosts->job_type_id.'">'.$desiredPosts->type_name.'</option>';
    
    }
 

}
public function downloadSlip(Request $request){

            
   
if(CandidateInfo::where('nic',$request->cnic)->where('job_id',$request->project_id)->where('post_id',$request->post_id)->where('roll_slip_status','yes')->exists()){

$CandidateInfo=CandidateInfo::where('nic',$request->cnic)->where('job_id',$request->project_id)->where('post_id',$request->post_id)->where('roll_slip_status','yes')->get()->first(); 

return ('1');

}else{

Session::flash('error', 'Roll no slip not found');
return redirect('/download/rollslip');

}

}


    public function sendMail()
    {
       $name = 'Faheme';
      $send = Mail::to('faheemdad247@hotmail.com')->send(new SendMailable($name));
      $send2 = Mail::to('dad.faheem@gmail.com')->send(new SendMailable($name));
       if ($send && $send2) {
       return 'Email was sent';
       } else {
       return 'Email not sent';

       }
    }

    public function candidateView($candidate_id){

        $booking     = CandidateInfo::where('candidate_id',$candidate_id)->first();
        $jobType     = Job_Type::where('job_type_id',$booking->post_id)->first();
        $projectInfo = Projects::where('ad_id',$jobType->job_id)->first();
        $allCity     = Cities::all();
        $allProvince = Province::all();

        $academic_info = AcademicInfo::where('candidate_id',$booking->candidate_id)->first();
        $intermediate  = Intermediate::where('candidate_id',$candidate_id)->first();
        $bachelors     = Bachelors::where('candidate_id',$candidate_id)->first();
        $masters       = Masters::where('candidate_id',$candidate_id)->first();
        $total_expirence               = TotalExpirence::where('candidate_id',$candidate_id)->first();
        $employment_records=EmploymentRecords::where('candidate_id',$candidate_id)->first();

        return view('candidate.job_apply_form_view',['academic_info' => $academic_info,'intermediate' => $intermediate,'bachelors' => $bachelors,'masters' => $masters,'employment_records' => $employment_records,'total_expirence' => $total_expirence])->with('booking',$booking)->with('jobType',$jobType)->with('projectInfo',$projectInfo)->with('allCity',$allCity)->with('allProvince',$allProvince);

    }

    public function appliedBookingForm($booking_id){

        $booking = CandidateInfo::where('booking_id',$booking_id)->first();
        if($booking){

          $jobType     = Job_Type::where('job_type_id',$booking->post_id)->first();
          $projectInfo = Projects::where('ad_id',$jobType->job_id)->first();

          $pdf            = new Fpdi();
          $pageCount      = $pdf->setSourceFile('form.pdf');
          $pageNo         = 1;  
          // import a page
          $templateId = $pdf->importPage(1);
          // get the size of the imported page
       
          $size = $pdf->getTemplateSize($templateId);
       
          // add a page with the same orientation and size
       
          $pdf->SetAutoPageBreak(true);
          $pdf->AddPage($size['orientation'], $size);
       
          // use the imported page            
          $pdf->useTemplate($templateId);

          $pdf->SetFont('arial','B');
          $pdf->SetFontSize('8'); // set font size
          $pdf->SetXY(30, 89);
          $pdf->MultiCell(0,'3',$projectInfo->ad_title,'0',false);

          $pdf->SetFont('arial','B');
          $pdf->SetFontSize('8'); // set font size
          $pdf->SetXY(30, 102);
          $pdf->MultiCell(0,'3',$jobType->type_name,'0',false);
         
          $pdf->SetFont('arial','B');
          $pdf->SetFontSize('8'); // set font size
          $pdf->SetXY(30, 31);
          $pdf->MultiCell(0,'3',$booking->booking_id,'0',false);

          $pdf->SetXY(30, 116);
          $pdf->MultiCell(0,'3',$booking->full_name,'0',false);
          $pdf->SetXY(30, 123);
          $pdf->MultiCell(0,'3',$booking->nic,'0',false);

          $pdf->Output();
          exit;

        }


    }

    public function candidateLogin(){

        return view('candidate.login');

    }

    public function candidateDashboard(){
        return view('candidate.dashboard');
    }

    public function registerCandidate(){

      return view('candidate.register_candidate');

    }

     public function candidateTransactionDetails($candidate_id){

        $booking = CandidateInfo::where('candidate_id',$candidate_id)->first();
        $jobType     = Job_Type::where('job_type_id',$booking->post_id)->first();
        $projectInfo = Projects::where('ad_id',$jobType->job_id)->first();

        return view('candidate.tran_candidate_details')->with('booking',$booking)->with('jobType',$jobType)->with('projectInfo',$projectInfo);

    }

    public function addTransaction(Request $request){

        $booking = CandidateInfo::where('booking_id',$request->booking_id)->first();
        if($booking){
 
            $booking->update(['transaction_id' => $request->transaction_id,'status' => 'Completed']);               
            Session::flash('success', 'Added Successfully');
            return redirect('apply/projects');

        }else{

            Session::flash('error', 'Not Add Successfully');
            return redirect()->back();
      
        }  

    }

    public function applyJob($post_id){

      $allCity     = Cities::all();
      $allProvince = Province::all();
      $jobType     = Job_Type::where('job_type_id',$post_id)->first();
      $projectInfo = Projects::where('ad_id',$jobType->job_id)->first();

      return view('candidate.job_apply_form')->with('post_id',$post_id)->with('jobType',$jobType)->with('projectInfo',$projectInfo)->with('allCity',$allCity)->with('allProvince',$allProvince);

    }


    public function viewPosts($id){

      $post=Job_Type::where('job_id',$id)->get();
      return view('candidate.post')->with('post',$post);


     }

    public function appliedPost(Request $request){

              $this->validate($request, [

                    'name' =>'required|max:255',  
                    'father_name' => 'required|max:255', 
                    'gender' => 'required|max:255',
                    'cnic' => 'required|max:13',
                    'date_birth'=>'required|max:255',
                    'marital_status'=>'required|max:255',
                    'religion'=>'required|max:255',
                    'permanent_address'=>'required',
                    'mailing_address'=>'required',
                    'province'=>'required|max:255',
                    'phone_no'=>'required|max:255',
                    'mobile_no'=>'required|max:255',
                    'residential'=>'required|max:255',
                    'd_person'=>'required|max:255',
                    'g_servent'=>'required|max:255',
                    'picture'=>'required',
              ]);

              if(CandidateInfo::where([['nic',$request->cnic],['post_id',$request->post_id]])->exists()){
                 
                  Session::flash('error', 'You are already applied for this post');
                  return redirect()->back();

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
                  'booking_id' => rand(0, 99999),
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
                  'bank_slip'=>$request->bank_slip,
                  'post_id'=>$request->post_id,
                  'domicile'=>$request->domicile,
                  'status'=>"pending",
                  'job_id'=>$request->job_id,
                  'user_id'=> Auth::User()->id
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
              
                    Session::flash('success', 'Apply Successfully');
                    DB::commit();
                    return redirect('applied/booking-form/'.$sql->booking_id);
                
              }else{

                    Session::flash('error', 'Your Apply Not Add Successfully');
                    return redirect()->back();

              }  

              //Checking Document
           
          // }catch (\Exception $e){
        
          //       DB::rollback();
          //       Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
          //       return Redirect::back();
          //       // return $e->getMessage().''.$e->getLine();


          // }




    }

    public function candidateRegister(Request $request){

	        $this->validate($request, [
	              'user_first_name' => 'required|max:255',  
	              'user_last_name' => 'required|max:255', 
	              'email' => 'required|string|email|max:255|unique:users',      
	              'password'=> 'required|confirmed|min:6',
	              'cnic' => 'required|max:13',
	        ]);

          if(User::where('cnic',$request->cnic)->exists()){

            Session::flash('error', 'The cnic has already been taken.');
            return Redirect::back();

          }
	        DB::beginTransaction();

	        try{

	            $fileName="dummy.jpg";
	            $sql=User::create(array(
                'first_name' => $request->user_first_name,
                'last_name'  => $request->user_last_name,
                'full_name'  =>$request->user_first_name.' '.$request->user_last_name,
                'email'      =>$request->email,
                'image'      =>$fileName,
                'cnic'       =>$request->cnic,
                'password'   => bcrypt($request->password),
                'role'       =>"candidate",
	            )); 
	      
		    if($sql){

		            Session::flash('success', 'You account add successfully!pleas login');
		            DB::commit();
		            return redirect('/login');
		    
		    }else{

		            Session::flash('success', 'Your account not add  Successfully');
		            return redirect('/login');
		    
		    }

	        }catch (\Exception $e) {
			    DB::rollback();
				Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
				return Redirect::back();
				// return $e->getMessage().''.$e->getLine();
			}


    }

    public function projects(){

        $mytime =Carbon::now();
        $date=$mytime->toDateString();
        $allProjects=Projects::where('ad_last_date_submission','>=',$date)->where('status','Online')->get();
        $allCity=Cities::all();
        $allProvince=Province::all();

        return view('candidate.projects')->with('allProjects',$allProjects)->with('allCity',$allCity)->with('allCity',$allCity)->with('allProvince',$allProvince);

    }

 

    public function addCandidateOnline(Request $request)
    
    {

      # code...
    	//validation Form 
    	 
    	    $this->validate($request, [

	              'name' =>'required|max:255',  
	              'father_name' => 'required|max:255', 
	              'gender' => 'required|max:255',
	              'cnic' => 'required|max:13',
                'date_birth'=>'required|max:255',
                'marital_status'=>'required|max:255',
                'religion'=>'required|max:255',
                'permanent_address'=>'required|max:1000',
                'mailing_address'=>'required|max:1000',
                'province'=>'required|max:255',
                'phone_no'=>'required|max:255',
                'mobile_no'=>'required|max:255',
                'residential'=>'required|max:255',
                'd_person'=>'required|max:255',
                'g_servent'=>'required|max:255',
                'select_city'=>'required|max:255',
                'picture'=>'required|max:255',
                'branch_code'=>'required|max:255',
                'deposit_date'=>'required|max:255',

	        ]);


          DB::beginTransaction();
              
          try{

                if(CandidateInfo::where([['nic',$request->cnic],['post_id',$request->apply_post]])->exists()){
                   
                    Session::flash('error', 'You are already applied for this post');
                    return redirect('/projects');

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
                          'phone_no'=>$request->phone_no,
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
                          'bank_slip'=>$request->bank_slip,
                          'post_id'=>$request->apply_post,
                          'domicile'=>$request->domicile,
                          'status'=>"pending",
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
                
                      Session::flash('success', 'Your registration add Successfully');
                      DB::commit();
                      return redirect('/projects');
                  
                }else{

                      Session::flash('error', 'Your registration Not Add Successfully');
                      return redirect('/projects');

                }  

                //Checking Document
             
            }catch (\Exception $e){
          
                  DB::rollback();
                  Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                  return Redirect::back();
                  // return $e->getMessage().''.$e->getLine();


            }


    }
    
    public function editProfile($id)
    
    {

    	# code..
    	$candidateInfo=User::where('id',$id)->get()->first();
        return view('candidate.edit_profile')->with('editAdmin',$candidateInfo);  

    }

    public function updateProfile(Request $request){


	            $this->validate($request, [

		              'first_name' => 'required|max:255',  
		              'last_name' => 'required|max:255', 
		              'cnic' => 'required|max:13',

		        ]);

	            DB::beginTransaction();
	            
	            try{

	            if($request->old_email != $request->email)
	           
	            {
	               
	                $this->validate($request, [
	                    'email' => 'required|string|email|max:255|unique:users', 
	                  ]);
	                $email_new=$request->email;

	            }else{

	                $email_new=$request->old_email;
	            
	            }if($request->add_image!=null){

	              $this->validate($request, [
	                'add_image' => 'image|mimes:jpg,png,jpeg|max:5000',
	              ]);

	            }if($request->add_image!=null){

	                  $file =$request->add_image;
	                  $fileName = time().'.'.$file->getClientOriginalExtension();
	                  $destinationPath = public_path('/public/candidatepicture');
	                  $Image = $fileName;
	                  $file->move($destinationPath,$fileName);

	            }else{

	                   $Image =$request->old_image;

	            }
	      
                $update = array(
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'full_name'=>$request->first_name.' '.$request->last_name,
                  'email' => $email_new,
                  'cnic'=>$request->cnic,
                  'image' => $Image,
                );

	            $sql = User::where('id', $request->id)->update($update);
	             
	            if($sql){
	           
                    Session::flash('update', 'Candidate Information Updated Successfully');
                    DB::commit();
                    if(Auth::user()->role=="candidate"){
                    return redirect('/edit/profile/'.$request->id);
                    }
	              
	            }else{

	                Session::flash('update', 'Candidate Information Not Updated Successfully');
	                if(Auth::user()->role=="candidate"){
                    return redirect('/edit/profile/'.$request->id);
              }

		        } 

			    }catch (\Exception $e) {
				    DB::rollback();
					Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
					// return Redirect::back();
					return $e->getMessage().''.$e->getLine();
				}


    }

    public function applyProjects()
    {
    	# code...

      $allApplyProjects=Job_Type::join('candidate_info','job_typs.job_type_id','=','candidate_info.post_id')->join('advertisement_jobs','job_typs.job_id','=','advertisement_jobs.ad_id')->where('candidate_info.nic',Auth::user()->cnic)->get();

      	return view('candidate.apply_project')->with('allApplyProjects',$allApplyProjects);

    }

    public function candidateDetails($id)
    {
    	
      # code...
      $candidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
      return view('candidate.candidate_details')->with('candidateInfo',$candidateInfo);

    }

    public function transactionDetails($id)
    {
      
      $candidateInfo=CandidateInfo::where('candidate_id',$id)->get()->first();
      return view('candidate.tran_candidate_details')->with('candidateInfo',$candidateInfo);

    }


   

   
    public function viewRollSlipCandidate($nic,$job_id,$project_id){
                  
            $CandidateInfo=CandidateInfo::where('nic',$nic)->where('job_id',$job_id)->where('post_id',$project_id)->where('roll_slip_status','yes')->get()->first(); 
            
            $pdf=PDF::loadView('downloadslip.pdf',compact('CandidateInfo'));
            return  $pdf->stream('downloadslip.pdf');

    }

    public function downloadRollSlipCandidate($nic,$job_id,$project_id){
                  
            $CandidateInfo=CandidateInfo::where('nic',$nic)->where('job_id',$job_id)->where('post_id',$project_id)->where('roll_slip_status','yes')->get()->first(); 
            
            $pdf=PDF::loadView('downloadslip.pdf',compact('CandidateInfo'));
            return  $pdf->download('downloadslip.pdf');
            

    }

   public function downloadResult(){

          $mytime =Carbon::now();
          $date=$mytime->toDateString();
          $allProjects=Projects::where('result_status','yes')->get();

          return view('downloadslip.result')->with('allProjects',$allProjects);     

    }

     public function viewResultCandidate($job_id){
          
              $CandidateInfo=UploadResult::where('id',$job_id)->get()->first();   $path=public_path()."/public/UploadResult/".$CandidateInfo->result;
              header('content-type:application/pdf');
              echo file_get_contents($path);

     }

   
    public function viewdownloadResultCandidate($job_id){
          
            $CandidateInfo=UploadResult::where('id',$job_id)->get()->first();
            $file= public_path()."/public/UploadResult/".$CandidateInfo->result;
            $headers = array(
                      'Content-Type: application/pdf',
                    );
            return Response::download($file, 'result.pdf', $headers);

     }
     
  public function downloadResultCandidate(Request $request){
         
          
             $CandidateInfo1=SingleResult::where('cnic',$request->cnic)->where('job_id',$request->project_id)->where('post_id',$request->post_id)->get()->count();

            if($CandidateInfo1 > 0){
           
            if($CandidateInfo=SingleResult::where('job_id',$request->project_id)->where('post_id',$request->post_id)->where('cnic',$request->cnic)->exists()){

              $CandidateInfo=SingleResult::where('cnic',$request->cnic)->where('job_id',$request->project_id)->where('post_id',$request->post_id)->get()->first();
              return view('/downloadslip/view_roll_result')->with('CandidateInfo',$CandidateInfo);
                   
            }else{
            
               Session::flash('error', 'Result not found');
               return redirect('/download/result');

            }
            
            }else{

               Session::flash('error', 'Your info not found');
               return redirect('/download/result');
               
            }
            

     }
    
     public function viewPost($id){

             $post=Job_Type::where('job_id',$id)->get();
      return view('admin.jobs.post')->with('post',$post);


     }

     public function postDelete(Request $request){

            $id=$request->id;
            $delete=Job_Type::where('job_type_id',$id)->delete();
           
            if($delete){
             
             return "Admin Deleted Successfully";
                
            }else{

             return "Admin Not Deleted Successfully";
           
            }
     }

     public function postEdit($id){

          $post=Job_Type::where('job_type_id',$id)->get()->first();
          return view('admin.jobs.editpost')->with('post',$post)->with('id',$id);

     }

     public function updatePost(Request $request){


        DB::beginTransaction();
         
          try{

         
          $update=array(
              'type_name'=>$request->post,
          );

          $job_id=Job_Type::where('job_type_id',$request->id)->get()->first();
          $sql=Job_Type::where('job_type_id',$request->id)->update($update);
          if($sql){
                    Session::flash('success', 'Result update successfully');
                    DB::commit();
                    return redirect('/view/post/'.$job_id->job_id);
          }else{
                    Session::flash('error', 'Result not update successfully');
                    return redirect('/view/post/'.$job_id->job_id);
          }  
          }catch (\Exception $e){
                   
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return $e->getMessage().''.$e->getLine();
            
            }
  

   }


    public function labelPrint(){

        $pdf            = new Fpdi();
        $pageCount      = $pdf->setSourceFile('form.pdf');
        $pageCount      = count(1);
        $pageNo         = 1;  
        $patient_full_name = 'Wajid Iqbal'; 
        // import a page
        $templateId = $pdf->importPage(1);
        // get the size of the imported page
        $size = $pdf->getTemplateSize($templateId);
        // add a page with the same orientation and size
        $pdf->SetAutoPageBreak(true);
        $pdf->AddPage($size['orientation'], $size);
        // use the imported page            
        $pdf->useTemplate($templateId);
        $pdf->SetFont('arial','B');
        $pdf->SetFontSize('8'); // set font size
        $pdf->SetXY(6, 5);
        $pdf->MultiCell(0,'3',"Real Testing Agency",'0','C',false);
        $pageNo++;
        $pdf->Output();
        exit;

    }
  



}
