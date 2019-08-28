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
      Client
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Clients</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('clients/create_client')}}">Create Clients </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allclients')}}">Show Clients</a></li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
       @include('message')
       <div class="card-body">
                <!--   <h4 class="card-title">Client</h4>
                -->
                <form class="forms-sample" role="form" action="/clients/save_client" method="post" name="client_form" id="client_form">
                  <div class="form-group">

                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

                    <div class="form-group">
                      <label for="client_name"> Client Name</label>
                      @if(isset($clientname))
                      <input type="text" class="form-control" name="client_name" required="true" id="client_name" placeholder="Enter Client Name" value="{{$clientname->name}}"  readonly="true">
                      @else
                      <input type="text" class="form-control" name="client_name" required="true" id="client_name" placeholder="Enter Client Name" value="" style="text-transform:uppercase">

                      @endif
                    </div>
                    <div class="form-group" id="exist">

                    </div>
                    <div class="form-group">
                      <label for="desc">Client Description</label>
                      <textarea class="form-control"  rows="4" placeholder="Enter Description" name="desc" id="desc"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="location">Location</label>
                      <select class="form-control js-example-basic-single featuresClass" name="location[]" multiple="true"
                      id="location"  style="position: absolute; width: 95%;">
                      @foreach($location as $loc)
                      <option value="{{$loc['id']}}">{{$loc['location']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" id="div1" style="display:none">

                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('js/data-table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function($) {
       var error=true;
       $('#location').multiselect({
        columns: 1,
        placeholder: 'Select Location',
        search: true,
      });
       $("#client_name").keyup(function(){

        var clientname = $(this).val();
        var url = "{{ URL::to('checkclient') }}";
        $("#exist").empty('');
        $.ajax({
          type: 'GET',
          url:url,
          data:{clientname:clientname},
          success:function(data){

            if(data != 'null')
            {
              $("#exist").html('<p style="color:red">* Client already exist</p>');
              error=false;
            }
            else
            {
             error=true;
           }
         }
       })
      });

       $('form[id="client_form"]').validate({
        rules: {
          client_name: 'required',

        },
        messages: {
          client_name: 'Client name is required',

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

  $("#location").change(function(){
        var selectedloc = $(this).val();

        console.log(selectedloc);
        var url = "{{ URL::to('/serverip')}}";
        if(selectedloc){
          $.ajax({
            type: 'GET',
            url:url+'/'+selectedloc,
            data:{'selectedloc':selectedloc,},
            success:function(data){
              console.log(data);
              if(data != null)
              {
               $('#div1').html('<label for="avbl_server"> Select Server Ip </label><select id="avbl_server"  name="avbl_server[]" multiple="true" class="form-control js-example-basic-single featuresClass"  style="position: absolute; width: 95%;"></select>');


                        // console.log(obj);
                        $('#div1').show();

                        $("#avbl_server").empty();
                        obj=JSON.parse(data);
                        console.log('data123',obj);
                        $.each( obj['allrecords'], function( featid, subfeatid) {

                          featdetails=featid.split('-');
                          $("#avbl_server").append('<optgroup id="'+featdetails[0]+'" label="'+featdetails[1]+'" ></optgroup>');
                     // console.log('values',values);

                     $.each( subfeatid, function( key, subfeat) {

                       subfeatdetails=subfeat.split('-');
                       console.log('subfeat',subfeatdetails);

                       if(subfeatdetails[2]=='selected')
                       {

                        $('#'+featdetails[0]).append($("<option selected></option>")
                         .attr("value",subfeatdetails[0]+'-'+featdetails[0])
                         .text(subfeatdetails[1])
                         );
                      }
                      else
                      {
                       $('#'+featdetails[0]).append($("<option></option>")
                         .attr("value",subfeatdetails[0]+'-'+featdetails[0])
                         .text(subfeatdetails[1])
                         );
                     }

                   });


                   });
                        $('#avbl_server').multiselect({
                          columns: 4,
                          placeholder: 'Select Server Ip',
                          search: true,
                          selectAll: true
                        });

                        $('select[multiple]').multiselect( 'reload' );
                        $('#location').click(function() {
                          $('#avbl_server option').prop('selected', true);
                        });
                      }
                    }
                  })
        }
      });
     });

   </script>

   @endsection