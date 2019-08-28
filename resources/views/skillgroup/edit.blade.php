@extends('dashboard')
@section('content')
<style type="text/css">
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
        <div class="content-wrapper">
          <div class="page-header">
           <h3 class="page-title">
              SkillGroup
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Skill Group</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('skillgroup/create')}}">Create SkillGroup </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('skillgroup')}}">Show SkillGroup</a></li>
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
                  <form class="forms-sample" role="form" action="{{url('skillgroup/'.$editskills->id)}}" method="post" name="roles_form" id="roles_form">
                    <div class="form-group">

                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                      {{ Form::hidden('_method', 'PUT') }}

                      <div class="form-group">
                        <label for="name">Group Name</label>
                       <input type="text" name="group_name" id="group_name" value="{{$editskills->group_name}}" class="form-control" placeholder="Enter SkillGroup Name" required="true">
                      </div>

                      <div class="form-group">
                      <label for="name">Client</label>
                      <select class="form-control" name="client_id" id="selectclient">
                        <option value="{{$client_name->id}}"selected>{{$client_name->name}}</option>
                        @if(count($all_clients) > 0)
                        @foreach($all_clients as $allClients)
                       <option value="{{$allClients->id}}">{{$allClients->name}}</option>
                       @endforeach
                       @endif
                      </select>
                    </div>
                    
                      <div class="form-group">
                      <label for="name">Users</label>
                      <select class="form-control js-example-basic-single featuresClass"  name="users_list[]"  multiple="true" id="skill_group">
                        @foreach($userval as $uservalues)
                        <option value="{{$uservalues->id}}" selected>{{$uservalues->username}}</option>
                        @endforeach
                        @foreach($allusers as $all_users)
                        <option value="{{$all_users->id}}">{{$all_users->username}}</option>
                        @endforeach
                       
                      </select>
                    </div>
                     </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $(document).ready(function($){
 $('#skill_group').multiselect({
        columns: 1,
        placeholder: 'Select Users',
        search: true,
      });
        
        $('select[multiple]').multiselect( 'reload' );
        $('#skill_group').click(function() {

        $('#skill_group option').prop('selected', true);
        });

        $('form[id="roles_form"]').validate({
            rules: {
               group_name: 'required', 
              client_id: 'required',
            },
            messages: {
              group_name: 'Group Name is required',
              client_id: 'Client name is required',
              
            
              

            },
            submitHandler: function(form) {
              form.submit();
            }
          });
});

 



</script>
@endsection