@extends('dashboard')
@section('content')

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      All Features
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">All Features</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allfeatures/create')}}">Create Features </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allfeatures')}}">Show Features</a></li>
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
                  <th>Feature Name</th>
                  <th>Status</th>
                  <th>Show</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($features as $all_features)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $all_features->features_name}}</td>
                  <td>
                    @if($all_features->status == '1')
                    <a href="{{url('/allfeaturesStatus', $all_features->id)}}" class="btn btn-success">Enable</a>
                    @else
                    <a href="{{url('/allfeaturesStatus', $all_features->id)}}" class="btn btn-danger">Disable</a>
                    @endif
                  </td>
                  <td>

                    <button class="btn btn-primary"
                    onclick="showallsubfeatures({{$all_features->id}})">Show SubFeatures</button>
                  </td>
                  <td>
                   <a href="javascript:void(0);"
                   onclick="deleterow({{$all_features->id}})"> <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp&nbsp
                   <a href="{{ url('/allfeatures',$all_features->id) }}"> <i class="fa fa-edit" aria-hidden="true"></i></a>
                 </td>

                 <!-- Modal content -->

               </div>

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

  function showallsubfeatures(featureid)
  {
        //alert(featureid);

        $("#myform").empty();
        var url = "{{ URL::to('showallsubfeatures')}}";

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",
          url:url,
          data: {"featureid":featureid},
          success: function(result){
            if(result != '')
            {
              console.log(result);
             // alert('not null');
             var subfeatures=JSON.parse(result);

             var container = $('#myform');

             $('<input />', { type: 'hidden',name: "_token", value: "<?php echo csrf_token() ?>" }).appendTo(container);

             $('<input />', { type: 'hidden',name: "featureid", value: featureid }).appendTo(container);
             if(subfeatures.length > 0)
             {

              for (var i=0;i<subfeatures.length;i++)
              {

                if(subfeatures[i]['status']=='1')
                {

                  $('<input />', { type: 'hidden',name: "subfeatures"+"_"+subfeatures[i]['id'],id: subfeatures[i]['id'], value: subfeatures[i]['id'],checked:'checked'}).appendTo(container);

                  $('<label />', { 'for': subfeatures[i]['id'], text: subfeatures[i]['sub_features_name'] }).appendTo(container);
                  $('#myform').append("</br>"); 

                }
                else if(subfeatures[i]['status']=='0')
                {

                  $('<input />', { type: 'hidden',name: "subfeatures"+"_"+subfeatures[i]['id'],id: subfeatures[i]['id'], value: subfeatures[i]['id']}).appendTo(container);

                  $('<label />', { 'for': subfeatures[i]['id'], text: subfeatures[i]['sub_features_name'] }).appendTo(container);
                  $('#myform').append("</br>");

                }


              }
            }
            else
            {
             $('<p>No SubFeatures Found</p>').appendTo(container);
             $('#myform').append("</br>");
           }

          // $('<input type="submit" name="submitform" class="btn btn-primary" value="Save"/>').appendTo(container);


           $('#myModal').modal('show');
         }

       }
     });
      }
      function deleterow(id)
      {
        var id=id;
        var url="{{ url('deleteallfeatures') }}";
        var conf=confirm("Are you sure you want to delete this features?");
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
