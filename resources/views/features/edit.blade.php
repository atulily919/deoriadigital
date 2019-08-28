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
      Edit Client Features
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
          <form class="forms-sample" id="feature" role="form" action="{{url('updatefeatures')}}" method="post">
            <div class="form-group">
              <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
              <input type = "hidden" name = "clientid" value = "<?php echo $clientid ?>">
              <input type = "hidden" name = "json_data" value = '<?php echo $json_val ?>'>


              <div class="form-group">
                <label for="name">Client Name</label>
                <select class="form-control js-example-basic-single featuresClass" name="name" readonly="true" >

                  <option value="" disabled="true" selected>Select Client</option>
                  @foreach($client_data as $clientsData)
                  @if($clientsData->id == $clientid)
                  <option value="{{$clientsData->id}}" selected>{{$clientsData->name}}</option>
              <!--     @else
                  <option value="{{$clientsData->id}}">{{$clientsData->name}}</option> -->
                  @endif
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Features</label>
                <select class="form-control js-example-basic-single featuresClass" name="features_id[]" multiple id="featuresID">


                  @foreach($features as $featuresData)
                  @if(in_array($featuresData['id'],$arr))
                  <option value="{{$featuresData['id']}}" selected>{{$featuresData['features_name']}}</option>
                  @else

                  <option value="{{$featuresData['id']}}">{{$featuresData['features_name']}}</option>
                  @endif
                  @endforeach
                </select>
                <label id="featuresID-error" class="error" for="featuresID"></label>
              </div>



              <div class="form-group" id="div1" >
                <label> Select Sub Features
                  <!--<span class="required"> * </span>-->
                </label><br/>
                <select id='subfeatures' name='subfeatures_id[]' multiple class="form-control js-example-basic-single featuresClass" >

                  @foreach($selectedfet as $fetid=>$ips)
                  @foreach($features as $fetselected)
                  @if($fetid==$fetselected['id'])
                  <?php $name = $fetselected['features_name']?>
                  @endif
                  @endforeach

                  <optgroup label="{{$name}}">

                    @foreach($ips as $ip)
                    @if(in_array($ip['id'],$subfeature_list))
                    <option value="{{$ip['id'].'-'.$fetid}}" selected>{{$ip['sub_features_name']}}</option>
                    @else
                    <option value="{{$ip['id'].'-'.$fetid}}">{{$ip['sub_features_name']}}</option>
                    @endif
                    @endforeach

                  </optgroup>
                  @endforeach
                </select>
              </div>

              <input type="submit" class="btn btn-primary" name="data" id="submit_data" value="Update"/>
            </form>
          </div>
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
  <script type="text/javascript">
    $(document).ready(function($) {
      var fetvalue=$("#featuresID").val();
      if(fetvalue == '')
      {
        fetvalue='';
      }
      $('#featuresID').multiselect({
        columns: 1,
        placeholder: 'Select Features',
        search: true
      });
      $('#subfeatures').multiselect({
        columns: 4,
        placeholder: 'Select Sub Features',
        search: true,
        selectAll: true
      });
      $('select[multiple]').multiselect( 'reload' );
      $('#featuresID').click(function() {
        $('#subfeatures option').prop('selected', true);
      });

      $("#featuresID").change(function(){
        var selectedFeatures = $(this).val();
//console.log(selectedFeatures);
var clientid=<?php echo $clientid; ?>;
//alert(clientid);
var url = "{{ URL::to('ajaxeditclientfeatures')}}";
if(selectedFeatures){
  $.ajax({
    type: 'GET',
    url:url+'/'+selectedFeatures,
    data:{'selectedFeatures':selectedFeatures,'clientid':clientid},
    success:function(data){

      if(data != null)
      {
//alert('aaya');
$("#subfeatures").empty();
obj=JSON.parse(data);
console.log('data123',obj);
$.each( obj['allrecords'], function( featid, subfeatid) {

  featdetails=featid.split('-');
  $("#subfeatures").append('<optgroup id="'+featdetails[0]+'" label="'+featdetails[1]+'" ></optgroup>');
// console.log('values',values);

$.each( subfeatid, function( key, subfeat) {

  subfeatdetails=subfeat.split('-');
  console.log('subfeat',subfeatdetails);

  if(subfeatdetails[2]=='selected')
  {

    $('#'+featdetails[0]).append($("<option selected></option>")
      .attr("value",subfeatdetails[0]+'-'+featdetails[0])
      .text(subfeatdetails[1])
      );
  }
  else
  {
    $('#'+featdetails[0]).append($("<option></option>")
      .attr("value",subfeatdetails[0]+'-'+featdetails[0])
      .text(subfeatdetails[1])
      );
  }

});


});

$('#subfeatures').multiselect({
  columns: 4,
  placeholder: 'Select Sub Features',
  search: true,
  selectAll: true
});

$('select[multiple]').multiselect( 'reload' );
$('#featuresID').click(function() {
  $('#subfeatures option').prop('selected', true);
});

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