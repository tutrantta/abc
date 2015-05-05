<!-- Create by Nguyen Trieu Start 2015-04-08-->
@extends('layouts.main')
@section('title','Soft Skill Index Manager')
@section('breadcrumb')
<li><a href="{{URL::route('home')}}">Home</a></li>
<li>Soft Skill Index Manager</li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{URL::route('home')}}" class="btn btn-primary">Back</a>
            <a href="{{URL::route('soft-skill-manager-create')}}" class="btn btn-primary pull-right">Add Skill</a>
        </div>
        <div class="panel-body">
        {{ Helper::ShowSuccessMessage() }}
        {{Form::open(array('method' => 'POST'))}}
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Skill</th>
                <th>Description</th>
                <th class="ta-small">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($softSkillList as $softSkill)
            <tr>
                <td>{{$softSkill->soft_skill_name}}</td>
                <td>{{$softSkill->soft_skill_description}}</td>
                <td class="text-center">
                    <a href="{{URL::route('soft-skill-manager-edit', $softSkill->soft_skill_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                </td>
            </tr>
            @endforeach 
            </tbody>
        </table>
        {{Form::close()}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm_modal">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Confirm messages</h4>
        </div>
        <div class="modal-body">
            Do you want to deleted
        </div>
        <div class="modal-footer">
            <button type="button" id="confirm_modal_delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
@stop

@section('script')
<script type="text/javascript">
    $(function () {
    $('a.confirm-modal').click(function () {
        $('#confirm_modal').modal('show');
        var href = $(this).attr('href');
        
        $('#confirm_modal_delete').click(function () {
            window.location.href = href;
        });
        return false;
    });
    });
</script>
@stop