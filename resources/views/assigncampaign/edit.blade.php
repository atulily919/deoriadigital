@extends('dashboard')
@section('content')

<link rel="stylesheet" href="{{ asset('/css/style.css') }}">


<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">AssignCampaign</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">AssignCampaign</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('assigncampaign/create')}}">Assign</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('assigncampaign')}}">Show List</a></li>
      </ol>
    </nav>
  </div>

  <div class="row">

    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">



          <div class="container">
            <form class="forms-sample" role="form" action="{{ url('assigncampaign/'.$data['id']) }}" method="post" name="assigncampaign" id="assigncampaign">
              <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
              {{ Form::hidden('_method', 'PUT') }}
              <div class="form-group">
                <label for="name">Client Name</label>
                <input type="text" class="form-control" name="client_id" id="client_id" placeholder="Enter Role" value="{{$data['name']}}" disabled>

              </div>
              <div class="form-group">
                <label for="name">GroupSkill</label>
                <select class="form-control js-example-basic-single featuresClass" name="groupskill" id="groupskill" >
                  <option value="" disabled="true" selected>Select GroupSkill</option>
                  @foreach($groupskills as $group)
                  @if($group['id']==$data['groupskill_id'])
                  <option value="{{$group['id']}}" selected>{{$group['group_name']}}</option>
                  @else
                  <option value="{{$group['id']}}">{{$group['group_name']}}</option>
                  @endif
                  @endforeach

                </select>
              </div>
              <div class="form-group">
                <label for="name">Campaign</label>
                <select class="form-control js-example-basic-single featuresClass" name="campaign" id="campaign" required="true">
                  <option value="" disabled="true" selected>Select Campaign</option>
                  @foreach($campaign as $camp)
                  @if($camp['id']==$data['campaign_id'])
                  <option value="{{$camp['id']}}" selected>{{$camp['campaign_name']}}</option>
                  @else
                  <option value="{{$camp['id']}}">{{$camp['campaign_name']}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="Status">Status</label>
                <select class="form-control" name="status">
                  <option value=""  selected>{{$data['status']}}</option>
                  @if($data['status']=='Active')
                  <option value="Inactive">Inactive</option>
                  @else
                  <option value="Active">Active</option>
                  @endif

                </select>
              </div>




              <button type="submit" class="btn btn-primary mr-2">Update</button>
              <!-- <button class="btn btn-light">Cancel</button> -->
            </form>
          </div>


        </div><!-- formgroup -->
      </div><!-- cardbody -->
    </div><!-- card -->
  </div><!-- col 12 -->
</div><!-- row -->

<script src="{{ asset('js/data-table.js') }}"></script>
<script type="text/javascript">

 $(document).ready(function($) {

$('form[id="assigncampaign"]').validate({
            rules: {
              clientid: 'required',
              groupskill: 'required',
              campaign: 'required',
              status:'required',
            },
            messages: {
              clientid: 'Client name is required',
              groupskill: 'Group Skill is required',
              campaign: 'Campaign is required',
              status:'Status is required',
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
});



</script>

@endsection