<!-- Update by Vo Le Quynh My Start 2015-04-15-->
@extends('layouts.main') 
@section('title', 'Trainer Management') 
@section('breadcrumb')
    <li><a href="{{ URL::to('home')}}">Home</a></li>
    <li>Trainer Management</li>
@stop
Trainer Management @stop @section('script')
<script type="text/javascript">
    $(function () {
        oTable = $("#trainer-list").dataTable({
            "order": [ 0, 'desc' ],
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url": "{{URL::to('training-database/trainer/getList')}}",
                "type": "POST"
            },
            "columns": [
                {"data": "employee_code"},
                {"data": "trainer_name"},
                {"data": "description"},
                {"data": "trainer_id","orderable": false},
            ],
            "aoColumnDefs": [
                 {
                    "aTargets": [ 3 ],
                    "mRender": function ( data, type, full ) {
                         return '<a href="{{URL::to("training-database/trainer/edit/'+data+'")}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></a>';
                     }
                 },
             ],
             "paginationType": "full_numbers",
         });
        oTable.fnSetFilteringDelay(500);
    });
</script>
@stop 
@section('breadcrumb')
<li><a href="#">Trainer Management</a></li>
<li class="active">List</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="{{URL::route('home')}}" class="btn btn-primary">Back</a> <a
					href="{{URL::route('trainer-add')}}" class="btn btn-primary pull-right">Add Trainer</a>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				{{ Helper::ShowSuccessMessage() }}
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="trainer-list">
						<thead>
							<tr>
								<th class="text-center col-sm-2">ID</th>
								<th class="text-center">Name</th>
								<th class="text-center">Department</th>
								<th class="text-center col-sm-1">Action</th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
</div>
<!-- /.row -->
@stop
