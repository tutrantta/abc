<!-- Create by LamKy Start 2015-04-13-->
@extends('layouts.main')
@section('title','Training Class Management')
@section('breadcrumb')
    <li><a href="{{ URL::route('home'); }}">Home</a></li>
    <li><a href="{{ URL::route('list-class'); }}">Training Class</a></li>
    <li>Create</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <a href="{{ URL::route('list-class'); }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="panel-body">
                {{ Helper::ShowErrorsMessage($errors) }}
                {{ Helper::ShowSuccessMessage() }}
                {{ Form::open(array('route'=>'create-class-post','method'=>'POST', 'class'=>'form-horizontal', 'id' => 'form-create', 'autocomplete' => 'off')) }}
                <div class="form-group">
                    <label for="" class="col-md-2 col-sm-2 control-label">Name
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                        {{ Form::text('class_name','',array('id'=>'class_name','class'=>'form-control','placeholder' => 'Please Enter Training Class Name', 'required', 'maxlength' => '50')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-2 col-sm-2 control-label">
                        Course <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                        {{ Form::select('course_id', array('' => 'Please select') + $arrCourse, '', ['class' => "form-control", 'required','id'=>'course_id']); }}
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addCourse" id="btnAddCourse">
                            <span class="glyphicon glyphicon-plus"></span> Add Course
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-2 col-sm-2 control-label">
                        Date <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-3 col-sm-3">
                        <div class='input-group date' id='datetimepicker1'>
                            {{ Form::text('date','',array('id'=>'date','class'=>'form-control', 'required' ,'placeholder' => 'YYYY-MM-DD')) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="input-group col-md-2 col-sm-2">
                        <span class="input-group-addon">
                            <span>Duration (Hours)</span>
                        </span>
                        {{ Form::text('duration','',array('id'=>'duration','class'=>'form-control','placeholder' => 'Hours')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-md-2 col-sm-2 control-label">Trainer</label>
                    <div class="col-md-6 col-sm-6">
                        {{ Form::select('trainer_id', array('' => 'Please select') + $arrTrainer, '', ['class' => "form-control required",'id'=>'course_id']); }}
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addTrainer" id="btnAddTrainer">
                            <span class="glyphicon glyphicon-plus"></span> Add Trainer
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="checkbox col-md-2 col-sm-2 control-label">
                        Examine
                    </label>
                    <div class="col-md-1 col-sm-1">
                        {{ Form::checkbox('has_examination', '1', '', ['class' => 'checkbox ta-checkbox','id'=>'has_examination']) }}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="btn-group pull-right">
                    {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                    {{ Form::submit('Save',array('class'=>'btn btn-primary', 'data-button'=>'submit')) }}
                </div>
                
                <div class="clearfix"></div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Modal form trainer-->
<div class="modal fade" id="addTrainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel1">Add new Trainer</h4>
            </div>

            {{ Form::open(['route'=>'create-class-post-trainer', 'method' => 'POST', 'id' => 'form-trainer', 'autocomplete' => 'off']) }}
            <div class="modal-body">
                <div id="error_trainer" class="form-group bg-danger"></div>
                <div class="form-group">
                    <label class="control-label">
                        Employee ID
                        <span class="ta-requied">*</span>
                    </label>
                    {{ Form::select('employee_code', array('' => 'Please select') + $arrCode, null, ['id' => 'employee_code', 'class' => 'form-control', 'required']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Name
                        <span class="ta-requied">*</span>
                    </label>
                    {{ Form::text('trainer_name', null, ['id' => 'trainername', 'class'=>'form-control', 'placeholder'=>'Trainer name', 'autofocus'=>True,'required']) }}
                    <input type="hidden" value="" name="trainer_name" data-name='trainer' />

                </div>
                <div class="form-group">
                    <label class="control-label">
                        Department
                    </label>
                    {{ Form::textarea('description',null, ['class'=>'form-control', 'row'=>1]) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Save',array('class'=>'btn btn-primary', 'data-button'=>'submit')); }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
{{-- Model form-cousre --}}
<div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Add new Course</h4>
            </div>
            {{ Form::open(['route'=>'create-class-post-course', 'method' => 'POST', 'id' => 'form-cousre', 'autocomplete' => 'off']) }}
            <div class="modal-body">
                <div id="error_course" class="form-group bg-danger"></div>
                <div class="form-group">
                    <label class="control-label">Course
                        <span class="ta-requied">*</span>
                    </label>
                    {{ Form::text('course_name', null, ['id' => 'course_name','class'=>'form-control','placeholder'=>'Course name','autofocus'=> true,'required']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Area
                        <span class="ta-requied">*</span>
                    </label>
                    {{ Form::select('area_id', array('' => 'Please select') + $arrAreaList, null, ['id' => 'area_id', 'class' => 'form-control', 'required']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Description
                    </label>
                    {{ Form::textarea('description', null, ['class'=>'form-control','row'=> 2]) }}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Save',array('class'=>'btn btn-primary', 'data-button'=>'submit')); }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        load_select();
        ajax_submit_trainer();
        ajax_submit_course();
        //local store
        if(localStorage.getItem("flag") != '1'){
            setLocalStore();
        }
        getLocalStore();
        if(localStorage.getItem("has_examination") === '1'){
            $('#has_examination').prop('checked',true);
        }
        localStorage.clear();
        $('select').change(function() {
             // Store
            localStorage.setItem($(this).attr('name'), $(this).val());
        });
        $('input').blur(function() {
            // Store
            localStorage.setItem($(this).attr('name'), $(this).val());
            setCheckbox()
        });
        $('#btnAddCourse').click(function(){
            setLocalStore();
            localStorage.setItem('flag', '1');
        });
        $('#btnAddTrainer').click(function(){
            setLocalStore();
            localStorage.setItem('flag', '1');
        });
    });
    
    function setLocalStore(){
        localStorage.setItem($('#class_name').attr('name'), $('#class_name').val());
        localStorage.setItem($('#date').attr('name'), $('#date').val());
        localStorage.setItem($('#duration').attr('name'), $('#duration').val());
        localStorage.setItem($('#course_id').attr('name'), $('#course_id').val());
        localStorage.setItem($('#trainer_id').attr('name'), $('#trainer_id').val());
    }

    function getLocalStore(){
        $('#class_name').val(localStorage.getItem("class_name"));
        $('#date').val(localStorage.getItem("date"));
        $('#duration').val(localStorage.getItem("duration"));
        $('#course_id').val(localStorage.getItem("course_id")).attr('selected',true);
        $('#trainer_id').val(localStorage.getItem("trainer_id")).attr('selected',true);
    }    

    function setCheckbox(){
        if($('#has_examination').is(":checked")){
            localStorage.setItem($('#has_examination').attr('name'), 1);
        }else{
            localStorage.setItem($('#has_examination').attr('name'), 0);
        }
    } 

    function ajax_submit_trainer()
    {
        $("#form-trainer").submit(function(){
            localStorage.setItem($('#class_name').attr('name'), $('#class_name').val());
            var data = $('#form-trainer').serialize();
            // post data add
            $.post("{{ URL::route('create-class-post-trainer'); }}", data)
            .done(function(result) {
                var result = jQuery.parseJSON(result);
                if(result.status == 'error')
                {   
                    $('#error_trainer').html('');
                    for (index = 0; index < result.msg.length; ++index) {
                        $('#error_trainer').append('<span>'+result.msg[index]+'</span> <br />');
                    }
                }
                else if(result.status == 'success')
                {
                    location.reload();
                }
            });
            return false;
        });
    };

    function ajax_submit_course()
    {
        $("#form-cousre").submit(function(){
            var data = $('#form-cousre').serialize();
            // post data add
            $.post("{{ URL::route('create-class-post-course') }}", data)
            .done(function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'error')
                {
                    $('#error_course').html('');
                    for (index = 0; index < result.msg.length; ++index) {
                        $('#error_course').append('<span>'+result.msg[index]+'</span> <br />');
                    }
                }
                else if(result.status == 'success')
                {
                    location.reload();
                    //local store
                    $('#class_name').val(localStorage.getItem("class_name"));
                    $('#date').val(localStorage.getItem("date"));
                    $('#duration').val(localStorage.getItem("duration"));
                }
                
            });
            return false;
        });
};

function load_select()
{
    var arrEmployee = [];
    @foreach($arrName as $key => $name)
    arrEmployee['{{$key}}'] = '{{$name}}';
    @endforeach
    var employee_code = $('#employee_code').val();
        //check array employee code
        if(arrEmployee[employee_code] !== undefined){
            $('#trainername').val(arrEmployee[employee_code]);
        }
        
        $('[data-name=trainer]').val(arrEmployee[employee_code]);
        check_select_name(employee_code);

        //event change of employee_code
        $('#employee_code').change(function(){
            var emp_id = $(this).val();
            $('#trainername').val(arrEmployee[emp_id]);
            $('[data-name=trainer]').val(arrEmployee[emp_id]);
            check_select_name(emp_id);
            
        });
    };

    // check select employee code
    function check_select_name(emp_code)
    {
       if (emp_code === 'External') 
       {
        $("#trainername").removeAttr('disabled');
        $("[data-name=trainer]").attr('disabled','disabled');
    }else{
       $("#trainername").attr('disabled','disabled');
       $("[data-name=trainer]").removeAttr('disabled');
   }
};
</script>
@stop