@extends('dashboard')
@section('content')
<style type="text/css">
  form label {
  display: inline-block;
  width: 100px;
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
    <h3 class="page-title">ClientUsers</h3>
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">ClientUsers</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('users/create')}}">Create ClientUsers </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('users')}}">Show ClientUsers</a></li>
      </ol>
    </nav>
  </div>

  <div class="row">


    <div class="col-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
            <div id="createUsers" >
              <div class="container">
                <form class="forms-sample" role="form" action="{{ url('users/'.$data['id']) }}" method="post" name="clientusers" id="clientusers">
                  {{ Form::hidden('_method', 'PUT') }}
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                  <input type = "hidden" name = "client_id" value = "{{$data['client_id']}}">

                  <div class="form-group">
                    <label for="name">Client Name</label>
                   <input type="text" class="form-control" name="clientid" value="{{old('clientid',$data->name)}}" readonly="true">


                  </div>
                  <div class="form-group">
                    <label for="name">Location</label>
                    <select class="form-control js-example-basic-single featuresClass" name="locid" id="locid" onchange="serverlistlocationwise()">
                      <option value="" disabled="true" selected>Select Location</option>

                      @foreach($location as $loc)
                      @if($loc['location_master_id']==$data['location_id'])
                      <option value="{{$loc['location_master_id']}}" selected>{{$loc['location']}}</option>
                      @else
                      <option value="{{$loc['location_master_id']}}">{{$loc['location']}}</option>
                      @endif
                      @endforeach



                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Server Ips</label>
                    <select class="form-control js-example-basic-single featuresClass" name="serverid" id="serverid">
                      <option value="" disabled="true" selected>Select Server ID</option>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="User Name">UserName</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username',$data['username']) }}" readonly="true">
                  </div>

                   <div class="form-group">
                    <label for="Full Name">Full Name</label>
                    <input type="text" class="form-control" name="fullname" value="{{ old('fullname',$data['fullname']) }}">
                  </div>

                  <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email',$data['email']) }}">
                  </div>

                  <div class="form-group">
                    <label for="Status">Status</label>
                    <select class="form-control" name="status">
                       @if($data['status']=='Active')
                      <option value="Active" selected>Active</option>
                      @elseif($data['status']=='Pending')
                      <option value="Pending" selected>Pending</option>
                      @elseif($data['status']=='Inactive')
                      <option value="Inactive" selected>Inactive</option>
                      @else
                      <option value="Active">Active</option>
                      @endif

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="User Type">User Type</label>
                    <select class="form-control" name="usertype">
                      @if($data['usertype']=='User')
                      <option value="User" selected>User </option>
                      <option value="Manager" >Manager</option>
                      <option value="Admin" >Admin</option>
                      <option value="Supervisor" >Supervisor</option>
                      @elseif($data['usertype']=='Manager')
                       <option value="User" >User </option>
                      <option value="Manager" selected>Manager</option>
                      <option value="Admin" >Admin</option>
                      <option value="Supervisor" >Supervisor</option>
                      @elseif($data['usertype']=='Admin')
                       <option value="User" >User </option>
                      <option value="Manager">Manager</option>
                      <option value="Admin" selected>Admin</option>
                      <option value="Supervisor" >Supervisor</option>
                      @elseif($data['usertype']=='Supervisor')
                      <option value="User" >User </option>
                      <option value="Manager">Manager</option>
                      <option value="Admin" >Admin</option>
                      <option value="Supervisor" selected>Supervisor</option>
                      @else
                      <option value="" disabled="true" selected>Select User Type</option>
                      <option value="User" >User </option>
                      <option value="Manager">Manager</option>
                      <option value="Admin" >Admin</option>
                      <option value="Supervisor">Supervisor</option>
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="organisation">Organisation</label>
                    <select class="form-control" name="organisation">
                      <option value="Default">Default</option>
                    </select>
                  </div>
                   <div class="form-group">
                    <label for="group">Group</label>
                    <select class="form-control" name="group" >
                      <option value="Default">Default</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="reports_to">Reports to</label>
                    <select class="form-control" name="reports_to" id="reports_to" >
                    <option value="" disabled="true" selected>Select User</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="supervisor">Supervisor</label>
                    <select class="form-control" name="supervisor" id="supervisor">
                      <option value="" disabled="true" selected>Select Supervisior</option>
                    </select>
                  </div>
                   <div class="form-group">
                    <label for="supervisor">Select Campaign</label>
                    <select class="form-control" name="sel_campaign">
                      <option value="" disabled="true" selected>Select Camapign</option>
                      @if($campaign_data == 'No campaign assigned')
                       <option value="">No campaign assigned</option>
                       @else

                      @foreach($campaign_data as $campaigndata)
                      <option value={{$campaigndata->id}}>{{$campaigndata->campaign_name}}</option>
                      @endforeach
                       @endif

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="Number">Number</label>
                    <input type="text" class="form-control" name="number" value="{{ old('number',$data['numbers']) }}">
                  </div>
                  <div class="form-group">
                    <label for="Extension">Extension</label>
                    <input type="text" class="form-control" name="extension" value="{{ old('extension',$data['exten']) }}">
                  </div>




                  <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
              </div>
            </div>

        </div><!-- formgroup -->
      </div><!-- cardbody -->
    </div><!-- card -->
  </div><!-- col 12 -->
