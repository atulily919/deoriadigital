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
                  <form class="forms-sample" role="form" action="{{url('skillgroup')}}" method="post" name="roles_form" id="roles_form">
                    <div class="form-group">

                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

                      <div class="form-group">
                        <label for="name">Group Name</label>
                       <input type="text" name="group_name" id="group_name" value="" class="form-control" placeholder="Enter SkillGroup Name" >
                      </div>

                       <div class="form-group">
                      <label for="name">Client</label>
                      <select class="form-control" name="client_id" id="selectclient">
                        <option value="" disabled selected>Select Client</option>
                        @if(count($clients_name) > 0)
                        @foreach($clients_name as $clientName)
                       <option value="{{$clientName->id}}">{{$clientName->name}}</option>
                       @endforeach
                        @else
                        <p>No Clients Found</p>
                       @endif
                      </select>
                    </div>

                      <div class="form-group">
                      <label for="name">Users</label>
                      <select class="form-control js-example-basic-single featuresClass"  name="users_list[]"  multiple="true" id="skill_group">
                       
                      </select>
                    </div>
                    
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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