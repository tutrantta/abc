<!-- Create by Nguyen Trieu Start 2015-04-08-->
@extends('layouts.main')
@section('title','Soft Skill Index Manager')
@section('breadcrumb')
<li><a href="{{URL::route('soft-skill-manager')}}">Soft Skill Index Manager</a></li>
<li>Create</li>
@stop
@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{URL::route('soft-skill-manager')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body">
            {{ Helper::ShowErrorsMessage($errors) }}
            {{Form::open(['method' => 'POST', 'class' => 'form-horizontal'])}}
            <div class="form-group">
                <label class="col-md-2 control-label">Skill <span class="ta-requied">*</span></label>
                <div class="col-md-6">
                {{Form::text('soft_skill_name', '', ['class'=> 'form-control'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('soft_skill_description', 'Description', ['class' => 'col-md-2 control-label'])}}
                <div class="col-md-6">
                {{Form::textarea('soft_skill_description', '', ['class' => 'form-control', 'rows' => 3])}}
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
            {{Form::close()}}
        </div>
    </div>
</div>
@stop