@extends('layouts.main')
@section('title','Monthly Trainer Report')
@section('breadcrumb')
<li><a href="{{ URL::route('home'); }}">Home</a></li>
<li><a href="{{ URL::route('report'); }}">Report</a></li>
<li>Monthly Trainer Report</li>
@stop
@section('content')

{{-- Begin selection input month --}}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ Url::route('report'); }}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body">
                {{ Helper::ShowErrorsMessage($errors) }}
                {{ Form::open(['route' => 'trainer-report','class'=>'form-horizontal', 'autocomplete' => 'off']) }}
                <div class="form-group">
                    {{ Form::label('date_from', Lang::get('report.date_from'), array( 'class' => 'col-md-2 control-label')) }}
                    <div class="col-md-3">
                        <div class="input-group date datetimepicker">
                            {{ Form::text('date_from', \Input::get('date_from'), array('class' => 'form-control', 'placeholder' => 'DD-MM-YYYY') ) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    {{ Form::label('date_to', Lang::get('report.date_to'), array( 'class' => 'col-md-2 control-label')) }}
                    <div class="col-md-3">
                        <div class="input-group date datetimepicker">
                            {{ Form::text('date_to', \Input::get('date_to'), array('class' => 'form-control', 'placeholder' => 'DD-MM-YYYY') ) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Trainer</label>
                    <div class="col-md-3">
                        {{ Form::select('trainer_id', $arrTrainerList, \Input::get('trainer_id'), ['id' => 'trainer_id', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        {{ Form::submit('Show Records', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
{{-- End selection input month --}}

{{-- Begin selection preview --}}
@if (\Input::has('date_from'))

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Preview
            </div>
            <div class="panel-body">
                {{ Form::open(['route'=> 'trainer-report-export','class'=>'form-horizontal']) }}
                {{ Form::hidden('date_from', $date_from)}}
                {{ Form::hidden('date_to', $date_to)}}
                {{ Form::hidden('report_date', $report_date)}}
                {{ Form::hidden('trainer_id', $trainer_id)}}
                <div class="form-group">
                    {{ Form::label('report_by', Lang::get('report.report_by'), array( 'class' => 'col-md-2 control-label')) }}
                    <div class="col-md-4">
                        {{ Form::text('report_by', \Input::get('report_by'), array('class' => 'form-control')) }}
                    </div>
                    {{ Form::label('report_to', Lang::get('report.report_to'), array( 'class' => 'col-md-2 control-label')) }}
                    <div class="col-md-4">
                        {{ Form::text('report_to', \Input::get('report_to'), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('report_timeline', Lang::get('report.report_timeline'), array( 'class' => 'col-md-2 control-label')) }}
                    <div class="col-md-4">
                        {{ Form::text('report_timeline', $date_from .' / '. $date_to, array('class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                    {{ Form::label('report_date', Lang::get('report.submit_date'), array('class' => 'col-md-2 control-label')) }}
                    <div class="col-md-4">
                        {{ Form::text('report_date', $report_date, array('class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
                                <thead>
                                    <tr>
                                        <th>Trainer</th>
                                        <th>Course</th>
                                        <th>Area</th>
                                        <th>Duration (hrs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reportLists as $report)
                                    <tr>
                                        <td>{{$report->full_name}}</td>
                                        <td>{{$report->course}}</td>
                                        <td>{{$report->area}}</td>
                                        <td>{{$report->duration}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.dataTable_wrapper -->
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="btn-group pull-right">
                    {{--{{ Form::Reset(Lang::get('common.reset'), array('class' => 'btn btn-default')) }}--}}
                    {{ Form::submit(Lang::get('report.export'), array('class' => 'btn btn-primary')) }}
                </div>
                <div class="clearfix"></div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endif
{{-- End selection preview --}}

@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $(".datetimepicker").datetimepicker({
            format: 'DD-MM-YYYY'
        });
        datatable();
    });
    
    function datatable()
    {
        oTable = $("#dataTables-ajax").dataTable({
            "processing": false,
            "serverSide": false,
            "filter": false,
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": false,
            "bSort" : false
        });
        oTable.fnSetFilteringDelay(500);
    }
</script>
@stop