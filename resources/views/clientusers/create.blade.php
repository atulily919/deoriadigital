@extends('dashboard')
@section('content')
<style>

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    position: relative;
    left: 12px;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>
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
    <h3 class="page-title">Client Users</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">All Users</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('users/create')}}">Create Users </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('users')}}">Show Users</a></li>
      </ol>
    </nav>
  </div>

  <div class="row">
    <div class="tab">
     <button class="tablinks" id="bulk_upload" >Bulk Upload</button>
     <button class="tablinks" id="create_users">Create Users</button>
   </div>

   <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div id="bulkUpload">
          <div class="container">
            <div class="panel panel-default">

              <div class="panel-body">

                <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
                <a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>

                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data" name="bulkUploadform" id="bulkUploadform">
                  @csrf

                 @include(message)

                  @if (Session::has('success'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="name">Client Name</label>
                    <select class="form-control js-example-basic-single featuresClass" name="client_id" id="client_id" onchange="locationlist()">
                      <option value="" disabled="true" selected>Select Client</option>
                      @foreach($client_data as $clientsData)
                      <option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Location</label>
                    <select class="form-control js-example-basic-single featuresClass" name="loc_id" id="loc_id" onchange="serverlist()">
                      <option value="" disabled="true" selected>Select Location</option>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="server_ids">Server Ips</label>
                    <select class="form-control js-example-basic-single featuresClass" name="server_id" id="server_id">
                      <option value="" disabled="true" selected>Select Server ID</option>

                    </select>
                  </div>
                   <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control js-example-basic-single featuresClass" name="status" id="status">
                      <option value="Active"  selected>Active</option>
                      <option value="Inactive">Inactive</option>

                    </select>
                  </div>
                  <input type="file" name="import_file" />
                  <button class="btn btn-primary">Import File</button>
                </form>

              </div>
            </div>
          </div>
        </div>


        <div id="createUsers" style="display: none">
          <div class="container">
            <form class="forms-sample" role="form" action="{{ url('users') }}" method="post" name="clientuser" id="clientusers">
              <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

              <div class="form-group">
                <label for="name">Client Name</label>
                <select class="form-control js-example-basic-single featuresClass" name="clientid" id="clientid" onchange="locationlistclient()">
                  <option value="" disabled="true" selected>Select Client</option>
                  @foreach($client_data as $clientsData)
                  <option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="name">Location</label>
                <select class="form-control js-example-basic-single featuresClass" name="locid" id="locid" onchange="serverlistclient()">
                  <option value="" disabled="true" selected>Select Location</option>

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
                <input type="text" class="form-control" name="username">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>

              <div class="form-group">
                <label for="Full Name">Full Name</label>
                <input type="text" class="form-control" name="fullname">
              </div>

              <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name="email">
              </div>

              <div class="form-group">
                <label for="Status">Status</label>
                <select class="form-control" name="status">
                  <option value="Active">Active</option>
                  <option value="Disabled">Disabled</option>
                  <option value="Unverified">Unverified</option>
                  <option value="Blocked">Blocked</option>
                </select>
              </div>

              <div class="form-group">
                <label for="User Type">User Type</label>
                <select class="form-control" name="usertype">
                  <option value="User">User</option>
                  <option value="Manager">Manager</option>
                  <option value="Admin">Admin</option>
                  <option value="Supervisor">Supervisor</option>
                </select>
              </div>




              <button type="submit" class="btn btn-primary mr-2">Add User</button>
              <!-- <button class="btn btn-light">Cancel</button> -->
            </form>
          </div>
        </div>

      </div><!-- formgroup -->
    </div><!-- cardbody -->
  </div><!-- card -->
</div><!-- col 12 -->
</div><!-- row -->

<script src="{{ asset('js/data-table.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">

  $(document).ready(function() {
     $("#bulk_upload").addClass("active");
    $('#bulk_upload').click(function(event) {
      $("#bulk_upload").addClass("active");
       $("#create_users").removeClass("active");
      $('#bulkUpload').show();
      $('#createUsers').hide();
    });

    $('#create_users').click(function(event) {
       $("#create_users").addClass("active");
        $("#bulk_upload").removeClass("active");
      $('#createUsers').show();
      $('#bulkUpload').hide();
    });
      $('form[id="clientusers"]').validate({
            rules: {
              clientid: 'required',
              locid: 'required',
              serverid:'required',
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
      $('form[id="bulkUploadform"]').validate({
            rules: {
              client_id: 'required',
              loc_id: 'required',
              server_id:'required',
              import_file:'required',
              

            },
            messages: {
              client_id: 'Client name is required',
              loc_id: 'Location is required',
              server_id:'Server IP is required',
              import_file:'File is required',
            

            },
            submitHandler: function(form) {
              form.submit();
            }
          });

  });

  function locationlist()
  {
    var clientid = document.getElementById("client_id").value;
  //alert(clientid);
  var url = "{{ URL::to('/listlocationclientwise')}}";
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
        $('#loc_id').empty();
        $.each(list, function(key, value) {
         $('#loc_id').append($("<option></option>")
          .attr("value",value['location_master_id'])
          .text(value['location']));
       });
      }
    }
  });
}
function locationlistclient()
{
  var clientid = document.getElementById("clientid").value;
  //alert(clientid);
  var url = "{{ URL::to('/listlocationclientwise')}}";
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
         $('#locid').empty();
        list = $.parseJSON(data);
        $.each(list, function(key, value) {
         $('#locid').append($("<option></option>")
          .attr("value",value['location_master_id'])
          .text(value['location']));
       });
      }
    }
  });
}
function serverlist()
{
  var clientid = document.getElementById("client_id").value;
  var loc_id = document.getElementById("loc_id").value;
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
       $('#server_id').empty();
      // console.log(list);
       $.each(list, function(key, value) {
         $('#server_id').append($("<option></option>")
          .attr("value",value['id'])
          .text(value['server_ip']));
       });
     }
   }
 });
}
function serverlistclient()
{
  var clientid = document.getElementById("clientid").value;
  var loc_id = document.getElementById("locid").value;
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
       $('#serverid').empty();
       console.log(list);
       $.each(list, function(key, value) {
         $('#serverid').append($("<option></option>")
          .attr("value",value['id'])
          .text(value['server_ip']));
       });
     }
   }
 });
}

</script>

@endsection