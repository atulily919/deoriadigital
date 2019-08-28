@extends('dashboard')
@section('content')

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Phonebook
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Phonebook</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('phonebook/create')}}">Create Phonebook </a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('phonebook')}}">Show Phonebook</a></li>
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
            <table id="example2" class="table">
              <thead>
               <tr>
                <th>
                  <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" id="ckbCheckAll" class="group-checkable"
                      data-set="#sample_1 .checkboxes"/><span></span>
                  </label>
                </th>
                <th>Name</th>
                <th>Campaign</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Callerid</th>
                <th>User Data</th>
                <th>Action</th>
              </tr>
            </thead>
          
         </table>
       </div>
     </div>
   </div>
 </div>
</div>

</div>
</div>
<!-- modal body -->
<!-- closed modal body -->
</div>


<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
            $('#ckbCheckAll').click(function () {
                $('.checkBoxClass').prop('checked', $(this).is(':checked'));
            });
            $(".checkBoxClass").click(function () {
                if ($(".checkBoxClass").length == $(".checkbox:checked").length) {
                    $("#ckbCheckAll").prop("checked", true);
                } else {
                    $("#ckbCheckAll").prop("checked", false);
                }
            });
        });
        var url = "{{ URL::to('phonebook')}}";
        var table = $('#example2').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [[2, 5, 15, 25, -1], [2, 5, 15, 25, "All"]],
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {"url": url},
            columnDefs: [
                {"orderable": false, "targets": [0]},
                {"orderable": true, "targets":  [1]},
                {"orderable": true, "targets":  [2]},
                {"orderable": true, "targets":  [3]},
                {"orderable": true, "targets":  [4]},
                {"orderable": true, "targ ets": [5]},
                {"orderable": false, "targets": [6]}
            ],
            columns: [
                {"data": "id"},
                {"data": "phonebookname"},
                {"data": "campaign"},
                {"data": "priority"},
                {"data": "status"},
                {"data": "callerid"},
                {"data": "user_data_excel"},
                {"data": "id"},
            ],
            "rowCallback": function (row, data, index) {
                $('td:eq(0)', row).html(
                    '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
                    '<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass"  value="' + data.id + '" />' +
                    '<span></span>' +
                    '</label>'
                );
              if (data.status == 'Active'){
                $('td:eq(4)', row).html(
                  '<a href="'+ 'phonebookchangestatus'+'/'+ data.id+'" class="btn btn-success">Enable</a>'
                  );
              }
                
                else{
                  $('td:eq(4)', row).html(
                '<a href="'+ 'phonebookchangestatus'+'/'+ data.id+'" class="btn btn-danger">Disable</a>'
                );
                 }


                   $('td:eq(6)', row).html(
                '<a href="'+ 'downloadphonebookexcel'+'/'+ data.id+'" >'+data.user_data_excel+'</a>'

               );
               
                $('td:last-of-type', row).html(
                    '<a class="btn btn-icon-only green" title="Edit" href="' + 'phonebook' + '/' + data.id  +'/'+'edit'+'"><i class="fa fa-edit"></i></a>' +
                    ' <a type="button" id="server_delete' + data.id + '" title="Delete" data-id=' + data.id + ' class="btn btn-icon-only red delete_server"><i class="fa fa-trash"></i></a>'
                );
            },
           
        });
        $('body').on('click', '.delete_server', function (e) {
            var answer = confirm("Are you sure you want to delete ?");
            if (answer) {
                $('.delete_msg').hide();
                $('#cover').show();
                var id = $(this).data('id');
                $.ajax({
                    url: url + '/' + id,
                    type: 'DELETE',
                    data: {"_token": "{{ csrf_token() }}"},
                    success: function (response) {
                        if (response == 'true') {
                            table
                                .draw();
                            $('#cover').fadeOut(200);
                            $('.delete_show_msg').show().html('Server Deleted Successfully!!!');
                            window.load();
                        }
                    }
                });
            }
        });
        $(document).ready(function ($) {
            $('#all_serverDelete').on('click', function (e) {
                // alert('sdxcdc');
                var allVals = [];
                $(".checkboxes:checked").each(function () {
                    allVals.push($(this).val());
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {


                    var check = confirm("Are you sure you want to delete selected servers?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: 'locationserver/bulkDelete',
                            type: 'GET',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (response) {
                                location.reload();
                                if (response == 'true') {
                                    table
                                        .draw();
                                    $('#cover').fadeOut(200);
                                    $('.delete_show_msg').show().html('Servers Deleted Successfully!!');


                                }
                            }
                        });
                    }
                }
            });
        });

 
 
</script>
@endsection
