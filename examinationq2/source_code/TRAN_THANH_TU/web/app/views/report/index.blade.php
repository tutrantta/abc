@extends('layouts.main')
@section('title','Report Dashboard')
@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li>Report</li>
@stop
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				
			</div>
			<div class="panel-body">
				{{-- show message --}}
				{{ Helper::ShowSuccessMessage() }}
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-excel-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Utilization</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::route('utilization-get') }}">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-excel-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"></div>
										<h4>Technical Matrix</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::route('techtical-matrix-index') }}">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-excel-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"></div>
										<h4>Generation Information</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::route('general-report') }}">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-excel-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Training Result</h4>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel ta-parent-one">
							<div class="panel-heading ta-panel-one">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-excel-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Trainer Report</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::route('trainer-report') }}">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel ta-parent-two">
							<div class="panel-heading ta-panel-two">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-excel-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Attendance Report</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::route('attendance') }}">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop