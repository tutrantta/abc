@extends('layouts.main') @section('title','Technical Matrix Engineer Skill Report') 
@stop
@section('breadcrumb')
<li><a href="{{ URL::route('home'); }}">Home</a></li>
<li><a href="{{ URL::route('report'); }}">Report</a></li>
<li>Technical Matrix</li>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ Url::route('report'); }}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                {{ implode('', $errors->all('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><strong>Error!</strong></p>
                    :message
                </div>')) }}
                @endif
                <form action="{{ URL::route('techtical-matrix') }}" class="form-horizontal" autocomplete="off" method="POST">
                   <div class="form-group">
                    <label for="datetimepicker1" class="col-md-2 control-label">{{{ Lang::get('report.report_time') }}}</label>
                    <div class='col-md-3'>
                        <div class='input-group date datetimepicker' id='datetimepicker1'>
                            {{ Form::text('tech_report_timeline', \Input::get('tech_report_timeline'), array('id' => 'tech-time', 'class' => 'form-control', 'placeholder' => 'MM-YYYY', 'maxlength' => '7') ) }}

                            {{-- <input type='text' class="form-control" placeholder="MM-YYYY" name="export_month" /> --}}
                            <span class="input-group-addon"> <span
                                class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                   <div class="col-md-offset-2 col-md-10">
                    {{ Form::submit(Lang::get('report.search_timeline'), array('class' => 'btn btn-primary')) }}
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

{{-- Begin selection preview --}}
@if (\Input::has('tech_report_timeline') && isset($arrData))
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Preview
            </div>
            <div class="panel-body">
                {{ Form::open(['route'=>'techtical-matrix-report','class'=>'form-horizontal']) }}
                {{ Form::hidden('tech_report_timeline', \Input::get('tech_report_timeline'))}}
                {{ Form::hidden('tech_report_date', $tech_report_date)}}
                <div class="form-group">
                    {{ Form::label('tech-report-by', Lang::get('report.report_by'), array( 'class' => 'col-md-2 control-label', 'for' => 'tech-report-by')) }}
                    <div class="col-md-4">
                        {{ Form::text('tech_report_by', \Input::old('tech_report_by'), array('id' => 'tech-report-by', 'class' => 'form-control')) }}
                    </div>
                    {{ Form::label('tech-report-to', Lang::get('report.report_to'), array( 'class' => 'col-md-2 control-label', 'for' => 'tech-report-to')) }}
                    <div class="col-md-4">
                        {{ Form::text('tech_report_to', \Input::old('tech_report_to'), array('id' => 'tech-report-to', 'class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('tech-report-timeline', Lang::get('report.report_timeline'), array( 'class' => 'col-md-2 control-label', 'for' => 'tech-report-timeline')) }}
                    <div class="col-md-4">
                        {{ Form::text('tech_report_timeline', \Input::get('tech_report_timeline'), array('id' => 'tech-report-timeline', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                    {{ Form::label('tech-report-date', Lang::get('report.submit_date'), array( 'class' => 'col-md-2 control-label', 'for' => 'tech-report-date')) }}
                    <div class="col-md-4">
                        {{ Form::text('tech_report_date', $tech_report_date, array('id' => 'tech-report-date', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
                                <thead>
                                    <tr>
                                        <th>{{ Lang::get('report.tech_level') }}</th>
                                        @foreach ($levels as $l)
                                        <th>
                                            {{ $l->level_name }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($arrData as $key => $value)
                                    <tr>
                                        <td>
                                            {{ $value['Technique'] }}
                                        </td>
                                        @foreach ($levels as $l)
                                        <td>
                                            {{ $value[$l->level_id] }}
                                        </td>
                                        @endforeach
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
                 {{ Form::submit(Lang::get('report.export'), array('class' => 'btn btn-primary')) }}
                 {{ Form::Reset(Lang::get('common.reset'), array('class' => 'btn btn-default')) }}
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
    $(function () {
        var oTable = $("#dataTables-ajax").dataTable({
            "processing": false,
            "serverSide": false,
            "filter": false,
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": false,
            "bSort" : false,
            "aaSorting" : [[]]
        });
        oTable.fnSetFilteringDelay(500);
    });

    $('#datetimepicker1').datetimepicker({
        viewMode: 'years',
        format: 'MM-YYYY'
    });

    $('#submitDate').datetimepicker({
        viewMode: 'days',
        format: 'DD-MM-YYYY'
    });
</script>
@stop
