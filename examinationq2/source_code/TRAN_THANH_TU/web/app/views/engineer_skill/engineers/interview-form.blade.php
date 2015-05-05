@extends('layouts.main')
@section('title','Engineer Interview Form')
@section('breadcrumb')
<li><a href="{{ URL::to('home')}}">Home</a></li>
<li><a href="{{ URL::route('engineer-list')}}">List Engineers</a></li>
<li>Interview Form</li>
@stop
@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
            {{ Helper::ShowErrorsMessage($errors) }}
            <div class="panel-body">
                {{ Form::open(['route'=>'interview-create', 'class' => 'form-horizontal', 'id' => 'interview']) }}
                <div class="row">
                    <div class="form-group col-md-6 required">
                        <label for="interview_date" class="col-md-4 control-label">Interview Date</label>
                        <div class="col-md-8">
                          <div class='input-group date' id='datetimepicker1'>
                            {{ Form::text('interview_date',null,['class' => 'form-control required']) }}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6 required">
                    <label for="working_area_id" class="col-md-4 control-label">Apllied Skill</label>
                    <div class="col-md-8">
                        {{ Form::select('working_area_id', $arrPositions, Input::old('working_area_id'), ['class' => "form-control required"]) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="engineer_name" class="col-md-4 control-label">Engineer Name</label>
                    <div class="col-md-8">
                      {{ Form::text('engineer_name', $data->fullname, ['class' => 'form-control', 'readonly']) }}
                      {{ Form::hidden('engineer_id', $engineer_id, ['class' => 'form-control']) }}
                      {{ Form::hidden('has_form', $has_form, ['class' => 'form-control']) }}
                  </div>
              </div>
              <div class="form-group col-md-6 required">
                <label for="interviewer" class="col-md-4 control-label">Interviewer</label>
                <div class="col-md-8">
                  {{ Form::text('interviewer', null, ['class' => "form-control required", 'required']) }}
              </div>
          </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6 required">
            <label for="applied_position" class="col-md-4 control-label">Applied Position</label>
            <div class="col-md-8">
              {{ Form::select('applied_position', $arrLevels, null, array('class' => 'form-control')) }}
          </div>
      </div>
      <div class="form-group col-md-6 required">
        <label for="department_name" class="col-md-4 control-label">Department</label>
        <div class="col-md-8">
          {{ Form::text('interviewer_department', null,['class' => "form-control required", 'required']) }}
      </div>
  </div>
</div>
<div class="row">
    <div class="form-group col-md-4 ta-tech-skill">
        <table class="table table-striped table-bordered col-md-10 ta-skill-table">
            <caption class="text-left ta-caption">1. Techniques</caption> 
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arrTechniques as $key => $tech)
                <tr>
                    <td class="filterable-cell">{{$tech->technique_name}}
                        {{ Form::hidden('tech'.$key, $tech->technique_id,['class' => 'form-control']) }}
                    </td>
                    <td class="filterable-cell">
                        {{ Form::select('level'.$key, $arrLevels, Input::old('technique_id'), array('class' => 'form-control')) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group col-md-8 ta-tech-skill">
        <table class="table table-striped table-bordered">
            <caption class="text-left ta-caption">2. Soft skills</caption> 
            <thead>
                <tr>
                    <th></th>
                    <th>Need improvement</th>
                    <th>Meet request</th>
                    <th>Outstanding</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arrSofts as $key => $soft) 
                <tr>
                    <td class="filterable-cell">{{$soft->soft_skill_name}}
                        {{ Form::hidden('soft'.$key, $soft->soft_skill_id,['class' => 'form-control']) }}
                    </td>
                    <td class="filterable-cell">{{ Form::radio('soft_lv'.$key, '1', (Input::old('soft_lv'.$key) == '1'), ['checked']) }}</td>
                    <td class="filterable-cell">{{ Form::radio('soft_lv'.$key, '2', (Input::old('soft_lv'.$key) == '2')) }}</td>
                    <td class="filterable-cell">{{ Form::radio('soft_lv'.$key, '3', (Input::old('soft_lv'.$key) == '3')) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12 ta-tech-skill">
        <span class="text-left ta-caption">3. Overall Feedback</span> 
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12 text-center">
        <div class="radio-inline col-md-2">
            <label>Technical skills</label>
        </div>
        <div class="radio-inline col-md-1">
            <label>{{ Form::radio('technique_skill_feedback', '1', (Input::old('technique_skill_feedback') == '1'), ['checked']) }} Meet request</label>
        </div>
        <div class="radio-inline col-md-2">
            <label>{{ Form::radio('technique_skill_feedback', '2', (Input::old('technique_skill_feedback') == '2')) }} Do not meet request</label>
        </div>
    </div>
    <div class="form-group col-md-12 text-center">
        <div class="radio-inline col-md-2">
            <label class="control-label">Management skills</label>
        </div>
        <div class="radio-inline col-md-1">
            <label class="control-label">{{ Form::radio('management_skill_feedback', '1', (Input::old('management_skill_feedback') == '1'), ['checked']) }} Meet request</label>
        </div>
        <div class="radio-inline col-md-2">
            <label class="control-label">{{ Form::radio('management_skill_feedback', '2', (Input::old('management_skill_feedback') == '2')) }} Do not meet request</label>
        </div>
    </div>
    <div class="form-group col-md-10 ta-tech-skill">
        <label for="comment" class="control-label">Other Feedback</label>
        {{ Form::textarea('other_feedback', null, ['class' => "form-control", 'rows' => 5]) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12 ta-tech-skill">
        <label class="control-label">{{ Form::checkbox('is_approve', 1, (Input::old('is_approve') == '1')) }} Approvement</label>
    </div>
</div>
</div>
<div class="panel-footer">
    <div class="btn-group pull-right">
        <a href="{{ URL::route('engineer-detail', [$engineer_id])}}" class="btn btn-default">Cancel</a>
        {{ Form::submit('Save',array('class'=>'btn btn-primary','data-button'=>'submit')) }}
    </div>
    <div class="clearfix"></div>
</div>
{{ Form::close()}}
</div>
</div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(function () {
        //$("#interview").validate();
        // set default value date
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var year = d.getFullYear();
        if($('#datetimepicker1 input').val() == '') {
            $('#datetimepicker1 input').val(year + '-' + month + '-' + day);
        }
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
@stop
