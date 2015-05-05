@extends('layouts.main')
@section('title','User Management')
@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li><a href="{{ URL::route('user-list') }}">User Management</a></li>
<li class="active">Detail</li>
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
                @if($check == null)
                <a href="{{URL::route('user-reset-password',$data['id'])}}" class="btn btn-primary pull-right">Reset Password</a>
                @endif
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                {{-- show Success message --}}
                {{ Helper::ShowSuccessMessage() }}
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Full Name
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('full_name',$data['full_name'],['class'=>'form-control','placeholder'=>'Full Name','disabled'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Username
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('username',$data['username'],['class'=>'form-control','placeholder'=>'Username','disabled'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Email
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('email',$data['email'],['class'=>'form-control','placeholder'=>'Email','disabled'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Admin
                    </label>
                    <div class="col-md-2">
                        <label class="radio-inline">
                            {{ Form::radio('is_admin',1, $flag_admin, ['class' => 'field','disabled'=>True]) }}Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('is_admin',0, $flag_user, ['class' => 'field','disabled'=>True]) }}No
                        </label>
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Active
                    </label>
                    <div class="col-md-2">
                        <label class="radio-inline">
                            {{ Form::radio('is_active',1, $flag_active_yes, ['class' => 'field','disabled'=>True]) }}Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('is_active',0, $flag_active_no, ['class' => 'field','disabled'=>True]) }}No
                        </label>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="btn-group pull-right">
                    <a class="btn btn-primary" href="{{ URL::route('user-edit',$data['id']) }}">Edit</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@stop
