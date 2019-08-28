@extends('dashboard')
@section('content')
<style type="text/css">
  table.table-condensed {
    width: 100% !important;
  }
  .panel {
    margin-bottom: 20px;
    background-color: #ffffff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    border-color: #bce8f1;
    position: relative;
    bottom: 95px;
  }
  .panel-info > .panel-heading {
    color: #007bff;
    background-color: #d9edf7;
    border-color: #bce8f1;
  }
  .panel-body {
    padding: 15px;
  }

</style>

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Filter Condition
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Filter Query</a></li>
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
               <form class="forms-sample" role="form" action="{{url('campaignquery')}}" method="post">
                <div class="form-group">

                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

                  <div class="form-group">
                    <label for="Client Name">Client Name</label>
                    <select class="form-control" name="client_name" required="true" id="clientName">
                      <option value="" disabled="true" selected>Select Client Name</option>
                      @foreach($clientname as $client_name)
                      <option value="{{$client_name->id}}">{{$client_name->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group" id="div1">
                  </div>

                  <div class="form-group">
                    <label for="Client Name">Table Name</label>
                    <select class="form-control" name="table_name" required="true" id="tableName">
                      <option value="" disabled="true" selected>Select Table Name</option>
                      <option value="records">Records</option>
                    </select>
                  </div>

                  <div class="form-group field_wrapper_1" id="campaign_where">
                    <label for="where">Where </label>
                    <input type="text" name="where[]" value="" class="form-control" required="true" style="width: 97px!important;" id="where"/>
                    <label for="where" style="position: relative;left: 120px;bottom: 32px;font-size: 20px;"> = </label>
                    <select class="form-control" name="query_cond[]" style="position: relative;
                    width: 250px !important;left: 144px;bottom: 71px;">
                    <option value="=">=</option>
                    <option value=">"> > </option>
                    <option value="<"> < </option>
                    <option value=">="> >= </option>
                    <option value="<="> <= </option>
                    <option value="LIKE"> LIKE </option>
                    <option value="NOT LIKE">NOT LIKE</option>
                    <option value="BETWEEN">BETWEEN</option>
                    <option value="NOT BETWEEN">NOT BETWEEN</option>
                  </select>
                  <input type="text" name="condition_on[]" id="abc" value="" class="form-control" style="position: relative;left: 45%;width: 147px!important;bottom: 109px!important;"/>
                  <select name="concatenate_opt[]" style="width: 71px !important;position: relative;left: 62% !important;bottom: 155px !important;" class="form-control"><option value="AND">AND</option>
                   <option value="OR">OR</option>
                 </select>

                 <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ URL::to('/') }}/images/add-icon.png"/ class="addImage" style="width: 33px !important;position: relative;left: 71% !important;bottom: 189px !important;"></a>

               </div>
               <div class="btn-setting" style="position: relative;bottom: 138px;">
                 <button type="submit" class="btn btn-primary mr-2 submitbtn">Save</button>
                 <button type="button" id="queryrun" class="btn btn-primary mr-2 submitbtn">Run Query</button>
                 <button class="btn btn-light" href="{{url('/campaignquery')}}">Cancel</button>
               </div>

               <div class="panel panel-info">
                <div class="panel-heading" id="appendButton"><strong>Output</strong>

                 <button onclick="exportTableToCSV('members.csv')" style="display: block; position: relative;bottom: 13px;left: 73%; display: none" class="btn btn-default btn-sm" id="downloadButton">Export HTML Table To CSV File</button>
               </div>

               <div class="panel-body" id="table-rawdata">
                <p><i class="fa fa-exclamation-circle"></i> Press Run Query button to see output!</p>
              </div>
              <div style="overflow-x:auto;display: none;" id="sqlQueryOutput"><table class="table table-bordered table2excel" id="table-data" data-tableName="Test Table 2"><thead><tr class="noExl"><th class="text-center">#</th><th class="text-center">Currentstatus</th><th class="text-center">Legalstatus</th><th class="text-center">Mobile</th><th class="text-center">Status</th><th class="text-center">Dialer Status</th><th class="text-center">Dialersubstatus</th></tr></thead><tbody></tbody>
              </table></div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $('#clientName').change(function() {

     var clientid=$(this).val();
    // alert(clientid);
    var url = "{{ URL::to('/clientscampign')}}";
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
        $('#div1').html('<label for="avbl_campaign"> Select Campaign<select id="avbl_campaign"  name="avbl_campaign" class="form-control avbl_campaign"  style="position: relative;top: 11px; width: 646px!important;;"></select>');

        var obj = '';
        obj = JSON.parse(data);

        //   obj=obj.data;
         //console.log(obj);
         $('#div1').show();
         $('#avbl_campaign').html('');
          // $('#avbl_roles').empty();
          $.each(obj, function(index,value)
          {
              //console.log(value.campaign_name);
              $("#avbl_campaign").append('<option id="'+value.id+'" value="'+value.id+'">'+value.campaign_name+'</option>');

            });
        }

      }
    })

    }

  });
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper_1'); //Input field wrapper
    $('.select2-container--default .select2-selection--single .select2-selection__rendered').css({
      "line-height": "13px"
    });
    var fieldHTML = '<div class="filter-div" style="position: relative;bottom: 149px;"><input type="text" name="where[]" value="" class="form-control" required="true" style="width: 97px!important;"/> <label for="where" style="position: relative;left: 120px;bottom: 32px;font-size: 20px;"> = </label><select class="form-control" name="query_cond[]" style="position: relative; width: 250px !important;left: 144px;bottom: 71px;"><option value="=">=</option> <option value=">"> > </option><option value="<"> < </option><option value=">="> >= </option><option value="<="> <= </option><option value="LIKE"> LIKE </option><option value="NOT LIKE">NOT LIKE</option> <option value="BETWEEN">BETWEEN</option> <option value="NOT BETWEEN">NOT BETWEEN</option></select><input type="text" name="condition_on[]" id="abc" value="" class="form-control" style="position: relative;left: 45% !important;width: 147px!important;bottom: 109px!important;"/><select name="concatenate_opt[]" style="width: 71px !important;position: relative;left: 62% !important;bottom: 155px !important;" class="form-control"><option value="AND">AND</option><option value="OR">OR</option></select><a href="javascript:void(0);" class="remove_button"><i class="fa fa-times" aria-hidden="true" style="position: relative;left: 72%;bottom: 185px;"></i></a></div>';
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
          }
        });

    $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
      });
    $('#loginButton').click(function(e) {
      e.preventDefault();
      $('#loginDetails').show();
    });

    $('#queryrun').click(function(e){
      var clientname=$('#clientName').val();
      var avbl_campaign=$('#avbl_campaign').val();
      var table_name=$('#tableName').val();
      var where_con=[];
      var query_con=[];
      var condition_on=[];
      var concatenate_opt=[];
      $('input[name^="where"]').each(function() {
        var wherecon=$(this).val();
        where_con.push(wherecon);
      });
      $('select[name^="query_cond"]').each(function() {
        var querycon=$(this).val();
        query_con.push(querycon);
      });
      $('input[name^="condition_on"]').each(function() {
        var conditionon=$(this).val();
        condition_on.push(conditionon);
      });
      $('select[name^="concatenate_opt"]').each(function() {
        var concatenateopt=$(this).val();
        concatenate_opt.push(concatenateopt);
      });

     // console.log(where_con);
     var url = "{{ URL::to('/campaignqueryrun')}}";
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url:url,
      data:{clientname:clientname,avbl_campaign:avbl_campaign,table_name:table_name,where_con:where_con,query_con:query_con,condition_on:condition_on,concatenate_opt:concatenate_opt},

      success:function(data){
       if(data != null)
       {
         $('#table-rawdata').hide();
         list= $.parseJSON(data);
         console.log(list);
         $('#sqlQueryOutput').show();
         $('#downloadButton').css('display','block');

         $.each(list, function(key, value) {
          var tr = $("<tr />")
          $.each(value, function(k, v) {
           tr.append(
             $("<td />", {
               html: v
             })[0].outerHTML
             );
           $("table tbody").append(tr)
         })
        })
       }
       else
       {
        $("table tbody").append('<h5 class="text-danger"><i class="fa fa-exclamation-circle"></i> No Result!</h5>');

      }
    }
  });


   });
    function downloadCSV(csv, filename) {
      var csvFile;
      var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
  }
  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");

      for (var j = 0; j < cols.length; j++)
        row.push(cols[j].innerText);

      csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
  }


</script>

@endsection