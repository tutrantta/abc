@extends('layouts.main')
@section('title', 'Trainer Management') 
@section('breadcrumb')
    <li><a href="{{ URL::to('home')}}">Home</a></li>
    <li><a href="{{ URL::route('trainer-list')}}">Trainer Management</a></li>
    <li>Create</li>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group">
                    <a href="{{ URL::route('trainer-list')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{ Form::open(['route'=>'trainer-add-post','method'=> 'POST', 'class'=>'form-trainer']) }}
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Employee ID
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-8">
                        {{ Form::select('employee_code', $arrEmp, null, ['id' => 'employee_code', 'class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Name
                        <span class="ta-requied">*</span>
                    </label>
                    <div class="col-md-8">
                        {{ Form::text('trainer_name', null,['id' => 'trainername','class'=>'form-control','placeholder'=>'Trainer name','autofocus'=>True,'required']) }}
                        <input type="hidden" value="" name="trainer_name" data-name='trainer' />
                        
                    </div>
                </div>
                <div class="form-group bm-form-item">
                    <label class="col-md-2 control-label">
                        Department
                    </label>
                    <div class="col-md-8">
                        {{ Form::textarea('description',null, ['class'=>'form-control','row'=>2]) }}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="btn-group pull-right">
                    {{ Form::reset('Reset', ['class' => 'btn btn-default', 'onclick' => 'fnReset()']) }}
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
                <div class="clearfix"></div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $(function(){
    	var arr_emp_name = [];
        @foreach($arrName as $key => $name)
            arr_emp_name['{{$key}}'] = '{{$name}}';
        @endforeach
        var load_employee_code = $('#employee_code').val();
        //check array employee code
        if(arr_emp_name[load_employee_code] !== undefined){
        	$('#trainername').val(arr_emp_name[load_employee_code]);
        }
        
        $('[data-name=trainer]').val(arr_emp_name[load_employee_code]);
        check_select_name(load_employee_code);

        //event change of employee_code
        $('#employee_code').change(function(){
            var emp_id = $(this).val();
            $('#trainername').val(arr_emp_name[emp_id]);
            $('[data-name=trainer]').val(arr_emp_name[emp_id]);
            check_select_name(emp_id);
            
        });
        
    })
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
    }
    
    function fnReset()
    {
    	$("#trainername").removeAttr('disabled');
    }
</script>
@stop