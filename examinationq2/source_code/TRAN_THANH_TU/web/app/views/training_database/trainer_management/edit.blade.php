@extends('layouts.main')
@section('title', 'Trainer Management') 
@section('breadcrumb')
    <li><a href="{{ URL::to('home')}}">Home</a></li>
    <li><a href="{{ URL::route('trainer-list')}}">Trainer Management</a></li>
    <li>Edit</li>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <a href="{{ URL::route('trainer-list')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{ Form::open(['route'=>['trainer-update', $data->trainer_id], 'method'=> 'POST', 'class'=>'form-trainer']) }}
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Employee ID
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-8">
                        {{ Form::select('employee_code', $code, $data->employee_code, ['class' => 'form-control', 'readonly', 'disabled'=> True]) }}
                        <input type='hidden' value='{{$data->employee_code}}' name='employee_code' />
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Name
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-8">
                        {{ Form::text('trainer_name', $data->trainer_name,['class'=>'form-control','placeholder'=>'Trainer name','autofocus'=>True,'readonly']) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Department
                    </label>
                    <div class="col-md-8">
                        {{ Form::textarea('description',$data->description, ['class'=>'form-control','row'=>2]) }}
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
