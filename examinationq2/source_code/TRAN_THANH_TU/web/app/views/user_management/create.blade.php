@extends('layouts.main')
@section('title','User Management')
@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li><a href="{{ URL::route('user-list') }}">User Management</a></li>
<li class="active">Add</li>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{URL::route('user-list')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{ Form::open(['route'=>'user-store','class'=>'form-signin']) }}
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Full Name
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Full Name','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Username
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('username',null,['class'=>'form-control','placeholder'=>'Username','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Password
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Password Confirmation
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Password Confirmation','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Email
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-10">
                        {{ Form::text('email',null,['class'=>'form-control','placeholder'=>'Email','autofocus'=>True,'required'=>True]) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Admin
                    </label>
                    <div class="col-md-2">
                        <label class="radio-inline">
                            {{ Form::radio('is_admin',1, ((Input::old('is_admin') == 1)? true : false), ['class' => 'field']) }}Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('is_admin',0, ((Input::old('is_admin') == 0) ? true : false), ['class' => 'field']) }}No
                        </label>
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Active
                    </label>
                    <div class="col-md-2">
                        <label class="radio-inline">
                            {{ Form::radio('is_active',1, ((Input::old('is_active') == 1)? true : false), ['class' => 'field','checked'=>true]) }}Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('is_active',0, ((Input::old('is_active') == 0) ? true : false), ['class' => 'field']) }}No
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
