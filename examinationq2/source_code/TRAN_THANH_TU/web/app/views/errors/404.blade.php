@extends('layouts.errors.permission')
@section('content')
<div class="row">
	<ul class="timeline">
		<li>
			<div class="timeline-badge danger"><i class="glyphicon glyphicon-info-sign"></i></div>
			<div class="timeline-panel">
				<div class="timeline-heading">
					<h4 class="timeline-title">Opps 404 ! File not found</h4>
				</div>
				<div class="stimeline-body">
					<p>The site configured at this address does not contain the requested file.</p>
					<hr>
					<div class="row col-md-offset-5">
						<a href="{{ URL::route('home') }}" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-home"></span> Home</a>
					</div>
				</div>
			</div>
		</li>
	</ul>
</div>
@stop