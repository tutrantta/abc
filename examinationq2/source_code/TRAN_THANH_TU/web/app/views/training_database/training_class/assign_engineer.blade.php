@extends('layouts.main')
@section('title','Trainning Class')
@section('breadcrumb')
<li><a href="{{ URL::route('home') }}">Home</a></li>
<li><a href="{{ URL::route('list-class'); }}">Training Class</a></li>
<li><a href="{{ URL::route('edit-class',$data['class']->class_id); }}">Edit</a></li>
<li class="active">Engineer Assigment</li>
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
      $('#engineer-list tr').click(function(event) {
        if (event.target.type !== 'checkbox') {
          $(':checkbox', this).trigger('click');
      }
  });
  });
</script>
@stop
@section('content')
<?php $check = null;
if(empty($data['listAssign'])){
    $check = "disabled=true";
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::route('edit-class',$data['class']->class_id) }}" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body form-horizontal" role="form">
                {{ Helper::ShowSuccessMessage() }}
                {{ Form::open(['route'=>['store-assign-engineer',$data['class']->class_id],'class'=>'form-signin']) }}
                {{-- show error message --}}
                {{ Helper::ShowErrorsMessage($errors) }}
                <div class="form-group bm-form-item">
                    <label class="col-md-1 control-label">
                        Class
                    </label>
                    <div class="col-md-2">
                        {{ Form::text('class_name',$data['class']->class_name,['class'=>'form-control','autofocus'=>True,'required'=>True,'disabled'=>true]) }}
                    </div>
                    <label class="col-md-1 control-label">
                        Date
                    </label>
                    <div class="col-md-2">
                        {{ Form::text('date',$data['class']->date,['class'=>'form-control','autofocus'=>True,'required'=>True,'disabled'=>true]) }}
                    </div>
                    <div class="col-md-1 ta-icon">
                        <i class="fa fa-calendar fa-2x"></i>
                    </div>
                    <label class="col-md-1 control-label">
                        Hours
                    </label>
                    <div class="col-md-1">
                        {{ Form::text('duration',$data['class']->duration,['class'=>'form-control','autofocus'=>True,'required'=>True,'disabled'=>true]) }}
                    </div>
                    <label class="col-md-1 control-label">
                        Trainer
                    </label>
                    <div class="col-md-2">
                    <?php isset($data['class']->trainer_id) ? $value = TrainerManagement::find($data['class']->trainer_id)->trainer_name : $value = null;?>
                        {{ Form::text('trainer_id',$value,['class'=>'form-control','autofocus'=>True,'required'=>True,'disabled'=>true]) }}
                    </div>
                </div>
                {{-- hidden-field --}}
                <input type="hidden" name="class_id" value="{{ $data['class']->class_id }}" />
                <input type="hidden" data-select='input' />
                <input type="hidden" name="input-attent" data-select='input-attent' />
                <input type="hidden" data-select='input-attent-new' />
                <input type="hidden" data-select='input-attent-old' value="{{ $data['idHaveAssigned'] }}" />
                <input type="hidden" data-select='input-attent-delete' name="input-attent-delete" />
                {{-- end-hidden-field --}}
                <div class="form-group bm-form-item">
                    <div class="col-md-5">
                        <label class="control-label pull-left">Engineers</label><br/>
                        <hr />
                        <div class="dataTable_wrapper table-responsive ta-table-div">
                            <table class="table table-striped table-bordered table-hover" id="engineer-list" data-table='engineer'>
                                <thead>
                                    <tr>
                                        <th class="text-center ta-no-sort">
                                            <input type="checkbox" data-select="all"/>
                                        </th>
                                        <th>Employ ID</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody data-list='table-attent'>
                                    @foreach($data['lists'] as $key=>$item)
                                    <tr data-engineer = "{{ $item['engineer_id'] }}" 
                                    employee_code="{{ $item['employee_code'] }}" 
                                    fullname="{{ $item['fullname'] }}">
                                    <td><input type="checkbox" data-select="item" value="{{ $item['engineer_id'] }}" /></td>
                                    <td>{{ $item['employee_code'] }}</td>
                                    <td>{{ $item['fullname'] }}</td>
                                </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2 ta-button">
                        <div class="row col-md-offset-5">
                            <button type="button" class="btn btn-primary col-offset-2" data-button="add"  data-toggle="tooltip" data-placement="top" title="Assign Engineer">
                                <span class="glyphicon glyphicon-menu-right"></span> 
                            </button>
                        </div>
                        <br />
                        <div class="row col-md-offset-5">
                            <button type="button" class="btn btn-primary col-offset-2" data-button="remove" data-toggle="tooltip" data-placement="bottom" title="Remove Engineer">
                                <span class="glyphicon glyphicon-menu-left"></span> 
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="control-label pull-left">Requirement Attendant</label><br/>
                        <hr />
                        <div class="dataTable_wrapper ta-table-div">
                            <table class="table table-striped table-bordered table-hover" id="engineer-list" data-click-to-select="true" data-table='unassignee'>
                                <thead>
                                    <tr>
                                        <th class="text-center" data-checkbox="true">
                                            <input type="checkbox" data-select="all-attent"/>
                                        </th>
                                        <th>Employ ID</th>
                                        <th>Name</th>
                                    </tr>
                                    <tbody data-list='table'>
                                        @foreach($data['listAssign'] as $key=>$item)
                                        <tr data-attent = "{{ $item['engineer_id'] }}" 
                                        employee_code="{{ $item['employee_code'] }}" 
                                        fullname="{{ $item['fullname'] }}">
                                        <td><input type="checkbox" data-select="item-attent" value="{{ $item['engineer_id'] }}" /></td>
                                        <td>{{ $item['employee_code'] }}</td>
                                        <td>{{ $item['fullname'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="btn-group pull-right">
                @if($data['class']->has_examination == 1)
                <button data-button="update-exam" class="btn btn-default" {{ $check }} type="submit" name="submit_and_update">Update Exam Results</button>
                @endif
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
            <div class="clearfix"></div>
        </div>
        {{ Form::close() }}
    </div>
</div>
</div>
{{-- modal --}}
<div class="modal fade" id="modal-error">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Error Message !</h4>
    </div>
    <div class="modal-body">
        <p class="ta-p-modal">Please select at least one engineer to assign !</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- end-modal --}}

{{-- message --}}
<div data-message="div-message" class="ta-message">
    <div class="hidden" data-div='hidden'></div>
</div>
{{-- end-message --}}
@stop