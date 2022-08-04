<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Projects;
use App\Model\Cities;
use App\Model\TestCenter;
use App\User;

use Session;
use Redirect;
use Auth;
use DB;

class AdminController extends Controller
{

    //Dashboard Admin 

    public function Dashboard()

    {

        $data=array();
        $data['allProject']=Projects::all()->count();
        $data['allCity']=Cities::all()->count();
        $data['totalTestCenter']=TestCenter::all()->count();
        $data['totalCandidate']=User::where('role','candidate')->get()->count();
        $yearlySaleReports=DB::table('advertisement_jobs')
                       ->select(DB::raw('YEAR(created_at) YEAR'),DB::raw('Count(ad_id) as ad'))->orderBy('YEAR','ASC')
                       ->groupBy('YEAR')
                       ->get()->take('10');

        return view('/admin/dashboard')->with('data',$data)->with('yearlySaleReports',$yearlySaleReports);

    }

    //Add Admin

    public function createAdmin()
 
    {
    	
    	# code...
        return view('admin.adminmanagement.admin_add');
           	
    }

    public function addAdmin(Request $request)
   
    {
    	
    	# code...
      
	            $this->validate($request, [
	                  'first_name' => 'required|max:255',  
	                  'last_name' => 'required|max:255',    
	                  'email' => 'required|string|email|max:255|unique:users',      
	                  'password' => 'required|confirmed|min:6',
	                  'admin_image' => 'image|mimes:jpg,png,jpeg|max:5000',
	            ]);
                
	            DB::beginTransaction();

	            try{

	              if($request->admin_image!=null){
	                    $file = $request->admin_image;
	                    $fileName = time().'.'.$file->getClientOriginalName();
	                    $destinationPath = public_path('/public/adminimages');
	                    $file->move($destinationPath,$fileName);
	              }else{
	                     $fileName="dummy.jpg";
	              }

	              $sql = User::create(array(
	                      'first_name' => $request->first_name,
	                      'last_name' => $request->last_name,
	                      'full_name'=>$request->first_name.' '.$request->last_name,
	                      'email' =>$request->email,
	                      'image' =>$fileName,
	                      'password' => bcrypt($request->password),
	                      'role' =>$request->role,
	              )); 
	          
	              if($sql){
	                    Session::flash('success', 'New Admin/Superadmin/Operator Added Successfully');
	                    DB::commit();
	                    return redirect('/all/admin');
	              }else{
	                    Session::flash('success', 'New Admin/Superadmin/Operator Added Successfully');
	                    return redirect('/all/admin');
	              }

	            }catch (\Exception $e) {
				    DB::rollback();
					Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
					return Redirect::back();
					//return $e->getMessage().''.$e->getLine();
				}
           	
    }

    public function allAdmin()
   
    {
    	
    	# code...
               $allAdmin=User::where('role','!=','candidate')->get();

        return view('admin.adminmanagement.all_admin')->with('allAdmin',$allAdmin);
           	
    }

    public function editAdmin($id)
  
    {
    	
    	# code...
               $editAdmin=User::where('id',$id)->get()->first();

        return view('admin.adminmanagement.edit_admin')->with('editAdmin',$editAdmin);
           	
    }

    public function updateAdmin(Request $request){


                $this->validate($request, [
	                  'first_name' => 'required|max:255',  
	                  'last_name' => 'required|max:255',    
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
		                  $destinationPath = public_path('/public/adminimages');
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
	                  'image' => $Image,
	                  'role'=>$request->role,
	                );

		            $sql = User::where('id', $request->id)->update($update);
		             
		            if($sql){
		           
	                    Session::flash('update', 'Admin Information Updated Successfully');
	                    DB::commit();
	                    if(Auth::user()->role=="Admin"){
	                    return redirect('/edit/admin/'.$request->id);
	                    }else{
	                    return redirect('/all/admin');
	                    }
		              
		            }else{

		                Session::flash('update', 'Admin Information Not Updated Successfully');
		                if(Auth::user()->role=="Admin"){
	                    return redirect('/edit/admin/'.$request->id);
	                    }else{
	                    return redirect('/all/admin');
	                    }

			        } 

			    }catch (\Exception $e) {
				    DB::rollback();
					Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
					return Redirect::back();
					// return $e->getMessage().''.$e->getLine();
				}


    }

    public function adminDelete(Request $request)
  
    {
    	# code...
		        $id=$request->id;
		        $delete=User::where('id',$id)->delete();
		       
		        if($delete){
		         
		         return "Admin Deleted Successfully";
		           	
		        }else{

		         return "Admin Not Deleted Successfully";
		       
		        }

    }

    public function updatePassword(Request $request)
  
    {
    	# code...
                    
		        $this->validate($request, [
		              'changes_pasword' => 'required|min:6',
		        ]);

		        DB::beginTransaction();
		      
		        try{    

		        $update=array('password'=>bcrypt($request->changes_pasword)); 
		        $updateuser=User::where('id',Auth::user()->id)->update($update); 

		        if($updateuser){

		              Session::flash('update_password', 'password change successfully.');
		               DB::commit();
		              return Redirect::back();
		        
		        }else{

		                Session::flash('update_password', 'password change not update successfully.');
		                 return Redirect::back();
		           
		        }

		        }catch (\Exception $e) {
					    DB::rollback();
						Session::flash('update_password', 'Sorry We are facing some problems, Please try again later.');
						return Redirect::back();
						// return $e->getMessage().''.$e->getLine();
			    }



    }


    public function adminlogin(){
    
                return view('auth.admin_login');

    }

    public function logout()
  
    {
    	# code...
    	if(Auth::User()->role=="candidate"){
	
					Auth::logout();
				return	redirect('/login');  

	    }else{

        		Auth::logout();
		return	redirect('/admin/login');  

		 
        }
	 }


}
