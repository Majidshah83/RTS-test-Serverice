<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\TestCenter;
use App\Model\Cities;
use DB;
use Session;
use Redirect;

class CenterController extends Controller
{
    //
    public function currentCenter()
    {
    	# code...
    	       $center=TestCenter::all();
    	return view('admin.center.all_center')->with('center',$center);
    }

    public function addCenter()
  
    {
    	# code...
    	       $allCity=Cities::all();
    	return view('admin.center.add_center')->with('allCities',$allCity);

    }

    public function storeCenter(Request $request)
    
    {
    	# code...
	          $this->validate($request, [

                  'center_name' => 'required|max:255',  
                  'city' => 'required|max:255',
                  'candidate_capacity' => 'required|max:255',
           
            ]);
            
            DB::beginTransaction();

            try{

              $sql = TestCenter::create(array(
                      'center_name' => $request->center_name,
                      'city_id' => $request->city,
                      'candidate_per_center'=>$request->candidate_capacity,
              )); 
          
              if($sql){
                    Session::flash('success', 'New center added successfully');
                    DB::commit();
                    return redirect('/current/center');
              }else{
                    Session::flash('success', 'New center not added successfully');
                    return redirect('/current/center');
              }

            }catch (\Exception $e) {
			    DB::rollback();
				Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
				return Redirect::back();
				//return $e->getMessage().''.$e->getLine();
			}
       	
    	      
    }

    public function editCenter($id)
   
    {
    	# code...
    	       $testCenter=TestCenter::where('center_id',$id)->get()->first();
    	       $allCity=Cities::all();
    	return view('admin.center.edit_center')->with('testCenter',$testCenter)->with('allCities',$allCity);
    }

    public function updateCenter(Request $request){


            $this->validate($request, [
                  'center_name' => 'required|max:1000', 
                  'city' => 'required|max:255',
                  'candidate_capacity' => 'required|max:1000',
            ]);

            DB::beginTransaction();
            try{

                $update = array(

                      'center_name' => $request->center_name,
                      'city_id' => $request->city,
                      'candidate_per_center'=>$request->candidate_capacity,
               
                );

                $sql = TestCenter::where('center_id', $request->center_id)->update($update);
             
                if($sql){
               
                    Session::flash('update', 'Center Updated Successfully');
                    DB::commit();
                    return redirect('/current/center');
              
                }else{

                    Session::flash('update', 'Center Not Updated Successfully');
                    return redirect('/current/center');
                  

                } 

            }catch (\Exception $e) {
                DB::rollback();
                Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                return Redirect::back();
                // return $e->getMessage().''.$e->getLine();
            }


    }

    public function centerDelete(Request $request)
  
    {
        # code...
                $id=$request->id;
                $delete=TestCenter::where('center_id',$id)->delete();
               
                if($delete){
                 
                 return "Province Deleted Successfully";
                    
                }else{

                 return "Province Not Deleted Successfully";
               
                }

    }


}
