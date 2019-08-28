
@extends('dashboard')
@section('content')
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Edit All Features
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">All Features</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allfeatures/create')}}">Edit Features </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allfeatures')}}">Show Features</a></li>
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
               <form class="forms-sample" role="form" action="{{url('/allfeaturesEdit/'.$subfeatures_details['id'])}}" method="post" name="client_form" id="client_form">
                <div class="form-group">

                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

                  <div class="form-group">
                    <label for="feature_name"> Feature's Name</label>
                    <input type="text" class="form-control" name="features_name" id="client_name" placeholder="Enter Feature's Name" required="true" value="{{$subfeatures_details['features_name']}}">
                  </div>
                  <div class="form-group field_wrapper">
                   <label>Enter Sub Features</label>
                   @if($subfeatures_details['subfeatures'])
                   @foreach($subfeatures_details['subfeatures'] as $subfeatures_data)

                   <input type="text" name="sub_features_name[{{$subfeatures_data['id']}}]" class="form-control" style="width: 97%;" value="{{$subfeatures_data['sub_features_name']}}"/><br/>
                   <input type="hidden" value="{{$subfeatures_data['id']}}" name="subfeaturesid">
                   @endforeach
                   @else
                   <input type="text" name="sub_features_name[]" value="" class="form-control" style="width: 97%;"/>
                   @endif

                   <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ URL::to('/') }}/images/add-icon.png"/ class="addImage" style="width: 37px;position: relative;left: 71%;bottom: 41px;"></a>
                 </div>

                 <button type="submit" class="btn btn-primary mr-2">Edit Features</button>
                 <button class="btn btn-light">Cancel</button>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>

     <script src="{{ asset('js/data-table.js') }}"></script>
     <script type="text/javascript">

      $(document).ready(function() {
        $('.js-example-basic-single').select2();

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="sub_features_name[]" value="" class="form-control" style="width: 97%;"/><a href="javascript:void(0);" class="remove_button"><i class="fa fa-times" aria-hidden="true"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
          }
        });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
      });
  });

</script>

@endsection