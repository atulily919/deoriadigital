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
    <h3 class="page-title">Edit Phonebook</h3>
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Phonebook</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('phonebook/create')}}">Create Phonebook </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('phonebook')}}">Show Phonebook</a></li>
      </ol>
    </nav>  
  </div>

  <div class="row">
   
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
        

            
              <div class="container">
                <form class="forms-sample" role="form" action="{{ url('phonebook/'.$phonebook['id']) }}" method="post" enctype="multipart/form-data" id="phonebook" name="phonebook">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                    {{ Form::hidden('_method', 'PUT') }}
                 
                  <div class="form-group">
                    <label for=" Name">PhoneBook Name</label>
                    <input type="text" class="form-control" name="phonebookname" placeholder="Enter PhoneBook Name" value="{{old('phonebookname',$phonebook['phonebookname'])}}">
                  </div>

                   <div class="form-group">
                      <label for="desc">PhoneBook Description</label>
                      <textarea class="form-control"  rows="4" placeholder="Enter PhoneBook Description" name="desc" id="desc">{{old('desc',$phonebook['description'])}}</textarea>
                   </div>
                     <div class="form-group">
                    <label for="name">Campaign</label>
                    <select class="form-control js-example-basic-single featuresClass" name="campaign" id="campaign" >
                      <option value="" disabled="true" selected>Select Campaign</option>
                      @foreach($campaign as $camp)
                      @if($camp['id']==$phonebook['campaign'])
                      <?php $checked="selected"; ?>
                      @else
                      <?php $checked=""; ?>
                      @endif
                      <option value="{{$camp['id']}}" {{$checked}}>{{$camp['campaign_name']}}</option>
                      @endforeach
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="priority">Priority</label>
                    <input type="text" class="form-control" name="priority" value="{{old('priority',$phonebook['priority'])}}">
                  </div>

                
                  <div class="form-group">
                    <label for="callerid">Caller Id</label>
                    <input type="text" class="form-control" name="callerid" value="{{old('callerid',$phonebook['callerid'])}}">
                  </div>

                  <div class="form-group">
                    <label for="Status">Status</label>
                    <select class="form-control" name="status">
                      @if($phonebook['status']=='Active')
                      <option value="Active" checked>Active</option>
                      <option value="InActive">InActive</option>
                      @else
                      <option value="Active">Active</option>
                      <option value="InActive" checked>InActive</option>
                      @endif
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="myFile">Select a file</label>
                   
                   

                    @if($phonebook['user_data_excel'])
                     <p>{{$phonebook['user_data_excel']}}</p>
                   @endif
                      <input type="file" id="myFile" name="myFile" >
                   
                    
                   
                  </div>
                

                
                

                  <button type="submit" class="btn btn-primary mr-2">Add Phonebook</button>
                  <!-- <button class="btn btn-light">Cancel</button> -->
                </form>
              </div>
          

       
          </div><!-- cardbody -->
      </div><!-- card -->
    </div><!-- col 12 -->
  </div><!-- row -->

</div>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
  
  $(document).ready(function($) {

$('form[id="phonebook"]').validate({
            rules: {
              phonebookname: 'required',
              campaign: 'required',
            },
            messages: {
              phonebookname: 'Phonebook name is required',
              campaign: 'Campaign is required',
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
});
</script>
  
@endsection