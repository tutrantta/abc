<!-- Create by LamKy Start 2015-04-13-->
@extends('layouts.main')
@section('title','Training Class Management')
@section('breadcrumb')
    <li><a href="{{ URL::route('home'); }}">Home</a></li>
    <li>Training Class</li>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <a href="{{ URL::route('home'); }}" class="btn btn-primary">Back</a>
                    <a href="{{ URL::route('create-class'); }}" class="btn btn-primary pull-right">Add Class</a>
            </div>
            <div class="panel-body">
                {{ Helper::ShowErrorsMessage($errors) }}
                {{ Helper::ShowSuccessMessage() }}
                <table id="list-training-class" class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center" id="class" data-sortable="true">Class</th>
                                <th class="text-center col-sm-2" id="course" data-sortable="true">Course</th>
                                <th class="text-center col-sm-1" data-sortable="true">Date</th>
                                <th class="text-center col-sm-1" data-sortable="true">Durations</th>
                                <th class="text-center col-sm-2" data-sortable="true">Trainer</th>
                                <th class="text-center col-sm-1" data-sortable="true">Examine</th>
                                <th class="text-center col-sm-1">Action</th>
                            </tr>
                        </thead>
                </table>
            </div>
            
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(function () {
        oTable = $("#list-training-class").dataTable({ 
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{URL::full()}}",
                "type": "POST"
            },
            "aaSorting": [],
            "columns": [
                {"data": "class_name"},
                {"data": "course_name"},
                {"data": "date"},
                {"data": "duration"},
                {"data": "trainer_name"},
                {"data": "has_examination", "orderable": false},
                {"data": "action" , "orderable": false},
            ],
            "paginationType": "full_numbers",
        });
        oTable.fnSetFilteringDelay(500);
    });
</script>
@stop