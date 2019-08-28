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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
 <meta id="token" name="token" content="{ { csrf_token() } }">

        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Location Servers
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item">Servers</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/locationserver/create')}}">Create Location Server </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('locationserver')}}">Show Clients</a></li>
                </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <!--   <h4 class="card-title">Client</h4>
                  -->
                    @include('message')
                  <form class="forms-sample" role="form" action="{{url('locationserver')}}" method="post" name="client_form" id="client_form">
                    <div class="form-group">

                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                  </div>

                    <div class="form-group">
                    <label for="location_id">Select Location</label><br/>

                    <select class="form-control js-example-basic-single" name="location_id" >
                     <option value="" disabled="true"  id="locationID" selected>Select Location</option>
                     @if(count($locationMaster) > 0)
                     @foreach($locationMaster as $locations_master)
                      <option id="location_id" value="{{$locations_master['id']}}">{{$locations_master['location']}}</option>
                      @endforeach
                      @else
                      <option value="">No Location Found</option>
                      @endif
                      </select>
                      <br>
                      <label id="location_id-error" class="error" for="location_id"></label>

                    </div>


                     <div class="form-group">
                      <label>Enter Server Ip</label>
                      <input type="text" name="server_ip" id="server_ip" value="" class="form-control" required="true" />
                     </div>
                     <div class="form-group" id="exist">

                    </div>

                    <div class="form-group">
                      <button class="form-control btn btn-default" id="loginButton" onclick="toggle()">Add Database Login Credentials&nbsp <i id="arrow" class="fas fa-chevron-down"></i></button>
                    </div>
                    <div class="form-group" id="loginDetails" style="display:none;">
                      <label>Enter Login Details</label>
                      <input type="text" name="loginDetails['hostname']" placeholder="Enter Host Name" class="form-control"><br/>
                      <input type="text" name="loginDetails['dbname']" placeholder="Enter Database Name" class="form-control"><br/>
                      <input type="text" name="loginDetails['portname']" placeholder="Enter Port" class="form-control"><br/>
                      <input type="text" name="loginDetails['username']" placeholder="Enter Database User Name" class="form-control"><br/>
                      <input type="password" name="loginDetails['dbpassword']" placeholder="Enter Database Password" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Enter Previous Server Ip</label>
                      <input type="text" class="form-control" name="prev_server_ip[]">
                    </div>
                   <div class="form-group">
                      <label>Enter Address</label>
                     <textarea class="form-control" name="address">

                     </textarea>
                    </div>
                    <div class="form-group">
                   <input type="submit" class="btn btn-primary" name="data" id="submit_data" value="Add Location Server"/>
                  </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">

  function toggle()
  {
    var arrowicon=$('#arrow').attr('class');
    if(arrowicon=="fas fa-chevron-down")
    {
      $('#arrow').removeClass('fas fa-chevron-down');
      $('#arrow').addClass('fas fa-chevron-up');
    }
    else if(arrowicon=="fas fa-chevron-up")
    {
       $('#arrow').removeClass('fas fa-chevron-up');
      $('#arrow').addClass('fas fa-chevron-down');
    }
     var panel="#loginDetails";

    $(panel).slideToggle("slow")  ;
  }
    $(document).ready(function() {
      var error=true;

      $("#server_ip").keyup(function(){
            var server_ip = $(this).val();
            var url = "{{ URL::to('validation_server_ip') }}";
            $("#exist").empty('');
            $.ajax({

              type: 'GET',
              url:url,
              data:{server_ip:server_ip},
              success:function(data){

                if(data != 'null')
                {
                  $("#exist").html('<p style="color:red">* Server Ip already exist</p>');
                 error=false;
                }
                else
                {
                 error=true;
                }
              }
            })
          });

    $('.js-example-basic-single').select2();
    $('.select2-container--default .select2-selection--single .select2-selection__rendered').css({
      "line-height": "11px"
    });

 $(function() {
 $.validator.addMethod('IP4Checker', function(value) {

 return value.match('^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$');
            }, 'Invalid IP address');

jQuery.validator.addMethod('server_ip', function(value) {
    var split = value.split('.');
    if (split.length != 4)
        return false;

    for (var i=0; i<split.length; i++) {
        var s = split[i];
        if (s.length==0 || isNaN(s) || s<0 || s>255)
            return false;
    }
    return true;
}, ' Invalid IP Address');


$('form[id="client_form"]').validate({
      ignore:[],
            rules: {
              location_id: 'required',
              'server_ip': {
                    required: true,
                    IP4Checker: true,
                  },
            },
            messages: {
              location_id: ' Please select Location',
              'server_ip': 'Please enter valid Server Ip ',            },

            submitHandler: function(form) {
              if(error==true){
                form.submit();
              }else
              {
                return false;
              }

            }
          });

});


</script>

@endsection