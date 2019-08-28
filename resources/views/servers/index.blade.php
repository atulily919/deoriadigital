@extends('dashboard')
@section('content')

  <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Location Servers
            </h3>
           <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item">Servers</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/locationserver/create')}}">Create Location Server </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('locationserver')}}">Show Clients</a></li>
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
                           <th>Location Name</th>
                           <th>Server Name</th>
                           <th>Address</th>
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
        var url = "{{ URL::to('locationserver')}}";
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
                {"orderable": false, "targets": [4]}
            ],
            columns: [
                {"data": "id"},
                {"data": "location_masters.location"},
                {"data": "server_ip"},
                {"data": "address"},
                {"data": "id"},
            ],
            "rowCallback": function (row, data, index) {
                $('td:eq(0)', row).html(
                    '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
                    '<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass"  value="' + data.id + '" />' +
                    '<span></span>' +
                    '</label>'
                );
                 if (data.address == ' ') {
                    $('td:eq(3)', row).html("Address not present");
                } else {
                    $('td:eq(3)', row).html(data.address);
                }

                $('td:last-of-type', row).html(
                    '<a class="btn btn-icon-only green" title="Edit" href="' + url + '/' + data.id + '/edit"><i class="fa fa-edit"></i></a>' +
                    '<a class="btn btn-icon-only green delete_server" id="server_delete' + data.id + '" title="Delete" data-id=' + data.id + '><i class="fa fa-trash"></i></a>'
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
