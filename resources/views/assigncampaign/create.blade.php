 @extends('dashboard')
@section('content')
<style type="text/css">

  form label {
    display: inline-block;

  }

  form div {
    margin-bottom: 10px;
  }

  .error {
    color: red;
    margin-left: 5px;
  }

  label.error {
    display: inline;
  }
</style>
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">


<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Assign Campaign</h3>
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
            <form class="forms-sample" role="form" action="{{ url('assigncampaign') }}" method="post" name="assigncampaign" id="assigncampaign">
              <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

              <div class="form-group">
                <label for="name">Client Name</label>
                <select class="form-control js-example-basic-single featuresClass" name="clientid" id="clientid" onchange="skillgroupclientwise()" required="true">
                  <option value="" disabled="true" selected>Select Client</option>
                  @foreach($client_data as $clientsData)
                  <option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">GroupSkill</label>
                <select class="form-control js-example-basic-single featuresClass" name="groupskill" id="groupskill" onchange="campaignclientwise()">
                  <option value="" disabled="true" selected>Select GroupSkill</option>

                </select>
              </div>
              <div class="form-group">
                <label for="name">Campaign</label>
                <select class="form-control js-example-basic-single featuresClass" name="campaign" id="campaign" required="true">
                  <option value="" disabled="true" selected>Select Campaign</option>

                </select>
              </div>
              <div class="form-group">
                <label for="Status">Status</label>
                <select class="form-control" name="status">
                  <option value="" disabled="true" selected>Select Status</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                  >
                </select>
              </div>




              <button type="submit" class="btn btn-primary mr-2">Assign Campaign</button>
              <!-- <button class="btn btn-light">Cancel</button> -->
            </form>
          </div>


        </div><!-- formgroup -->
      </div><!-- cardbody -->
    </div><!-- card -->
  </div><!-- col 12 -->
</div><!-- row -->

<script src="{{ asset('js/data-table.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">


  function skillgroupclientwise()
  {
    var clientid = document.getElementById("clientid").value;
  //alert(clientid);
  var url = "{{ URL::to('/skillgroupclientwise')}}";
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'POST',
    url:url,
    data:'clientid='+clientid,
    success:function(data){
      if(data)
      {
        list = $.parseJSON(data);

//console.log('sad',list);

$.each(list['skillgroup'], function(key, value) {
 $('#groupskill').append($("<option></option>")
  .attr("value",value['id'])
  .text(value['group_name']));
});
$.each(list['campaign'], function(key, value) {
 $('#campaign').append($("<option></option>")
  .attr("value",value['id'])
  .text(value['campaign_name']));
});
}
}
});
}
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