<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Province;	
use App\Model\District;
use App\Model\Cities;
use Redirect;
use Session;
use DB;

class LocationController extends Controller
{
    //

    public function location()

    {
    	# code...
    	$province=Province::all();
	    return view('admin.location.all_provinces')->with('province',$province);

    }

    public function createProvince()

    {
    	# code...
    	
	    return view('admin.location.add_province');

    }

    
    public function addProvince(Request $request)

    {
    	# code...
    	        $this->validate($request, [
                      'province' => 'required|max:1000',  
                ]);

                DB::beginTransaction();

                try{

                  $sql=Province::create(array(
                          'pro_name' => $request->province,
                  )); 

                  if($sql){

                        Session::flash('success', 'New province succcesfully');
                        DB::commit();
                        return redirect('/location');
                 
                  }else{

                        Session::flash('success', 'New province not upload succcesfully');
                        return redirect('/location');
                
                }

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                  /*  return $e->getMessage().''.$e->getLine();*/
                }

    }

    public function editProvince($id)
    
    {
        # code...
        $editProvince=Province::where('pro_id',$id)->get()->first();
        return view('admin.location.edit_province')->with('editProvince',$editProvince);

    }

    public function updateProvince(Request $request){


                $this->validate($request, [
                      'province' => 'required|max:1000',  
                ]);

                DB::beginTransaction();
                try{

                    $update = array(
                          'pro_name' => $request->province,
                    );

                    $sql = Province::where('pro_id', $request->id)->update($update);
                     
                    if($sql){
                   
                        Session::flash('update', 'Province Updated Successfully');
                        DB::commit();
                        return redirect('/location');
                  
                      
                    }else{

                        Session::flash('update', 'Province Not Updated Successfully');
                        return redirect('/location');
                      

                    } 

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                    // return $e->getMessage().''.$e->getLine();
                }


    }

    public function provinceDelete(Request $request)
  
    {
        # code...
                $id=$request->id;
                $delete=Province::where('pro_id',$id)->delete();
                $deleteDistrict=District::where('pro_id',$id)->delete();
                $deleteCities=Cities::where('pro_id',$id)->delete();

               
                if($delete){
                 
                 return "Province Deleted Successfully";
                    
                }else{

                 return "Province Not Deleted Successfully";
               
                }

    }

    public function provinceDistrict($id)
  
    {
        # code...
            $district=District::where('pro_id',$id)->get()
            ;
            $province=Province::where('pro_id',$id)->get()->first();
        return view('admin.location.province_district')->with('district',$district)->with('province',$province);
           
    }

    public function addDistrict($id)
  
    {
        # code...
        $province=Province::where('pro_id',$id)->get()->first();
        return view('admin.location.add_district')->with('province',$province);
           
    }

    public function createDistrict(Request $request)

    {
        # code...
                $this->validate($request, [
                      'district' => 'required|max:1000',  
                ]);

                DB::beginTransaction();

                try{

                  $sql=District::create(array(

                          'dist_name' => $request->district,
                          'pro_id' => $request->pro_id,

                  )); 

                  if($sql){

                        Session::flash('success', 'New district add succcesfully');
                        DB::commit();
                        return redirect('/province/district/'.$request->pro_id);
                 
                  }else{

                        Session::flash('success', 'New district not add succcesfully');
                        return redirect('/province/district/'.$request->pro_id);
                
                }

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                  /*  return $e->getMessage().''.$e->getLine();*/
                }

    }

    public function editDistrict($id)
  
    {
        # code...
        $editDistrict=District::where('dist_id',$id)->get()->first();
        return view('admin.location.edit_district')->with('editDistrict',$editDistrict);
           
    }

    public function updateDistrict(Request $request){


                $this->validate($request, [
                      'district' => 'required|max:1000',  
                ]);

                DB::beginTransaction();

                try{

                    $update = array(
                        'dist_name' => $request->district,
                    );

                    $sql = District::where('dist_id', $request->dist_id)->update($update);
                    $pro_id=District::where('dist_id',$request->dist_id)->pluck('pro_id')->first();
                     
                    if($sql){
                   
                        Session::flash('update', 'District Updated Successfully');
                        DB::commit();
                        return redirect('/province/district/'.$pro_id);
                  
                      
                    }else{

                        Session::flash('update', 'District Not Updated Successfully');
                        return redirect('/province/district/'.$pro_id);

                    } 

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                    // return $e->getMessage().''.$e->getLine();
                }


    }

    public function districtDelete(Request $request)
  
    {
        # code...
                $id=$request->id;
                $delete=District::where('dist_id',$id)->delete();
               
                if($delete){
                 
                 return "District Deleted Successfully";
                    
                }else{

                 return "District Not Deleted Successfully";
               
                }

    }

    public function provinceCities($id){

        $province=Province::where('pro_id',$id)->get()->first();
        $cities=Cities::where('pro_id',$id)->get();
        return view('/admin.location.all_cities')->with('province',$province)->with('cities',$cities);

    }

    public function createCities($id)
  
    {
        # code...
        $province=Province::where('pro_id',$id)->get()->first();
        return view('admin.location.add_cities')->with('province',$province);
           
    }

    public function addCity(Request $request)

    {
        # code...
                $this->validate($request, [
                      'city' => 'required|max:1000',  
                ]);

                DB::beginTransaction();

                try{

                  $sql=Cities::create(array(

                          'city_name' => $request->city,
                          'pro_id' => $request->pro_id,

                  )); 

                  if($sql){

                        Session::flash('success', 'New city succcesfully');
                        DB::commit();
                        return redirect('/province/cities/'.$request->pro_id);
                 
                  }else{

                        Session::flash('success', 'New city not upload succcesfully');
                        return redirect('/province/cities/'.$request->pro_id);
                
                }

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                    /*  return $e->getMessage().''.$e->getLine();*/
                }

    }

    public function editCity($id)
  
    {
        # code...
        $editCities=Cities::where('city_id',$id)->get()->first();
        return view('admin.location.edit_cities')->with('editCities',$editCities);
           
    }

    public function updateCity(Request $request){


                $this->validate($request, [
                      'city' => 'required|max:1000',  
                ]);

                DB::beginTransaction();

                try{

                    $update = array(
                        'city_name' => $request->city,
                    );

                    $sql = Cities::where('city_id', $request->city_id)->update($update);
                    $pro_id=Cities::where('city_id', $request->city_id)->pluck('pro_id')->first();
                     
                    if($sql){
                   
                        Session::flash('update', 'City Updated Successfully');
                        DB::commit();
                        return redirect('/province/cities/'.$pro_id);
                  
                      
                    }else{

                        Session::flash('update', 'City Not Updated Successfully');
                        return redirect('/province/cities/'.$pro_id);

                    } 

                }catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('error', 'Sorry We are facing some problems, Please try again later.');
                    return Redirect::back();
                    // return $e->getMessage().''.$e->getLine();
                }


    }

    public function cityDelete(Request $request)
  
    {
        # code...
                $id=$request->id;
                $delete=Cities::where('city_id',$id)->delete();
               
                if($delete){
                 
                 return "City Deleted Successfully";
                    
                }else{

                 return "City Not Deleted Successfully";
               
                }

    }





}
