@extends('layouts.main')

@section('title', 'Technical Result')

@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li><a href="{{ URL::route('list-class'); }}">Training Class</a></li>
<li><a href="{{ URL::route('edit-class',$class_id) }}">Edit</a></li>
<li><a href="{{ URL::route('assign-engineer',$class_id) }}">Engineer Assigment</a></li>
<li class="active">Technical Result</li>
@stop

@section('script')
<script type="text/javascript">
    $(function () {
       oTable = $("#technical-result").dataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url": "{{URL::full()}}",
                "type": "POST"
            },
            "columns": [
                {"data": "employee_code"},
                {"data": "fullname"},
                {"data": "examination_result"},
                {"data": "pass_examination"}
            ],
            "fnInfoCallback": function(oSettings, json) {
                updateData();
            }
            //"order": [[ 0, "desc" ]]
        });
        oTable.fnSetFilteringDelay(500);
    });

    function updateData()
    {   
        $(".table_edit").change(function(){
            var engineerid = $(this).attr('engineerid');
            var classid = $(this).attr('classid');
            var editField = $(this).attr('name');

            var editVal = (editField == "examination_result") ? $(this).val() : $(this).prop('checked');
            var obj_input = $(this);

            dataUpdate = {
                engineer_id : engineerid,
                class_id : classid,
                edit_field : editField,
                edit_val : editVal
            }

            // post data edit
            $.post("{{URL::route('technical-result-update')}}", dataUpdate)
            .done(function(data) {
                var obj_data = jQuery.parseJSON(data);
                if(obj_data.status == 'error')
                {
                    obj_input.siblings('.error_msg').remove();
                    obj_input.after('<span class="text-danger error_msg">'+obj_data.msg+'</span>');
                }
                else if(obj_data.status == 'success')
                {
                    obj_input.siblings('.error_msg').remove();
                }
                
            });
        });
    }
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::route('assign-engineer',$class_id) }}" class="btn btn-primary">Back</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="technical-result">

                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Percent result</th>
                                <th>Pass</th>
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