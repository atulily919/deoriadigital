@extends('dashboard')
@section('content')

  <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Clients
            </h3>
           <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                 <li class="breadcrumb-item">Central Clients</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/registration/create')}}"> Create Registration</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('registration')}}">Show Central Clients</a></li>
                </ol>
            </nav>
            
              
              
          </div>
          <div class="btn-group">
          <button type="" id="all_serverDelete" class="btn sbold red" style="position: relative;bottom: 16px;">Delete</button>
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
                          <th width="5%">
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input id="ckbCheckAll" type="checkbox" class="group-checkable"
                        data-set="#sample_1 .checkboxes"/>
                        <span></span>
                       </label>
                      </th>
                           <th>User Name</th>
                           <th>Email</th>
                           <th>Client</th>
                           <th>Status</th>
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
        var url = "{{ URL::to('registration')}}";
        var table = $('#example2').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [[2, 5, 15, 25, -1], [2, 5, 15, 25, "All"]],
            "pageLength": 15,
            "processing": true,
            "serverSide": true,
            "ajax": {"url": url},
            columnDefs: [
                {"orderable": false, "targets": [0]},
                {"orderable": true, "targets":  [1]},
                {"orderable": true, "targets":  [2]},
                {"orderable": true, "targets":  [3]},
                {"orderable": true, "targets":  [4]},
                {"orderable": false, "targets":  [5]}
            ],
            columns: [
                {"data": "id"},
                {"data": "name"},
                {"data": "email"},
                {"data": "clientname"},
                {"data": "status"},
                {"data": "id"},
            ],
            "rowCallback": function (row, data, index) {
                $('td:eq(0)', row).html(
                    '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
                    '<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass"  value="' + data.id + '" />' +
                    '<span></span>' +
                    '</label>'
                );

               if(data.status=='Active')
                {
                  $('td:eq(4)', row).html(
                    '<a class="btn btn-success" title="Active" href="' + url + '/changestatus'+'/'+ data.id+'">Enable</a>');
                  }
                  else
                  {
                     $('td:eq(4)', row).html(
                    '<a class="btn btn-danger" title="Inactive" href="' + url + '/changestatus'+'/'+ data.id+'">Disable</a>');
                  }

                $('td:last-of-type', row).html(
                    '<a class="btn btn-icon-only green" title="Edit" href="' + url + '/' + data.id + '/edit"><i class="fa fa-edit"></i></a>' +
                    ' <a type="button" id="users_delete' + data.id + '" title="Delete" data-id=' + data.id + ' class="btn btn-icon-only red delete_users"><i class="fa fa-trash"></i></a>'
                );
            },
        });
        $('body').on('click', '.delete_users', function (e) {
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
                            $('.delete_show_msg').show().html('Users Deleted Successfully!!!');
                           // window.load();
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
