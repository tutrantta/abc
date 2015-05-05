@extends('layouts.main')
@section('title','User Management')
@section('breadcrumb')
<li><a href="{{ URL::route('user-list') }}">Home</a></li>
<li><a href="{{ URL::route('user-list') }}">User Management</a></li>
<li class="active">Reset Password</li>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{URL::route('user-detail',$data['id'])}}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{ 
                    Form::open(['route'=>['user-excute-reset-password',$data['id']],'class'=>'form-signin'])
                }}
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        New Password
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::password('password',['class'=>'form-control','placeholder'=>'New Password','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Confirm New Password
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Confirm New Password','autofocus'=>True,'required'=>True]) }}
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
