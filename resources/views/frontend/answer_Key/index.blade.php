@extends('frontend.master')
@section('title', 'Answer key')

@section('content')
<style>
    .picon {
        background: yellow;
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
                    <li class="breadcrumb-item active">Answer key</li>
                </ol>
                <h1>Answer key</h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body p-4"> @foreach($projects as $project)
                        <a href="{{url('answer-key/post', $project->ad_id)}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="h-t ng-binding">{{$project->ad_title}}</h3>

                                </div>
                                <div class="col-md-7">
                                    <h6 class="blg">
                                        <i class="fa fa-clock-o"></i>
                                        <b class="ng-binding">
                                            {{$project->ad_last_date_submission}}</b>
                                    </h6>
                                </div>
                                <div class="col-md-5">
                                    <div class="icons">
                                        <i class="fa fa-info-circle"></i>
                                        <b class="picon"> Please Donot Write Portable Number in Application Form</b>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <input type="button" class="btn btn-primary btn-md" value="View Downloads">
                                </div>
                            </div>
                            <div class="entry-meta"></div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 text-center">
                <input type="button" class="btn btn-lg btn-primary" value="Load More Projects">
            </div>
        </div>
    </div>
</div>
@stop
