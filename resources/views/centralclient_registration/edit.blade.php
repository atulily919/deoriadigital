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
      Central Client Registration
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Central Clients</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/registration/create')}}"> Create Registration</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('registration')}}">Show Central Clients</a></li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          {{ __('Register') }}
        </div>
        <div class="card-body">

          @if (count($errors) > 0)
          <div class = "alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li style="color: red">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form method="POST" action="{{url('registration/'.$usersdata['id'])}}" name="centralregister" id="centralregister">
            @csrf
            {{ Form::hidden('_method', 'PUT') }}
            <div class="form-group">
              <label for="name">{{ __('Name') }}</label>
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',$usersdata['name']) }}" required autofocus>

              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label for="email">{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',$usersdata['email']) }}" required>

              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label for="client name">Client Name</label>
              <select name="client_id[]" id="clientName"
              class="form-control js-example-basic-single featuresClass" multiple="true">



              @foreach($clientname as $clientsData)
              @if(in_array($clientsData->id,$uservalue))

              <option value="{{$clientsData->id}}" selected>{{$clientsData->name}}</option>
              @else
              <option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
              @endif

              @endforeach
            </select>
          </div>
          <div class="form-group" id="div1" >
            <label for="avbl_roles"> Select Roles </label>
            <select name="avbl_roles[]" class="form-control js-example-basic-single featuresClass" multiple id="avbl_roles">
              @php
              $clientarr=[];
              $rolearr=[];
              @endphp
              @foreach($userselectedrole as $userrole)
              <?php array_push($userrole->roleid, $rolearr);?>
              @endforeach

              @foreach($selectedrole as $clientname=>$value)

              <optgroup label="{{$clientname}}">
                @foreach($value[0] as $key=>$data)

                @foreach($userselectedrole as $userrole)

                @if($userrole->clientid==$data->client_id)
                @if($userrole->roleid==$data->roles_id)
                <option value="{{$data->roles_id}}-{{$data->client_id}}" selected>{{$data->rolename}}</option>
                @else
                <option value="{{$data->roles_id}}-{{$data->client_id}}" >{{$data->rolename}}</option>
                @endif
                @endif




                @endforeach
                @endforeach

              </optgroup>
              @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div> <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/jquery.multiselect.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(document).ready(function($) {


       $('form[id="centralregister"]').validate({
            rules: {
              name: 'required',
              email: 'required',
            },
            messages: {
              name: 'Client name is required',
              email: 'Email isrequired',
             
            },
            submitHandler: function(form) {
             
                  form.submit();
              
            }
          });


    $('#clientName').multiselect({
    columns: 1,
    placeholder: 'Select Client',
    search: true,
    });
    $('#avbl_roles').multiselect({
    columns: 4,
    placeholder: 'Select Roles',
    search: true,
    selectAll: true
    });
    
   $('#clientName').change(function() {
     var editid=<?php echo $usersdata['id'];?>;
    // alert(editid);
     var clientid=$(this).val();
     var url = "{{ URL::to('/editclientroles')}}";
     if(clientid)
     {
      $.ajax({
        url: url+'/'+clientid,
        type: 'GET',
        data: {'clientid':clientid,'editid':editid},
        success:function(successdata){
      // console.log(data);
     // alert('data');
      if(successdata != null)
      {
        
        var obj = '';
        //console.log(successdata);
       // console.log(type)
       
       obj= JSON.parse(successdata);
        
       // var omitrole=[]; var omitclient=[];
      // console.log('obj',obj);
       
        var editdata=<?php echo json_encode($roledata);?>;
      //  var obj2=[];
           //obj=obj.data;
         // console.log('jhgkh',editdata);
          $('#div1').show();
          $('#avbl_roles').html('');
          // $('#avbl_roles').empty();
          $.each(obj.data, function(index,value)
          {
             // console.log(index);
             $("#avbl_roles").append('<optgroup id="'+index+'" label="'+index+'" class="roles_chk"></optgroup>');
 
             $.each(value,function (ind, obj1) {
             
                $.each(obj1,function (ind1, obj2) {
             // console.log('test',obj1[i]['client_id']);
                    $.each(editdata,function (clientid, roleid) {
                      if(clientid==obj2.client_id && roleid==obj2.roles_id)
                      {
                       $('#'+index).append($("<option class='example' selected></option>")
                       .attr("value",obj2.roles_id+'-'+obj2.client_id)
                       .text(obj2.rolename));
                      }
                    });
               });
             });
             $.each(obj.unsel,function (cliid, unseldata) {
                      $.each(unseldata,function (key, val) {
                        if(val.name==index)
                        {
                          $('#'+index).append($("<option class='example'></option>")
                        
                       .attr("value",val.roles_id+'-'+val.client_id)
                       .text(val.rolename));
                        }
                      });
                    });
           });
          $('#avbl_roles').multiselect({
            columns: 1,
            placeholder: 'Select Roles',
            search: true,
            //  multiselect:false,
          });
          $('select[multiple]').multiselect( 'reload' );
          $('#clientName').click(function() {
            $('#selectroles option').prop('selected', true);
          });
                    }
                }
            })
        }
    });
});

</script>
@endsection