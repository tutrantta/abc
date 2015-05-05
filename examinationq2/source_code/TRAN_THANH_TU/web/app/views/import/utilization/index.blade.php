@extends('layouts.main')
@section('title','Monthly Utilization Import')
@stop
@section('breadcrumb')
    <li><a href="{{URL::route('home')}}">Home</a></li>
    <li>Monthly Utilization</li>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="{{URL::route('home')}}">Back</a>
                </div>
                {{ Helper::ShowSuccessMessage() }}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="panel-body">
                    {{Form::open(array('class' => 'form-horizontal', 'id' => 'frmUtilization', 'files' => true, 'url' => URL::route('import-utilization')))}}
                        <div class="row">
                            <div class="form-group required col-md-8">
                                <label for="import-datepicker" class="col-md-4 col-md-offset-4 control-label">Import Date</label>
                                <div class="col-md-4">
                                    <div class='input-group date' id='import-datepicker'>
                                        {{ Form::text('import_date',null,['class' => 'form-control', 'required']) }}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group required col-md-8">
                                <label for="inputEmail3" class="col-md-4 col-md-offset-4 control-label">File</label>
                                <div class="col-md-4">
                                    {{Form::file('file', ['required'])}}
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <div class="checkbox col-md-offset-8">
                                    <label>
                                        {{Form::checkbox('overwrite', true, Input::old('overwrite', true))}} Overwrite existing value
                                    </label>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
                <div class="panel-footer">
                    <div class="btn-group pull-right">
                        {{ Form::reset('Reset', array('class' => 'btn btn-default', 'form' => 'frmUtilization')) }}
                        {{ Form::submit('Import',array('class'=>'btn btn-primary','data-button'=>'submit', 'form' => 'frmUtilization')) }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            $("#import-datepicker").datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });
        });
    </script>
@stop