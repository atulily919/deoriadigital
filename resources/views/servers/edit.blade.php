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
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Client
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
                   @if (count($errors) > 0)
                     <div class = "alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                              <li style="color: red">{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  @endif
                  <form class="forms-sample" role="form" action="{{url('/locationserver/'.$location_server->id)}}" method="post" name="client_form" id="client_form">
                    <div class="form-group">
                   {{ csrf_field() }}
                   {{ Form::hidden('_method', 'PUT') }}

                    <div class="form-group">
                    <label>Select Location</label><br/>
                    <select class="form-control js-example-basic-single" name="location_id" required="true">
                     <option value="{{$location_server->location_masters->id}}" selected>{{$location_server->location_masters->location}}</option>
                     @if(count($locationMaster) > 0)
                     @foreach($locationMaster as $locations_master)
                      <option value="{{$locations_master['id']}}">{{$locations_master['location']}}</option>
                      @endforeach
                      @else
                      <option value="">No Location Found</option>
                      @endif
                      </select>
                      <br>
                      <label id="location_id-error" class="error" for="location_id"></label>
                    </div>


                    <div class="form-group field_wrapper">
                       <label>Enter Server Ip</label>
                      <input type="text" name="server_ip" value="{{$location_server->server_ip}}" class="form-control" style="width: 97%;" required="true"/>
                     </div>

                    <div class="form-group">
                      <button class="form-control btn btn-default" id="loginButton" onclick="toggle()">Add Database Login Credientials&nbsp <i id="arrow" class="fas fa-chevron-up"></i></button>
                    </div>
                   <div class="form-group" id="loginDetails">

                      <label>Enter Login Details</label>
                      <input type="text" name="loginDetails['hostname']" placeholder="Enter Host Name" value="{{$host}}" class="form-control"><br/>
                      <input type="text" name="loginDetails['dbname']" placeholder="Enter Database Name"  value="{{$dbname}}" class="form-control"><br/>
                      <input type="text" name="loginDetails['portname']" placeholder="Enter Port" value="{{$port}}" class="form-control"><br/>
                      <input type="text" name="loginDetails['username']" placeholder="Enter Database User Name" value="{{$username}}" class="form-control"><br/>
                      <input type="password" name="loginDetails['dbpassword']" placeholder="Enter Database Password" value="{{$password}}" class="form-control">

                    </div>
                     <div class="form-group">
                      <label>Enter Previous Server Ip</label>
                      <input type="text" class="form-control" name="prev_server_ip[]" value="{{$location_server->prev_server_ip}}">
                    </div>
                  <div class="form-group">
                      <label>Enter Address</label>
                     <textarea class="form-control" name="address">
                       {{$location_server->address}}
                     </textarea>
                    </div>

                    <div class="form-group">
                   <input type="submit" class="btn btn-primary" name="data" id="submit_data" value="Update Location Server"/>
                   </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

  <script src="{{ asset('js/data-table.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    $('.js-example-basic-single').select2();
    $('.select2-container--default .select2-selection--single .select2-selection__rendered').css({
      "line-height": "11px"
    });


    $('#loginButton').click(function(e) {
      e.preventDefault();
      $('#loginDetails').show();
    });

    $('form[id="client_form"]').validate({
      ignore:[],
            rules: {
              location_id: 'required',
              'server_ip': 'required',
              
            },
            messages: {
              location_id: ' Please select Location',
              'server_ip': 'Please enter Server Ip ',

            },
           
            submitHandler: function(form) {
              form.submit();
            }
          });
});


</script>

@endsection