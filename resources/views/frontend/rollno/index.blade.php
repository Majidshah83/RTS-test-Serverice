@extends('frontend.master')
@section('title', 'Roll number Slip')
@section('content')
<div class="container-fluid without">
    <div class="row align-content-center">
        <div class="page-title">
            <div class="box-overlay">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">ROLL noSlip</li>
                </ol>
                <h1>ROLL noSlip</h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
          

               
               
        <form class="form" method="POST" action="{{url('/download/slip')}}" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">            
        <div class="row" >
                           
                            <div class="col-lg-6 col-md-offser-3" >
                                <div class="form-group">
                                    <label for="userinput1"  class="laberfor" style="margin-inline-start: 50%;">
                                        select project
                                        <span class="danger">*</span>
                                    </label>
                                    <div class="controls">

                                        <select style="margin-inline-start: 50%;" class="form-control" name="project_id" id="select_project">
                                            
                                            @foreach($allProjects as $project)
                                            <option value>select project</option>
                                            <option value="{{$project->ad_id}}">{{$project->ad_title}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-6 col-md-offser-3" >
                                <div class="form-group">
                                    <label for="userinput1" class="laberfor" style="margin-inline-start: 50%;">
                                       Desired Post
                                      
                                    </label>
                                    <div class="controls">
                                        <select style="margin-inline-start: 50%;" class="form-control" name="post_id" id="apply_post">
                                         
                                        <option value>select  post</option>
                                            <option value></option>
                                            
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-6 col-md-offser-3" >
                                <div class="form-group">
                                    <label for="userinput1" class="laberfor" style="margin-inline-start: 50%;">
                                      Cnic
                                    </label>
                                    <div class="controls">
                                        <input style="margin-inline-start: 50%;" class="form-control" type="text" name="cnic" placeholder="cnic without dash" id="cnic">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button style="margin-inline-start: 40%;" type="submit" class="btn btn-success" id="send_form">Download slip</button>
                        </div>
                    </form>

               
                

        </div>
    </div>
</div>
<script type="text/javascript">



       $(document).ready(function(){
        
          $('#select_project').on('change keyup',function(){
          
                var $option = $(this).find('option:selected');
               
                var value = $option.val();  

                $.ajax({

                    type:"get",

                    url:"{{ url('/desired/post') }}",

                    data:{project_id:value},

                    success: function(response){

                        $('#apply_post').html(response);

                }

               });

          });

       });



  </script>

@stop