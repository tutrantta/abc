<!-- Create by Vo Le Quynh My Start 2015-04-01-->
@extends('layouts.main')
@section('title','Engineer General Information')
@section('breadcrumb')
    <li><a href="{{ URL::to('home')}}">Home</a></li>
    <li>List Engineers</li>
@stop 
@section('script')
<script type="text/javascript">
    $(function () {
        
        oTable = $("#dataTables-ajax").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{URL::to('engineer-skill/engineer/list/ajax')}}",
                "type": "POST"
            },
            "columns": [
                {"data": "fullname"},
                {"data": "employee_code"},
                {"data": "is_active"},
                {"data": "department_name"},
                {"data": "gender"},
                {"data": "birthday"},
                {"data": "email"},
                {"data": "address"},
                {"data": "action", "orderable": false}
            ],
            "paginationType": "full_numbers",
        });
        oTable.fnSetFilteringDelay(500);
    });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{URL::route('home')}}" class="btn btn-primary">Back</a>
                <a href="{{URL::route('engineer-add')}}" class="btn btn-primary pull-right">Add Engineer</a>
            </div>
            {{ Helper::ShowSuccessMessage() }}
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class='col-md-1'>ID</th>
                                <th class='col-md-1'>Status</th>
                                <th class='col-md-1'>Department</th>
                                <th class='col-md-1'>Gender</th>
                                <th class='col-md-1'>Birthday</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="ta-small">Action</th>
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
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@stop