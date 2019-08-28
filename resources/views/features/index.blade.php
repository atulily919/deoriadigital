@extends('dashboard')
@section('content')

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Client Features
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Clients Feature</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/clientfeatures/create')}}"> Create Feature </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('clientfeatures')}}">Show Feature</a></li>
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
                  <th>Features</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($allclients as $clients)
                @if(!empty($clients['clientfeatures_details']))

                <tr role="row" class="odd">
                  <td class="sorting_1">{{$clients['name']}}</td>
                  <td>
                    @foreach($clients['clientfeatures_details'] as $details)
                    @foreach($feature as $l)
                    @if($details['features_id']==$l['id'])
                    <a onclick="showsubfeature({{$l['id']}},{{$clients['id']}})" href="javascript:void(0);">{{$l['features_name']}} , </a>
                    @endif

                    @endforeach
                    @endforeach
                  </td>
                  <td>{{$clients['created_at']}}</td>
                  <td>
                    @if(!empty($clients['clientfeatures_details']))
                    <a href="javascript:void(0);" onclick="deleterow({{$clients['id']}})"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                    @endif
                    <a href="{{ url('/editclientfeatures',$clients['id']) }}"> <i class="fa fa-edit" aria-hidden="true"></i></a>
                  </td>
                </tr>
                @endif
                @endforeach


              </tr></tbody>
            </table>
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
         <h4 class="modal-title" id="myModalLabel">Sub Features list</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

       </div>
       <div class="modal-body">
         <!--  //body content here -->
         <ul id="list">

         </ul>


       </ul>
     </div>
   </div>
 </div>
</div>
<!-- closed modal body -->

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
       <form id="myform" name="myform" method="post" action="/editSubservers">

       </form>
     </div>
   </div>
 </div>
</div>
<!-- closed modal body -->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/jquery.multiselect.js"></script>

<script type="text/javascript">
  function showsubfeature(featureid,clientid)
  {
   $("#myform").empty();
   var url = "{{ URL::to('showsubfeature')}}";
   $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url:url,
    data: {"featureid":featureid,"clientid":clientid},
    success: function(result){
      if(result)
      {
        $('#list').empty();
        var subservers=JSON.parse(result);
        if(subservers[0].length == 0)
        {
          var $serverlist = $('<p>No subfeatures are assigned </p>');
          $('#list').append($serverlist);
        }
        else
        {
          for (var i=0;i<subservers.length;i++) {
            if(subservers[i])
            {
              var $serverlist = $('<li>'+subservers[i][0]['sub_features_name']+'</li>');
              $('#list').append($serverlist);
            }
          }
        }

        $('#myModal').modal('show');
      }
    }
  });
 }

 function deleterow(id)
 {
  var url="{{ url('deletefeaturerow') }}";
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
         $('#delmsg').show().fadeOut(3000);

       }
     }
   });
  }
}

</script>
@endsection
