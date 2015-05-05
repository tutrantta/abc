<!-- Create by Vo Le Quynh My Start 2015-03-31-->
@extends('layouts.main')
@section('title','Engineer General Information')
@section('breadcrumb')
    <li><a href="{{ URL::to('home')}}">Home</a></li>
    <li><a href="{{ URL::route('engineer-list')}}">List Engineers</a></li>
	<li>Create</li>
@stop
@section('script-header')
<script src="/contents/common/forms/js/confirm.js"></script>
@stop
@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="btn-group">
                    <a href="{{ URL::route('engineer-list')}}" class="btn btn-primary">Back</a>
                </div>
			</div>
			<div class="panel-body">
				{{ Form::open(array('route'=>'engineer-add-post','method'=>'POST', 'class'=>'form-horizontal', 'id' => 'form-add')) }}
				    {{ Helper::ShowErrorsMessage($errors) }}
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Engineer Name
                            <span class="ta-requied">*</span>
                        </label>
                        <div class="col-md-6">
                            {{ Form::text('fullname','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter Your Engineer Name', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-md-3 control-label">Employee Code
                            <span class="ta-requied">*</span>
                        </label>
                        <div class="col-md-6">
                            {{ Form::text('employee_code','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter Your Employee Code', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Permanent Address</label>
                        <div class="col-md-6">
                            {{ Form::text('address','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter Your Address')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Birthday</label>
                        <div class="col-md-6">
                            <div class='input-group date' id='datetimepicker1'>
                                {{ Form::text('birthday','',array('id'=>'','class'=>'form-control','placeholder' => 'DD-MM-YYYY')) }}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Phone Number</label>
                        <div class="col-md-6">
                            {{ Form::text('phone','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter Your Phone Number')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            {{ Form::text('email','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter Your Email')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-md-3 control-label">Gender</label>
                        <div class="col-md-2">
                            {{ Form::select('gender', array('male' => 'Male', 'female' => 'Female', 'other' => 'Other'), Input::old('gender'), ['class' => 'form-control'] )}}
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
@section('script')
<script type="text/javascript">
    $(function () {
        // set default value date
        var d = new Date();
        var month = '01';
        var day = '01';
        var minyear = d.getFullYear() - 65;
        var maxyear = d.getFullYear() - 18;
        $('#datetimepicker1').datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: minyear + '-' + month + '-' + day,
            maxDate: maxyear + '-' + month + '-' + day,
        });
    });
</script>
@stop