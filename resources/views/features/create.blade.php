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
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Client Features</h4>

                   @if (count($errors) > 0)
                     <div class = "alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                              <li style="color: red">{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  @endif
                <form class="forms-sample" role="form" action="{{url('clientfeatures')}}" method="post" id="feature">
                    <div class="form-group">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

                    <div class="form-group">
                      <label for="name">Client Name</label>
                      <select class="form-control js-example-basic-single featuresClass" name="name" required="true">
                        <option value="" disabled="true" selected>Select Client</option>
                        @foreach($client_data as $clientsData)
                        <option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Features</label>
                      <select class="form-control js-example-basic-single featuresClass" name="features_id[]" multiple="true"
                       id="featuresID"  style="position: absolute; width: 100%;">
                        @foreach($feature_data as $featuresData)
                        <option value="{{$featuresData->id}}">{{$featuresData->features_name}}</option>
                        @endforeach
                      </select>
                      <label id="featuresID-error" class="error" for="featuresID"></label>
                    </div>


                    <div class="form-group" id="div1" style="display:none">
                          <label> Select Sub Features
                              <!--<span class="required"> * </span>-->
                          </label>
                         <select id='subfeatures'  name='subfeatures_id[]' multiple="true" class="sub_features js-example-basic-single" >
                            </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="data" id="submit_data" value="Assign Features"/>
                    </div>
                </form>

              <!-- /.card-body -->
            </div>

            <div class="row">


            </div>

                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

                <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="/js/jquery.multiselect.js"></script>

    <script type="text/javascript">
      $(document).ready(function($) {
        $('#featuresID').multiselect({
        columns: 1,
        placeholder: 'Select Features',
        search: true
    });



$("#featuresID").change(function(){
        var selectedFeatures = $(this).val();
        console.log(selectedFeatures);
        var url = "{{ URL::to('clientfeatures')}}";
         if(selectedFeatures){
            $.ajax({
                type: 'GET',
                url:url+'/'+selectedFeatures,
                data:'selectedFeatures='+selectedFeatures,
                success:function(data){
                    console.log(data);
                     if(data != null)
                   {

$('#div1').html('<label> Select Sub Features </label><select id="subfeatures"  name="subfeatures_id[]" multiple="true" class="sub_features js-example-basic-single"  style="position: absolute; width: 100%;"></select>');
                     // $('select[multiple]').multiselect( 'destroy' );
                       var count = $('#featuresID option:selected').length;
                       if( count > 1)
                       {
                        $(this).parent().find(':checkbox:checked').removeAttr('checked');
                       }
                        var obj = '';
                     obj = $.parseJSON(data);
                     obj=obj.data;
                     //console.log(obj);

                    $('#div1').show()
                   //  $.each(obj, function(index1,value1) {

                    $.each(obj, function(index,value) {

                      var values=index.split('-');
                        $("#subfeatures").append('<optgroup id="'+values[0]+'" label="'+values[1]+'" ></optgroup>');


                             $.each(value, function (ind, obj1) {

                            ///console.log(obj1.sub_features_name);

                            $('#'+values[0]).append($("<option></option>")
                             .attr("value",obj1.id+'@@'+values[0])
                             .text(obj1.sub_features_name)
                             );

                        });
                       //  });

                         }); $('#subfeatures').multiselect({
                        columns: 4,
                      placeholder: 'Select SubFeatures',
                      search: true,
                      selectAll: true
                      });

                         $('select[multiple]').multiselect( 'reload' );
                            $('#featuresID').click(function() {
                                $('#subfeatures option').prop('selected', true);
                            });

                   }
                   else
                   {

                   }
                }
            })

         }

    });
          $('form[id="feature"]').validate({
            ignore: [],
            rules: {
              'name': 'required',
              'features_id[]': 'required',

            },
            messages: {
              'name': 'Client name is required',
              'features_id[]':'Features is required',
            },
            submitHandler: function(form) {
              form.submit();
            }
          });

    });

    </script>
@endsection