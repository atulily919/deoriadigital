@extends('dashboard')
@section('content')

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Edit Client
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
             }
           }
           @endif
           <form class="forms-sample" role="form" action="/updateclient" method="post" name="client_form" id="client_form">
            <div class="form-group">

              <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

              <input type = "hidden" name = "clientid" value = "<?php echo $clientid ?>">
              <input type = "hidden" name = "json_data" value = '<?php echo $json_val ?>'>


              <div class="form-group">
                <label for="client_name"> Client Name</label>
                <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter Client Name" value="{{ old('client_name',$client[0]['name']) }}" style="text-transform:uppercase" readonly="true">
              </div>
              <div class="form-group">
                <label for="desc">Client Description</label>
                <textarea class="form-control"  rows="4" placeholder="Enter Description" name="desc" id="desc">{{ old('desc',$client[0]['description']) }}</textarea>
              </div>
              <div class="form-group">
                <label for="location">Location</label>
                <select class="form-control js-example-basic-single featuresClass" name="location[]" multiple="true"
                id="location"  style="position: absolute; width: 95%;">

                @foreach($location as $loc)
                @if(in_array($loc['id'],$arr))
                <option value="{{$loc['id']}}" selected>{{$loc['location']}}</option>
                @else

                <option value="{{$loc['id']}}">{{$loc['location']}}</option>
                @endif
                @endforeach

              }
            </select>
          </div>
          <div class="form-group" id="div1">
            <label for="avbl_server"> Select Server Ip </label>
            <select name="avbl_server[]"  class="form-control js-example-basic-single featuresClass" multiple id="avbl_server">

              @foreach($selectedips as $cityid=>$ips)
              @foreach($sellocname as $selectedlocname)
              @if($cityid==$selectedlocname['id'])
              <?php $name = $selectedlocname['location']?>
              @endif

              @endforeach
              <optgroup label="{{$name}}">

                @foreach($ips as $ip)
                @if(in_array($ip['id'],$serverids))
                <option value="{{$ip['id'].'-'.$cityid}}" selected>{{$ip['server_ip']}}</option>
                @else
                <option value="{{$ip['id'].'-'.$cityid}}">{{$ip['server_ip']}}</option>
                @endif
                @endforeach

              </optgroup>
              @endforeach


            </select>

          </div>

          <button type="submit" class="btn btn-primary mr-2">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script src="{{ asset('js/data-table.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function($) {
    var locvalue=$("#location").val();
    if(locvalue == '')
    {
      locvalue='';
    }

    $('#location').multiselect({
      columns: 1,
      placeholder: 'Select Location',
      search: true,
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


    $("#location").change(function(){
      var selectedloc = $(this).val();
      var clientid=<?php echo $clientid; ?>;
       //alert(clientid);
       // console.log(selectedloc);
       var url = "{{ URL::to('/serverip')}}";
       if(selectedloc){
        $.ajax({
          type: 'GET',
          url:url+'/'+selectedloc,
          data:{'selectedloc':selectedloc,'clientid':clientid},
          success:function(data){
                    //console.log(data);
                    if(data != null)
                    {
                     // obj=JSON.parse(data);
                      //console.log('data',obj);
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