@extends('frontend.master')
@section('title', 'ALL Project')
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
                    <li class="breadcrumb-item active">Project Details</li>
                </ol>
                <h1>Project Details</h1>
            </div>
        </div>
    </div>
</div>

<div class="container custom-mt mt-4 mb-4" >
       
        <table class="table" width="100%">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Apply For</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
          
            <tbody> @foreach($postType as $key=> $type)
                        <tr>
                           
                <td><h5>{{++$key}}</h5></td>
                <td><h5>{{$type->type_name}}</h5></td>
                <td  class="text-center">
                    <a href="http://realts.org.pk/public/projectimages/1650988246.pcrtest-2.jpeg" class="btn btn-info" target="_blank">View</a>
                    <a href="http://realts.org.pk/public/projectimages" target="_blank" class="btn btn-success" download>Apply</a>
                    <a href="{{url('public/paperpatterns')}}" target="_blank" class="btn btn-warning" download>Paper Pattern</a>
                </td>
               
            </tr>
            @endforeach    
                     
                        </tbody>
        </table>
    </div>


@stop