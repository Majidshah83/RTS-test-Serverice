@extends('frontend.master') 
@section('title', 'Application/status') 
@section('content') 
<style>
  .status{
    background: #fcfcfc;
    padding-top: 20px;
    padding-bottom:20px !important;
    border: #e7e7e7 1px solid;
  
  }
  
</style>
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
          <li class="breadcrumb-item active">Application/Status</li>
        </ol>
        <h1>Application/Status</h1>
      </div>
    </div>
  </div>
</div>







<div class="container">
        <div class="row my-5">
            <div class="col-lg-12 col-sm-12 col-xs-12">
            
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12 d-block mx-auto">
                        <div class="box_wrapper p-5">
                            <h4 class="text-center">Check Your Application Status</h4>
                          
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-success" id="msg_div">
                                      <span id="res_message" ></span>
                                  </div>
                              </div>
                          </div>

                        
                            <form action="" method="post" class="php-email-form" id="application-status-form">
                          
                            <input type="hidden" id="project_id" name="project_id" value="{{$projectId}}">

                                <div class="row mb-3">
                                    <div class="col-md-12 form-group">
                                    <label>Select Desired Post *</label>
                                      <select id="post" name="post_id" class="form-control" required>
                                        <option value="">Select Desired Post</option>
                                          @foreach($postType as $type)
                                          <option value="{{$type->job_type_id}}">{{$type->type_name}}</option>
                                          @endforeach
                                      
                                      </select>
                                    </div>

                                </div>
                                <input type="hidden" id="project_id" name="project_id" value="{{$projectId}}">
                                <div class="row mb-3">
                                    <div class="col-md-12 form-group mt-3 mt-md-0">

                                    <label for="cnic">Enter CNIC (Without Dashes) *</label>
                                      <input type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter cnic no..." required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 form-group">
                                    <button type="submit" id="send_form" class="btn btn-success">Search</button>

                                    </div>
                                </div>
                            </form>
                                </br>
                            <div class="row" id="result-table-div">
                          <div class="col-md-12 ">
                              <div id="result-table">

                              </div>
                          </div>
                      </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    



    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $('#msg_div').hide();
            $('#result-table-div').hide();
            $('#application-status-form').on('submit', function(e) {
                e.preventDefault();
                var $option = $(this).find('option:selected');
                var post_id = $option.val();
                var cnic = $('#cnic').val();
                var project_id = $('#project_id').val();
                
                $('#send_form').html('Checking..');
                $("#send_form").attr("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('/check-eligibility-status') }}",
                    data: {post_id:post_id, cnic:cnic, project_id:project_id},
                    success: function(response) {
                        if (response.status === false){
                            $('#msg_div').show();
                            $('#res_message').show();
                            $('#msg_div').removeClass('alert-success');
                            $('#msg_div').addClass('alert-danger');
                            $("#send_form").attr("disabled", false);
                        }else if (response.status === true){
                          $('#msg_div').show();
                            $('#res_message').show();
                            $('#msg_div').removeClass('alert-danger');
                            $('#msg_div').addClass('alert-success');
                            $("#send_form").attr("disabled", false);
                        }
                        $('#send_form').html('Download Result');
                        $('#res_message').html(response.msg);
                        document.getElementById("application-status-form").reset();
                        setTimeout(function(){
                            $('#res_message').hide();
                            $('#msg_div').hide();
                            
                        },9000);
                        $('#result-table-div').show();
                        console.log(response.result)
                        $('#result-table').html(response.result);
                    }
                });
            });
        });

    </script>
@endsection