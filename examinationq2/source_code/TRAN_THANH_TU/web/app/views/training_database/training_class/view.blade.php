<!-- Create by LamKy Start 2015-04-13-->
@extends('layouts.main')
@section('title','Training Class Management')
@section('breadcrumb')
    <li><a href="{{ URL::route('home'); }}">Home</a></li>
    <li><a href="{{ URL::route('list-class'); }}">Training Class</a></li>
    <li>Detail</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <a href="{{ URL::route('list-class'); }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="panel-body">
                {{ Form::open(array('class'=>'form-horizontal', 'autocomplete' => 'off')) }}
                    <div class="form-group">
                        <label for="" class="col-md-2 col-sm-2 control-label">Name
                            <span class="ta-requied">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                                {{Form::text('class_name', $arrDetail->class_name, ['class'=> 'form-control', 'readonly', 'maxlength' => '50'])}}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputPassword3" class="col-md-2 col-sm-2 control-label">
                            Course <span class="ta-requied">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            {{ Form::select('course_id', $arrCourse, $arrDetail->course_id, ['class' => "form-control", 'disabled', 'readonly']); }}
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-md-2 col-sm-2 control-label">
                            Date <span class="ta-requied">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3">
                            <div class='input-group date' id='datetimepicker1'>
                                {{Form::text('date', $arrDetail->date, ['class'=> 'form-control', 'readonly'])}}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="input-group col-md-2 col-sm-2">
                            <span class="input-group-addon">
                                <span>Duration (Hours)</span>
                            </span>
                                {{Form::text('duration', $arrDetail->duration, ['class'=> 'form-control', 'readonly'])}}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputPassword3" class="col-md-2 col-sm-2 control-label">Trainer</label>
                        <div class="col-md-6 col-sm-6">
                            {{ Form::select('trainer_id', $arrTrainer, $arrDetail->trainer_id, ['class' => "form-control", 'disabled', 'readonly']); }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox col-md-2 col-sm-2 control-label">
                            Examine
                        </label>
                        <div class="col-md-1 col-sm-1">
                                {{ Form::checkbox('has_exaination', 1, ($arrDetail->has_examination == '1'), ['class' => 'checkbox ta-checkbox', 'disabled', 'readonly']) }}
                        </div>
                    </div>
            </div>
            <div class="panel-footer">
                <div class="btn-group pull-left">
                    <a class="btn btn-default" href="{{ URL::route('assign-engineer',$arrDetail->class_id) }}">Trainees List</a>
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
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
@stop