</div><!-- row -->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var serv_id="<?php echo $data['server_id'] ?>";
    var serv_ip="<?php echo $data['server_ip'] ?>";

    $('#serverid').append('<option value='+serv_id+' selected="selected">'+serv_ip+'</option>');




  var clientid="<?php echo $data['client_id'] ?>";
  var userid="<?php echo $data['id'] ?>";
  var reportsto="<?php echo $data['reports_to'] ?>";
  var supervisor="<?php echo $data['supervisor'] ?>";

  //alert(supervisor);

  var url = "{{ URL::to('/reportsto')}}";
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url:url,
      data:{ 'clientid' : clientid,'userid':userid},
      success:function(data){

          list = $.parseJSON(data);
        $.each(list, function(key, value) {

            if(reportsto==value['id'])
            {
              $('#reports_to').append('<option value='+value['id']+' selected="selected">'+value['username']+' -- '+value['usertype']+' </option>');
            }
            else
            {
              $('#reports_to').append('<option value='+value['id']+'>'+value['username']+' -- '+value['usertype']+' </option>');
            }

             if(supervisor==value['id'])
            {
              //alert(value['username']);
              $('#supervisor').append('<option value='+value['id']+' selected="selected">'+value['username']+' -- '+value['usertype']+' </option>');
            }
            else
            {
              $('#supervisor').append('<option value='+value['id']+'>'+value['username']+' -- '+value['usertype']+'</option>');

            }


            });

      }
    });

$('form[id="clientusers"]').validate({
             rules: {
              clientid: 'required',
              locid: 'required',
              serverid:'required',
              fullname:'required',
              username: 'required',
              email: {
                required: true,
                email: true,
              },
              password: {
                required: true,
                minlength:8,
              }

            },
            messages: {
              clientid: 'Client name is required',
              locid: 'Location is required',
              serverid:'Server IP is required',
              username: 'User name is required',
              fullname: 'Full name is required',
              email:'Enter a valid email',
              password: {
                required:'Password is required',
                    minlength: 'Password must be at least 8 characters long'
              }

            },
            submitHandler: function(form) {
              form.submit();
            }
          });




  });

  function serverlistlocationwise() {
  $('#serverid').empty();
  var clientid="<?php echo $data['client_id'] ?>";
  var loc_id = document.getElementById("locid").value;
  var serv_id="<?php echo $data['server_id'] ?>";

  var url = "{{ URL::to('/listserverlocationwise')}}";
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url:url,
      data:{ 'loc_id' : loc_id, 'clientid' : clientid},
      success:function(data){
        if(data)
        {
          list = $.parseJSON(data);
          $.each(list, function(key, value) {

            if(serv_id == value['id'])
            {
             $('#serverid').append('<option value='+value['id']+' selected="selected">'+value['server_ip']+'</option>');
            }
            else
            {
              $('#serverid').append('<option value='+value['id']+'>'+value['server_ip']+'</option>');
            }
            });
        }
      }
    });
 }

</script>

@endsection