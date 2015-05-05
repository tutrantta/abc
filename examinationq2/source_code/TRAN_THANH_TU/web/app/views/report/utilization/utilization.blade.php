@extends('layouts.main')
@section('title','Monthly Utilization Engineer Skills Report')
@section('breadcrumb')
<li><a href="{{ URL::route('home'); }}">Home</a></li>
<li><a href="{{ URL::route('report'); }}">Report</a></li>
<li>Utilization</li>
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
				@if ($errors->any())
					{{ implode('', $errors->all('<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p><strong>Error!</strong></p>
						:message
						</div>')) }}
				@endif
				{{ Form::open(['route'=>'utilization-post','class'=>'form-horizontal', 'autocomplete' => 'off']) }}
				<div class="form-group">
					{{ Form::label('utilization-time', Lang::get('report.report_timeline'), array( 'class' => 'col-md-2 control-label', 'for' => 'utilization-time')) }}
					<div class="col-md-3" id="datepicker">
						<div class="input-group date datetimepicker" id="datetimepicker1">
							{{ Form::text('utilization_report_timeline', \Input::get('utilization_report_timeline'), array('id' => 'utilization-time', 'class' => 'form-control', 'placeholder' => 'MM-YYYY', 'maxlength' => '7') ) }}
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
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
@if (\Input::has('utilization_report_timeline') && isset($arrData))

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Preview
			</div>
			<div class="panel-body">
				{{ Form::open(['route'=>'utilization-export','class'=>'form-horizontal']) }}
				{{ Form::hidden('utilization_report_timeline', \Input::get('utilization_report_timeline'))}}
				{{ Form::hidden('utilization_report_date', $utilization_report_date)}}
				<div class="form-group">
					{{ Form::label('utilization-report-by', Lang::get('report.report_by'), array( 'class' => 'col-md-2 control-label', 'for' => 'utilization-report-by')) }}
					<div class="col-md-4">
						{{ Form::text('utilization_report_by', \Input::old('utilization_report_by'), array('id' => 'utilization-report-by', 'class' => 'form-control')) }}
					</div>
					{{ Form::label('utilization-report-to', Lang::get('report.report_to'), array( 'class' => 'col-md-2 control-label', 'for' => 'utilization-report-to')) }}
					<div class="col-md-4">
						{{ Form::text('utilization_report_to', \Input::old('utilization_report_to'), array('id' => 'utilization-report-to', 'class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('utilization-report-timeline', Lang::get('report.report_timeline'), array( 'class' => 'col-md-2 control-label', 'for' => 'utilization-report-timeline')) }}
					<div class="col-md-4">
						{{ Form::text('utilization_report_timeline', \Input::get('utilization_report_timeline'), array('id' => 'utilization-report-timeline', 'class' => 'form-control', 'disabled' => 'disabled')) }}
					</div>
					{{ Form::label('utilization-report-date', Lang::get('report.submit_date'), array( 'class' => 'col-md-2 control-label', 'for' => 'utilization-report-date')) }}
					<div class="col-md-4">
						{{ Form::text('utilization_report_date', $utilization_report_date, array('id' => 'utilization-report-date', 'class' => 'form-control', 'disabled' => 'disabled')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="dataTable_wrapper">
							<table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
								<thead>
									<tr>
										<th>{{ Lang::get('report.department') }}</th>
										<th>{{ Lang::get('report.level') }}</th>
										<th>{{ Lang::get('report.total') }}</th>
										<th>{{ Lang::get('report.utilization') }}</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($arrData as $key => $value)
									<tr>
										<td>
											{{$value->Department}}
										</td>
										<td>
											{{$value->Level}}
										</td>
										<td>
											{{ $total = is_numeric($value->{'Total person'}) ? $value->{'Total person'} : 0 }}
										</td>
										<td>
											@if ($value->Utilization > 0) 
											{{$value->Utilization}}%
											@endif
										</td>
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
	$(document).ready(function () {
		$("#datetimepicker1").datetimepicker({
			viewMode: 'years',
			format: 'MM-YYYY'
		});
	});
	$(function () {
		var oTable = $("#dataTables-ajax").dataTable({
			"processing": false,
			"serverSide": false,
			"filter": false,
			"scrollY": "400px",
			"scrollCollapse": true,
			"paging": false,
			"bSort" : false
		});
		oTable.fnSetFilteringDelay(500);
	});
	</script>
@stop