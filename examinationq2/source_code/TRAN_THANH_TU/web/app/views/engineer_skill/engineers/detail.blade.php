<!-- Create by Vo Le Quynh My Start 2015-03-31-->
@extends('layouts.main')
@section('title','Engineer General Information')
@section('breadcrumb')
<li><a href="{{ URL::to('home')}}">Home</a></li>
<li><a href="{{ URL::route('engineer-list')}}">List Engineers</a></li>
<li>Edit</li>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
         <div class="panel-heading">
            <h4> Details Engineer Information </h4>
        </div>
        {{ Helper::ShowSuccessMessage() }}
        {{ Helper::ShowErrorsMessage($errors) }}
        <div class="panel-body">
         {{ Form::open(array('route'=>['engineer-update', $data['engineer_id']], 'method'=>'PUT', 'class'=>'form-horizontal')) }}
         {{ Form::hidden('name','value') }}
         <div class="row">
            <div class="form-group">
                <label for="exampleInputName2" class="col-md-2 control-label">Engineer Name
                    <span class="ta-requied">*</span>
                </label>
                <div class="col-md-3">
                    {{ Form::text('fullname', $data['fullname'], array('id'=>'','class'=>'form-control','placeholder' => 'Engineer Name', 'required')) }}
                </div>

                <label for="exampleInputEmail2" class="col-md-1 control-label">Engineer ID
                    <span class="ta-requied">*</span>
                </label>
                <div class="col-md-2">
                    {{ Form::text('employee_code', $data['employee_code'],array('id'=>'','class'=>'form-control','placeholder' => 'Engineer ID', 'required')) }}
                    {{ Form::hidden('employee_code_hidden', $data['employee_code'], ['class' => 'form-control']) }}
                </div>

                <label for="exampleInputEmail2" class="col-md-1 control-label">Status</label>
                <div class="col-md-2">
                    <label class="radio-inline">
                        {{ Form::radio('is_active','1', $data['is_active'] == 1) }}ON
                    </label>
                    <label class="radio-inline">
                        {{ Form::radio('is_active', '0', $data['is_active'] == 0) }}OFF
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="exampleInputName2" class="col-md-2 control-label">Address</label>
                <div class="col-md-3">
                    {{ Form::text('address', $data['address'],array('id'=>'','class'=>'form-control','placeholder' => 'Address')) }}
                </div>

                <label for="exampleInputEmail2" class="col-md-1 control-label">Department</label>
                <div class="col-md-2">
                    {{ Form::select('department_id', $arrDepartment, $data['department_id'], ['class' => 'form-control', 'required']); }}
                </div>

                <label for="exampleInputEmail2" class="col-md-1 control-label">Birthday
                    <span class="ta-requied">*</span>
                </label>
                <div class="col-md-2">
                    <div class='input-group date' id='datetimepicker1'>
                        {{ Form::text('birthday', $data['birthday'],array('id'=>'','class'=>'form-control','placeholder' => 'Birthday', 'required')) }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="exampleInputName2" class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-3">
                    {{ Form::text('phone', $data['phone'],array('id'=>'','class'=>'form-control','placeholder' => 'Phone Number')) }}
                </div>

                <label for="exampleInputEmail2" class="col-md-1 control-label">Gender</label>
                <div class="col-md-2">
                    {{ Form::select('gender', ['f' => 'Female', 'm' => 'Male', 'o' => 'Other'],$data['gender'],['class'=>'form-control']); }}
                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="exampleInputEmail2" class="col-md-2 control-label">Working skill</label>
                <div class="col-md-3">
                    {{ Form::text('working_area_name', $data['working_area_name'], ['class' => "form-control required", 'readonly']) }}
                </div>

                <label for="exampleInputName2" class="col-md-1 control-label">Position</label>
                <div class="col-md-2">
                    {{ Form::text('level_name', $data['level_name'], ['class' => "form-control required", 'readonly']) }}
                </div>
                <div class="col-md-4 ta-text-position">
                    <a href="">View Position History</a>
                </div>

            </div>
        </div>
        @if ($data['has_interview_form'] != 0)
        <div class="row">
            <div class="form-group">
                <div class="dataTable_wrapper col-md-offset-1 col-md-4">
                    <table class="table table-striped table-bordered">
                        <caption class="text-left">
                            <b class= "ta-caption">1. Techniques</b>
                            <a href="{{ URL::route('technique-detail', array($data['engineer_id'])) }}">view more</a>
                        </caption>
                        <thead>
                            <tr>
                                <th>Techniques</th>
                                <th>Level</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($arrTechnique as $keyItem => $item)
                            <tr>
                                <td>{{ $item['technique_name'] }}</td>
                                <td>{{ $item['level_name'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="dataTable_wrapper col-md-offset-1 col-md-4">
                    <table class="table table-striped table-bordered">
                        <caption class="text-left">
                            <b class= "ta-caption">2. Soft skills</b>
                            <a href="{{ URL::route('softskill-detail', array($data['engineer_id'])) }}">view more</a>
                        </caption>
                        <thead>
                            <tr>
                                <th>Sotf skills</th>
                                <th>Level</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($arrSoftSkill as $keyItem => $item)
                            <tr>
                                <td>{{ $item['soft_skill_name'] }}</td>
                                <td>{{ $item['soft_skill_level'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="form-group">
                <div class="col-md-offset-1 col-md-9">
                    @if ($data['has_interview_form'] == 0)
                    <a href="{{ URL::route('interview-form', array($data['engineer_id'], $data['has_interview_form']))}}" class="btn btn-primary">Create Interview Form</a>
                    @else
                    <a href="{{ URL::route('interview-form', array($data['engineer_id'], $data['has_interview_form']))}}" class="btn btn-primary">Interview Result</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-offset-1 col-md-10">
                    <span class="text-left"><b>3. Other information</b></span>
                    {{ Form::textarea('other_information', $data['other_information'], ['size' => '140x6', 'class' => 'form-control']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="btn-group pull-right">
            {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
            {{ Form::submit('Save',array('class'=>'btn btn-primary','data-button'=>'submit')) }}
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