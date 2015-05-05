@extends('layouts.main')
@section('title','User Management')
@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li><a href="{{ URL::route('user-list') }}">User Management</a></li>
<li class="active">Edit</li>
@stop
@section('content')
<?php 
    Auth::user()->is_admin != \Config::get('configs.is_admin') ? $check = 'disabled' : $check = null;
    if($data['is_admin'] == \Config::get('configs.is_admin')){
        $flag_admin = true;
        $flag_user =  false;
    }else{
        $flag_admin = false;
        $flag_user =  true;
    }
    if($data['is_active'] == \Config::get('configs.user_active')){
        $flag_active_yes = true;
        $flag_active_no =  false;
    }else{
        $flag_active_yes = false;
        $flag_active_no =  true;
    }
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{URL::route('user-list')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{ Form::open(['route'=>['user-update',$data['id']],'class'=>'form-signin']) }}
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Full Name
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('full_name',$data['full_name'],['class'=>'form-control','placeholder'=>'Full Name','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Username
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('username',$data['username'],['class'=>'form-control','placeholder'=>'Username','autofocus'=>True,'required'=>True,'disabled'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Email
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('email',$data['email'],['class'=>'form-control','placeholder'=>'Email','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Admin
                    </label>
                    <div class="col-md-2">
                        <label class="radio-inline">
                            {{ Form::radio('is_admin',1, $flag_admin, ['class' => 'field',$check]) }}Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('is_admin',0, $flag_user, ['class' => 'field',$check]) }}No
                        </label>
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Active
                    </label>
                    <div class="col-md-2">
                        <label class="radio-inline">
                            {{ Form::radio('is_active',1, $flag_active_yes, ['class' => 'field',$check]) }}Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('is_active',0, $flag_active_no, ['class' => 'field',$check]) }}No
                        </label>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="btn-group pull-right">
                    <button class="btn btn-default" type="reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
                <div class="clearfix"></div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
