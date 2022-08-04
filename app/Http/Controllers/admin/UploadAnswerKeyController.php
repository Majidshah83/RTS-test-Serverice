<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AnswerKey;
use App\Model\Projects;
use App\Model\Job_Type;

class UploadAnswerKeyController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.answeykey.index')->with('id',$id);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function updateCreate(Request $request)
    {
        //

        $this->validate($request, [
          'key' => 'required',
        ]);
        $post = AnswerKey::where('post_id',$request->post_id)->first();
        $key = $request->key;
        $fileName = time().'.'.$key->getClientOriginalName();
        $destinationPath = public_path('/public/key');
        $key->move($destinationPath,$fileName);
        $data = [
            'post_id' => $request->post_id,
            'key' => $fileName,
        ];
        if(empty($post)){
            $sql = AnswerKey::create($data);
        }else{
           $sql = $post->update($data);
        }

        if($sql){
            $post=Job_Type::where('job_type_id',$request->post_id)->get()->first();
            return redirect('view/post/'.$post->job_id)->with('success',"Answer Key Uploaded Successfully");
        }else{
            return redirect('/news/create')->with('error',"Not Add Successfully");
        }


    }

   
}
