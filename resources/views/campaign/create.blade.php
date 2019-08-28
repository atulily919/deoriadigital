@extends('dashboard')
@section('content')
<style type="text/css">
  table.table-condensed {
    width: 100% !important;
  }
  .datetimepicker .datetimepicker-dropdown-bottom-right .dropdown-menu
  {
    width: 50%; !important;
  }
  .form-group.row {
    display: inline;
  }


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

<div class="bar-header">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</div>

<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title">
     Create Campaign
   </h3>
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Campaign</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('createcampaign/create')}}">Create Campaign </a></li>
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
                @include('message')
                <form class="forms-sample" role="form" action="{{url('createcampaign')}}" method="post" id="campaignForm">
                  <div class="form-group">

                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                    <div class="form-group">
                      <label for="Client Name">Client Name</label>
                      <select class="form-control" name="client_id" id="clientname" required="true">
                        <option value="" disabled="true" selected>Select Client Name</option>
                        @foreach($allclients as $all_clients)
                        <option value="{{$all_clients->id}}">{{$all_clients->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="campaign">Campaign Name</label>
                      <input type="text" class="form-control" name="campaign_name" id="campaign_name" required="true">
                    </div>

                    <div class="form-group" id="exist">

                    </div>

                    <div class="form-group">
                      <label for="Users Name">Users Name</label>
                      <select name="users_id[]" multiple="true" id="usersName" class="form-control js-example-basic-single" >
                      </select>
                    </div>


                    <div class="form-group">
                      <label for="Screen Name">Screen Name</label>
                      <select name="screen_name" class="form-control js-example-basic-single">
                        <option value="">Select Screen</option>
                        @foreach($allscreens as $allScreens)
                        <option value="{{$allScreens->id}}">{{$allScreens->screen_name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Campaign Type</label>
                      <div class="col-sm-2">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="camp_status" id="membershipRadios1" value="AEM" checked="">
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
                        </div>
                        <div class="form-group">
                          <label for="Dialer DID">Dial Ratio / Dial String</label>
                          <textarea class="form-control" name="param_val"></textarea>
                        </div>

                        <div class="form-group">
                         <label>Start Date</label>
                         <input type="text" name="start_date" id="datetime" class="form-control" readonly>
                       </div>


                       <div class="form-group">
                         <label>End Date</label>
                         <input type="text" name="end_date" id="datetime_1" class="form-control endDate" class="endDate" readonly>
                       </div>

                       <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" name="status">
                          <option value="Active">Enable</option>
                          <option value="Disable">Disable</option>
                        </select>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2 submitbtn">Create Campaign</button>
                    <a class="btn btn-light" href="{{url('/createcampaign') }}">Cancel</a>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
        <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="/js/jquery.multiselect.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

        <script type="text/javascript">

         $(document).ready(function($) {

 var error=true;
        $("#campaign_name").keyup(function(){
           
            var campaign_name = $(this).val();
            var clientid= $('#clientname').val()
           // alert(clientid);
            var url = "{{ URL::to('checkduplicatecampaign') }}";
            $("#exist").empty('');
            $.ajax({
              type: 'GET',
              url:url,
              data:{campaign_name:campaign_name,clientid:clientid},
              success:function(data){

                
                arrdata=JSON.parse(data);
              //  console.log(arrdata);

                if(typeof arrdata !== 'undefined' && arrdata.length > 0)
                {
                 // alert('notempty');
                  $("#exist").html('<p style="color:red">* Campaign for this client already exist</p>');
                 error=false;
                }
                else
                {
                 error=true;
                }
              }
            })
          });




          var error_free=true;
          var d = new Date();

          var month = d.getMonth()+1;
          var day = d.getDate();

          var today = d.getFullYear() + '-' +
          ((''+month).length<2 ? '0' : '') + month + '-' +
          ((''+day).length<2 ? '0' : '') + day;


          $('#datetime').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
            startDate : today
          }).on('changeDate', function(ev){
            $('#datetime_1').datetimepicker('setStartDate', ev.date);
          });

          $('#datetime_1').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: true,
            startDate : today
          }).on('changeDate', function(ev){
            $('#datetime').datetimepicker('setEndDate', ev.date);
          });


          $('#clientname').change(function() {
            var clientid=$(this).val();
            var url = "{{ URL::to('/clientusers')}}";
            if(clientid)
            {
              $.ajax({
                url: url+'/'+clientid,
                type: 'GET',
                data: 'clientid='+clientid,
                success:function(data){
      // console.log(data);
      // alert(data);
      if(data != null)
      {
       var obj = '';
       $('#usersName').html('');
       obj = $.parseJSON(data);
       $.each(obj,function (index, value) {
        $('#usersName').append($("<option></option>")
         .attr("value",value.id)
         .text(value.username)
         );
      });
       $('#usersName').multiselect({
        columns: 1,
        placeholder: 'Select Users',
        search: true,
      });

       $('select[multiple]').multiselect( 'reload' );
       $('#clientname').click(function() {

        $('#usersName option').prop('selected', true);
      });

     }

   }
 })
    }
          });
          $('.submitbtn').click(function(event) {
            if(!error_free)
            {
              event.preventDefault();
            }
          });
          $('form[id="campaignForm"]').validate({
            rules: {
              client_id: 'required',
              campaign_name: 'required',
             
            },
            messages: {
              client_id: 'Client name is required',
              campaign_name: 'Campaign name is required',
             
            },
            submitHandler: function(form) {
              if(error==true)
              {
                  form.submit();
              }
              else
              {
                 return false;
              }
            }
          });

        });


      </script>

      @endsection