@extends('dashboard')
@section('content')
{{ Session::get(['clientid'])}}
{{ Session::get(['roleid'])}}

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Clients
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Clients</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('clients/create_client')}}">Create Clients </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allclients')}}">Show Clients</a></li>
      </ol>
    </nav>



  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
     <div class="card">
      @include('message')
      <div class="card-body">
       <!--  <h4 class="card-title">Data table</h4> -->
       <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
               <tr>
                <th>Client Name</th>
                <th>Description</th>
                <th>City</th>
                <!--   <th>Status</th> -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach($allclients as $clients)
              <tr role="row" class="odd">
                <td class="sorting_1">{{$clients['name']}}</td>
                <td>{{$clients['description']}}</td>
                <td>
                  @foreach($clients['clientlocation_details'] as $details)
                  @foreach($location as $l)
                  @if($details['location_master_id']==$l['id'])
                  <a
                  onclick="showservercitywise({{$l['id']}},{{$clients['id']}})" href="javascript:void(0);">{{$l['location'] }},</a>


                  @endif
                  @endforeach
                  @endforeach
                </td>
                <!--  <td><a href="" class="btn btn-success">Enable</a></td> -->
                <td>
                 @if(!empty($clients['clientlocation_details']))
                 <a href="javascript:void(0);"
                 onclick="deleterow({{$clients['id']}})"> <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp&nbsp
                 @endif
                 <a href="{{ url('/editclient',$clients['id']) }}"> <i class="fa fa-edit" aria-hidden="true"></i></a>
               </td>
             </tr>
             @endforeach


           </tr></tbody>
         </table>
       </div>
     </div>
   </div>
 </div>
</div>

</div>
</div>
<!-- modal body -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel" >Server list</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
       <!--  //body content here -->
       <ul id="list">

       </ul>

     </div>
   </div>
 </div>
</div>
<!-- closed modal body -->
</div>

<script type="text/javascript">

 function showservercitywise(cityid,clientid)
 {
  var url = "{{ URL::to('showservercitywise') }}";
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url:url,
    data: {"cityid":cityid,"clientid":clientid},
    success: function(result){
      if(result)
      {
        $('#list').empty();
        var subservers=JSON.parse(result);
        if(subservers[0].length == 0)
        {
          var $serverlist = $('<p>No ServerIp is assigned </p>');
          $('#list').append($serverlist);
        }
        else
        {
          for (var i=0;i<subservers.length;i++) {
           var $serverlist = $('<li>'+subservers[i][0]['server_ip']+'</li>');
           $('#list').append($serverlist);
         }
       }

       $('#myModal').modal('show');
     }
   }
 });
}
function deleterow(id)
{
  var url="{{ url('deleteclientrow') }}";
  var conf=confirm("Are you sure you want to delete this record?");
  if(conf)
  {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: url,
      data: {"id":id},
      success: function(result){
        if(result=='true')
        {
          location.reload();
                 // $('#delmsg').show().fadeOut(3000);
               }
             }
           });
  }
}
</script>
@endsection
