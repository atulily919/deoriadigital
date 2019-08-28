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

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
     Edit Campaign
   </h3>
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Campaign</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('createcampaigncreatecampaign/create')}}">Create Campaign </a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('createcampaign')}}">Show Campaign</a></li>
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
               <form class="forms-sample" role="form" action="{{url('createcampaign/'.$campaign->id)}}" method="post" id="campaignEdit">
                <div class="form-group">
                  {{ Form::hidden('_method', 'PUT') }}
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

                  <h4 class="card-title">Basic</h4>

                  <div class="form-group">
                    <label for="Client Name">Client Name</label>
                    <select class="form-control" name="client_id">
                      <option value="{{$client_name->id}}"selected>{{$client_name->name}}</option>
                      @if(count($all_clients) > 0)
                      @foreach($all_clients as $allClients)
                      <option value="{{$allClients->id}}">{{$allClients->name}}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="campaign">Campaign Name</label>
                    <input type="text" class="form-control" name="campaign_name" value="{{$campaign->campaign_name}}" required="true" readonly>
                  </div>

                  <div class="form-group">
                    <label for="Users Name">Users Name</label>
                    <select class="form-control js-example-basic-single featuresClass"  name="users_list[]"  multiple="true" id="campaign_group">
                      @foreach($userval as $uservalues)
                      <option value="{{$uservalues->id}}" selected>{{$uservalues->username}}</option>
                      @endforeach
                      @foreach($allusers as $all_users)
                      <option value="{{$all_users->id}}">{{$all_users->username}}</option>
                      @endforeach
                    </select>
                  </div>


                   <div class="form-group">
                      <label for="Screen Name">Screen Name</label>
                      <select name="screen_name" class="form-control js-example-basic-single">
                         @if(isset($campaign->screen_name))
                        <option value="{{$campaign->screen_id}}">{{$campaign->screen_name}}</option>
                        @foreach($screen as $Screens)
                        <option value="{{$Screens->id}}">{{$Screens->screen_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Screen</option>
                        @foreach($allscreen as $allScreens)
                        <option value="{{$allScreens->id}}">{{$allScreens->screen_name}}</option>
                        @endforeach
                         @endif

                      </select>
                    </div>

                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Campaign Type</label>
                  @if($campaign->campaign_type=='AEM')
                  <div class="col-sm-2">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios1" value="AEM" checked="true">
                            AEM
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios2" value="NON AEM">
                              NON AEM
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                        @elseif($campaign->campaign_type=='NON AEM')
                        <div class="col-sm-2">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios1" value="AEM">
                            AEM
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios2" value="NON AEM" checked="true">
                              NON AEM
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          @else
                           <div class="col-sm-2">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios1" value="AEM">
                            AEM
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios2" value="NON AEM">
                              NON AEM
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          @endif
                        </div>

                         <div class="form-group">
                          <label for="Dialer DID">Dial Ratio / Dial String</label>
                          <textarea class="form-control" name="param_val" value="">{{$campaign->param_value}}</textarea>
                        </div>

                   <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="start_date" id="datetime" class="form-control" value="{{$campaign->start_date}}" id="StartDate" readonly>
                  </div>

                  <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="end_date" id="datetime_1" class="form-control endDate" value="{{$campaign->end_date}}" readonly>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2 submitbtn">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="/js/jquery.multiselect.js"></script>
    <script>
      $(document).ready(function($){
        $('#campaign_group').multiselect({
          columns: 1,
          placeholder: 'Select Users',
          search: true,
        });
        var error_free=true;
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var today = d.getFullYear() + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' +
        ((''+day).length<2 ? '0' : '') + day;

        $("#datetime").datetimepicker({
          format: 'yyyy-mm-dd hh:ii',
          autoclose: true,
          todayBtn: true,
          startDate : today
        });

        $("#datetime_1").datetimepicker({
          format: 'yyyy-mm-dd hh:ii',
          autoclose: true,
          todayBtn: true,
          startDate : today
        });
        $("#datetime_1").change(function(event) {
          var EndDate=$(this).val();
          var StartDate=$('#datetime').val();
          var eDate = new Date(EndDate);
          var sDate = new Date(StartDate);
          if(StartDate!= '' && EndDate!= '' && sDate> eDate)
          {
           alert("Please ensure that the End Date is greater than or equal to the Start Date.");
           $('.endDate').css('border-color','red');
           error_free= false;
         }
         else
         {

         }
       });
        $('.submitbtn').click(function(event) {
          if(!error_free)
          {
            event.preventDefault();
          }
        });

        $('form[id="campaignEdit"]').validate({
            rules: {
              client_id: 'required',
              campaign_name: 'required',
            
            },
            messages: {
              client_id: 'Client name is required',
              campaign_name: 'Campaign name is required',
             
            },
            submitHandler: function(form) {
              form.submit();
            }
          });

      });
    </script>
    @endsection