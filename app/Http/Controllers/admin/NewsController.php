<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Model\Projects;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $news = News::all();
        return view('admin.news.news')->with('news',$news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projects = Projects::all();

        return view('admin.news.news_create')->with('projects',$projects);
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
          'project_id' => 'required',
          'news' => 'required|max:1000',
          'annoucement_type'=>'required',
        ]);
        $data = [
            'project_id' => $request->project_id,
            'annoucement_type' => $request->annoucement_type,
            'news' => $request->news,
        ];
        $sql = News::create($data);
        if($sql){
            return redirect('/news')->with('success',"Save Successfully");
        }else{
            return redirect('/news/create')->with('error',"Not Add Successfully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::where('id',$id)->first();
        $projects = Projects::all();
        return view('admin.news.edit')->with('news',$news)->with('projects',$projects);
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
         //
        $this->validate($request, [
          'project_id' => 'required',
          'news' => 'required|max:1000',
          'annoucement_type'=>'required',
        ]);
        $data = [
            'project_id' => $request->project_id,
            'annoucement_type' => $request->annoucement_type,
            'news' => $request->news,
        ];
        $sql = News::where('id',$request->id)->update($data);
        if($sql){
            return redirect('/news')->with('update',"Update Successfully");
        }else{
            return redirect('/news/create')->with('error',"Not Update Successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $id=$request->id;
         $delete=News::where('id',$id)->delete();
         if($delete){
         
         return "Admin Deleted Successfully";
            
        }else{

         return "Admin Not Deleted Successfully";
       
        }


    }
}
