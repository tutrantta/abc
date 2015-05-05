@extends('layouts.main')

@section('title', '')

@section('subTitle')
User Management
@stop

@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li>User Management</li>
@stop

@section('script')
<script type="text/javascript">
    $(function () {
        oTable = $("#user-list").dataTable({
            "order": [ 0, 'desc' ],
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url": "{{URL::to('users/getList')}}",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {"data": "username"},
                {"data": "full_name"},
                {"data": "is_admin"},
                {"data": "email"},
                {"data": "is_active"},
                {"data": "","orderable": false},
            ],
            "aoColumnDefs": [            
                {
                   "aTargets": [ 1 ],
                   "mRender": function ( data, type, full ) {
                        if(full['is_active'] != 1){
                            return '<a class="ta-in-active word-break" href="{{URL::to("users/detail/'+full['id']+'")}}">' + data + '</a>';
                        }
                        return '<a class="ta-word-break" href="{{URL::to("users/detail/'+full['id']+'")}}">' + data + '</a>';
                    }
                },
                {
                   "aTargets": [ 3 ],
                   "mRender": function ( data, type, full ) {
                     var check;
                     if(data == 1){
                        check = 'checked';
                     }
                     return "<input type='checkbox' readonly disabled "+check+"/>"
                    }
                },
                {
                   "aTargets": [ 5 ],
                   "mRender": function ( data, type, full ) {
                    var check = "Inactive";
                     if(data == 1){
                        check = 'Active';
                     }
                     return check;
                    }
                },
                {
                   "aTargets": [ 6 ],
                   "mRender": function ( data, type, full ) {
                     return '<a href="{{URL::to("users/edit/'+full['id']+'")}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>';
                    }
                },
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
                <a href="{{URL::route('user-add')}}" class="btn btn-primary pull-right">Add User</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                {{ Helper::ShowSuccessMessage() }}
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="user-list">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Admin</th>
                                <th>Email</th>
                                <th>Status</th>
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
</div> 
<!-- /.row -->
@stop