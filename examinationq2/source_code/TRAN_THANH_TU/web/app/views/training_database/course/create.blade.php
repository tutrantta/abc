@extends('layouts.main')

@section('title', 'Course Management')

@section('breadcrumb')
    <li><a href="{{URL::route('home')}}">Home</a></li>
    <li><a href="{{URL::route('course-list')}}">Course Management</a></li>  
    <li>Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group">
                        <a href="{{ URL::route('course-list')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="panel-body form-horizontal" role="form">
                    {{ Form::open(['route'=>'course-create','method'=> 'POST', 'class'=>'form-trainer']) }}
                     {{--show error message--}}
                    {{ Helper::ShowErrorsMessage($errors) }}
                    <div class="form-group bm-form-item required">
                        <label class="col-md-2 control-label">Course </label>
                        <div class="col-md-8">
                            {{ Form::text('course_name', null,['id' => 'course_name','class'=>'form-control','placeholder'=>'Course name','autofocus'=> true,'required']) }}
                        </div>
                    </div>
                    <div class="form-group bm-form-item required">
                        <label class="col-md-2 control-label">Area </label>
                        <div class="col-md-8">
                            {{ Form::select('area_id', $arrAreaList, null, ['id' => 'area_id', 'class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group bm-form-item">
                        <label class="col-md-2 control-label">Description </label>
                        <div class="col-md-8">
                            {{ Form::textarea('description', null, ['class'=>'form-control','row'=> 2]) }}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="btn-group pull-right">
                        {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop