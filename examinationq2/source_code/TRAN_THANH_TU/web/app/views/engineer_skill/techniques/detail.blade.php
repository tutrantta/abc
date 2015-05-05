@extends('layouts.main')
@section('title','Technique Skill Detail of Engineer')
@section('breadcrumb')
    <li><a href="../../engineer/list">List Engineers</a></li>
    <li>Technique Skill Detail</li>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group">
                        <a href="{{ URL::route('engineer-detail',$engineer_id) }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="panel-body">
                    <h4>Engineer: {{$fullname}}</h4>
                    <table id="technique_detail" class="table table-striped table-bordered text-center" cellspacing="0" width="100%" data-sort-order="desc" data-sort-name="skill">
                        <thead>
                            <tr>
                                <th class="text-center" data-sortable="true">Date</th>
                                <th class="text-center" id="skill" data-sortable="true">Skill</th>
                                <th class="text-center" data-sortable="true">Level</th>
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
        oTable = $("#technique_detail").dataTable({ 
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{URL::full()}}",
                "type": "POST"
            },
            "columns": [
                {"data": "updated_time"},
                {"data": "technique_name"},
                {"data": "level_name"}
            ]
        });
        oTable.fnSetFilteringDelay(500);
    });
</script>
@stop