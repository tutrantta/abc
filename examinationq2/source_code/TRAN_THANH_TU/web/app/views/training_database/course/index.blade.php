@extends('layouts.main')

@section('title','Course Management')

@section('breadcrumb')
<li><a href="{{URL::route('home')}}">Home</a></li>
<li>Course Management</li>
@stop

@section('script')
<script type="text/javascript">
    $(function () {
        objTable = $("#dataTables-ajax").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{URL::route('course-list-ajax')}}",
                "type": "POST"
            },
            "columns": [
                {"data": "course_name"},
                {"data": "area_name"},
                {"data": "description", "orderable": false},
                {"data": "action", "orderable": false}
            ],
            "aaSorting": [],
            "paginationType": "full_numbers"
        });
        objTable.fnSetFilteringDelay(500);
    });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{URL::route('home')}}" class="btn btn-primary">Back</a>
                <a href="{{URL::route('course-create')}}" class="btn btn-primary pull-right">Add Course</a>
            </div>
            <div class="panel-body">
            {{ Helper::ShowSuccessMessage() }}
                <table class="table table-striped table-bordered table-hover table-responsive" id="dataTables-ajax">
                    <thead>
                    <tr>
                        <th class="text-center">Course</th>
                        <th class="text-center">Area</th>
                        <th class="text-center">Description</th>
                        <th class="text-center ta-small">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop