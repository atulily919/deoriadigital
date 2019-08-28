@extends('dashboard')
@section('content')

<div class="content-wrapper">
  <div class="page-header">
   <h3 class="page-title">
    View Data
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">View Data</li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('synchronization')}}">Show Synchronization List </a></li>
    </ol>
  </nav>

</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

                <!--   <h4 class="card-title">Client</h4>
                -->
                <form class="forms-sample" role="form" action="" method="" name="" id="">
                  <div class="form-group">
                    <input type="hidden" id="hidden_id" value="{{$queue_data->id}}">


                    @if(isset($queue_data->client_details))
                    <div class="form-group">
                      <label for="name">Client Name</label>
                      <input type = "text" name ="" value = "{{$queue_data->client_details}}" readonly="true" class="form-control">
                    </div>
                    @endif

                    @if(isset($location_master))
                    <div class="form-group">
                      <label for="name">Location Name</label>
                      <input type = "text" name ="" value = "{{$location_master->location}}" readonly="true" class="form-control">
                    </div>
                    @endif

                    @if(isset($server_ip))
                    <div class="form-group">
                      <label for="name">Server IP</label>
                      <input type = "text" name ="" value = "{{$server_ip->server_ip}}" readonly="true" class="form-control">
                    </div>
                    @endif

                    @if(isset($camp_json->campaign_name))

                    <div class="form-group">
                      <label for="name">Campaign Name</label>
                      <input type = "text" name ="" value = "{{$camp_json->campaign_name}}" readonly="true" class="form-control">
                    </div>
                    @endif

                    @if(isset($users_name))
                    <div class="form-group">
                      <label for="name">Users List</label>
                      <select class="form-control" name="" id="" readonly>
                        @foreach($users_name as $usersName)
                        <option value="{{$usersName['username']}}">{{$usersName['username']}}</option>
                        @endforeach
                      </select>
                    </div>
                    @endif

                    @if(isset($camp_json->param_value))
                     <div class="form-group">
                      <label for="name">Dial Ratio / Dial String</label>
                      <textarea class="form-control">{{$camp_json->param_value}}</textarea>
                    </div>
                    @endif

                     @if(isset($camp_json->new_data->param_value))
                     <div class="form-group">
                      <label for="name">Dial Ratio / Dial String</label>
                      <textarea class="form-control">{{$camp_json->new_data->param_value}}</textarea>
                    </div>
                    @endif


                    @if(isset($jsonUserName))
                    <div class="form-group">
                      <label for="name">User Name</label>
                      <input type = "text" name ="" value = "{{$jsonUserName}}" readonly="true" class="form-control">
                    </div>
                    @endif

                    @if(isset($user_json->status))
                    <div class="form-group">
                      <label for="name">User Status</label>
                      <input type = "text" name ="" value = "{{$user_json->status}}" readonly="true" class="form-control">
                    </div>
                    @endif

                      @if(isset($camp_json->start_date))
                <div class="form-group">
                  <label for="name">Start Date</label>
                  <input type="text" value="{{$camp_json->start_date->date}}" class="form-control" readonly="true">
                </div>
                @endif

                @if(isset($camp_json->end_date))
                <div class="form-group">
                  <label for="name">End Date</label>
                  <input type="text" value="{{$camp_json->end_date->date}}" class="form-control" readonly="true">
                </div>
                @endif

                @if(isset($camp_json->new_data->start_date))
                <div class="form-group">
                  <label for="name">Start Date</label>
                  <input type="text" value="{{$camp_json->new_data->start_date->date}}" class="form-control" readonly="true">
                </div>
                @endif

                @if(isset($camp_json->new_data->end_date))
                <div class="form-group">
                  <label for="name">End Date</label>
                  <input type="text" value="{{$camp_json->new_data->end_date->date}}" class="form-control" readonly="true">
                </div>
                @endif


                    @if(isset($features_data))
                    <table>
                      <div class="form-group" style="margin-top: 31px;margin-bottom: 0px;">
                        <label for="name">Module Access</label>
                      </div>
                      <div class="form-inline">
                       <div class="form-group">
                        <tr>
                          <td>
                            <span>Admin:</span>&nbsp;&nbsp;&nbsp;&nbsp;
                          </td>
                          <td>
                            @if(isset($features_data['admin']))
                            @foreach($features_data['admin'] as $featuresAdmin)
                            <span>{{$featuresAdmin['features_name']}},</span>

                            @endforeach
                            @endif
                          </td>
                        </tr>
                      </div>
                    </div>

                    <div class="form-inline">
                     <div class="form-group">
                      <tr>
                        <td>
                          <span>Read:</span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td>
                            @if(isset($features_data['read']))
                            @foreach($features_data['read'] as $featuresAdmin)
                            <span>{{$featuresAdmin['features_name']}},</span>
                            @endforeach
                            @endif
                          </td>
                        </tr>
                      </div>
                    </div>

                    <div class="form-inline">
                     <div class="form-group">
                      <tr>
                        <td>
                          <span>Write:</span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td>
                            @if(isset($features_data['write']))
                            @foreach($features_data['write'] as $featuresAdmin)
                            <span>{{$featuresAdmin['features_name']}},</span>

                            @endforeach
                            @endif
                          </td>
                        </tr>
                      </div>
                    </div>
                  </table>
                  @endif
                  @if(isset($group_permission))
                  <table>
                    <div class="form-group" style="margin-top: 31px;margin-bottom: 0px;">
                      <label for="name">Group Access</label>
                    </div>
                    <div class="form-inline">
                     <div class="form-group">
                      <tr>
                        <td>
                          <span>Admin:</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                          <span>{{$group_permission->admin}}</span>
                        </td>
                      </tr>
                    </div>
                  </div>

                  <div class="form-inline">
                   <div class="form-group">
                    <tr>
                      <td>
                        <span>Read:</span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>

                          <span>{{$group_permission->read}}</span>
                        </td>
                      </tr>
                    </div>
                  </div>

                  <div class="form-inline">
                   <div class="form-group">
                    <tr>
                      <td>
                        <span>Write:</span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          <span>{{$group_permission->write}}</span>

                        </td>
                      </tr>
                    </div>
                  </div>
                </table>
                @endif





                @if($queue_data->status == 'pending')
                <div class="form-group" style="margin-top: 12px;">
                  <label for="name">Change Status</label>
                  <select class="form-control" name="change_status" id='changeStatus'>
                    <option value="{{$queue_data->status}}">{{$queue_data->status}}</option>
                    <option value="paused">paused</option>
                     <option value="failed">failed</option>
                  </select>

                </div>
                @else
                 <div class="form-group" style="margin-top: 12px;">
                  <label for="name">Change Status</label>
                <input type = "text" name ="" value = "{{$queue_data->status}}" readonly="true" class="form-control">
              </div>
                @endif


                @if($queue_data->remark)
                <div class="form-group">
                  <label for="name">Remark</label>
                  <textarea class="form-control" readonly="true">{{$queue_data->remark}}</textarea>
                </div>
                @endif

              </div>
              <div class="form-group">
                <a class="btn btn-primary mr-2"  href="{{ URL::previous()}}">Back</a>

                 @if($queue_data->status == 'paused')

                <button type="button" id="syncData" class="btn btn-info btn-fw">Sync Data</button>

                <button type="button" id="revertData" class="btn btn-danger btn-fw">Revert Change</button>
                @endif

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function($){

     $('#selectclient').change(function() {
       var clientid=$(this).val();
       var url = "{{ URL::to('/skillgroupUsers')}}";
       if(clientid)
       {
        $.ajax({
          url: url+'/'+clientid,
          type: 'GET',
          data: 'clientid='+clientid,
          success:function(data){
       // console.log(data);
       if(data != null)
       {
         var obj = '';
         $('#skill_group').html('');
         obj = $.parseJSON(data);
         //console.log(obj);
        // obj=obj.data;
        if(obj== 'No Users Listed in this process')
        {
          $('#skill_group').append($("<option disabled='disabled' checked='false'></option>")
           .html('No Users Listed in this process')
           );
        }
        else
        {
         $.each(obj,function (index, value) {
          $('#skill_group').append($("<option></option>")
           .attr("value",value.id)
           .text(value.username)
           );
        });
       }
       $('#skill_group').multiselect({
        columns: 1,
        placeholder: 'Select Users',
        search: true,
      });

       $('select[multiple]').multiselect( 'reload' );
       $('#skill_group').click(function() {

        $('#skill_group option').prop('selected', true);
      });

     }

   }
 })

      }
    });

     $('#changeStatus').change(function(event) {
       var change_status=$(this).val();
       var id=$('#hidden_id').val();
       $.ajax({
         url: "{{ URL::to('/changePendingStatus')}}",
         type: 'POST',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data: {status: change_status,queueid:id},
         success:function(result)
         {
          if(result == true)
          {
            window.location.href='/synchronization';
          }
         }
       })
      });
     $('#syncData').on('click', function (e) {
// alert('sdxcdc');
var allVals=$('#hidden_id').val();
  //alert(allVals);
  var check = confirm("Are you sure you want to sync data?");
  if (check == true) {
//var join_selected_values = allVals.join(",");
var url = "{{ URL::to('/syncdata')}}";
var status_data;
//alert(join_selected_values);
$.ajax({
  url: url,
  type: 'POST',
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  data: 'ids=' + allVals,
  success: function(result){
   window.location.assign('/synchronization');
 }

});
}

});
     $('#revertData').on('click', function (e) {
       var allVals=$('#hidden_id').val();

       var check = confirm("Are you sure you want to revert changes?");
       if (check == true) {
//var join_selected_values = allVals.join(",");
var url = "{{ URL::to('/revertdata')}}";
//alert(join_selected_values);
$.ajax({
  url: url,
  type: 'POST',
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  data: 'ids=' + allVals,
  success: function(result){
   window.location.assign('/synchronization');
 }

});
}
});

   });


 </script>
 @endsection