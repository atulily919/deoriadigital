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
     <div class="card-header">{{ __('Register') }}</div>
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
     <form method="POST" action="{{url('registration')}}" name="centralregister" id="centralregister">
      @csrf
      <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="password">{{ __('Password') }}</label>

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
        <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" required>
      </div>


      <div class="form-group">
        <label for="client name">Client Name</label>
        <select name="client_id[]" id="clientName" class="form-control js-example-basic-single featuresClass" multiple="true">

          @foreach($client_data as $clientsData)
          <option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
          @endforeach
        </select>
      </div>



      <div class="form-group" id="div1" style="display:none">

      </div>

      <button type="submit" class="btn btn-primary">
        {{ __('Register') }}
      </button>
    </form>
  </div>
  <!-- /.card-body -->
</div>

</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->

<!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">


  $(document).ready(function($) {

       $('form[id="centralregister"]').validate({
            rules: {
              name: 'required',
              email: 'required',
              password: 'required',
              'password_confirmation': {
                    equalTo: "#password"
                },  
             
              
            },
            messages: {
              name: 'Client name is required',
              email: 'Email isrequired',
              password: 'Password is required',
              'password_confirmation': 'Enter Confirm Password Same as Password',
              
             
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
   $('#clientName').change(function() {

     var clientid=$(this).val();
     var url = "{{ URL::to('/clientroles')}}";
     if(clientid)
     {
      $.ajax({
        url: url+'/'+clientid,
        type: 'GET',
        data: 'clientid='+clientid,
        success:function(data){
       //console.log(data);
      // alert(data);
      if(data != null)
      {
        $('#div1').html('<label for="avbl_roles"> Select Roles</label><select id="avbl_roles"  name="avbl_roles[]" multiple="true" class="form-control js-example-basic-single avbl_roles"  style="position: absolute; width: 95%;"></select>');

        var obj = '';
        obj = JSON.parse(data);

           //obj=obj.data;
          //console.log(obj);
          $('#div1').show();
          $('#avbl_roles').html('');
          // $('#avbl_roles').empty();
          $.each(obj, function(index,value)
          {
             // console.log(index);
             $("#avbl_roles").append('<optgroup id="'+index+'" label="'+index+'" class="roles_chk"></optgroup>');

             $.each(value,function (ind, obj1) {
               $.each(obj1,function (ind1, obj2) {
                 $('#'+index).append($("<option class='example'></option>")

                   .attr("value",obj2.roles_id+'-'+obj2.client_id)
                   .text(obj2.rolename)
                   );

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