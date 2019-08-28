@extends('dashboard')
@section('content')
<style>

.modal .modal-dialog .modal-content .modal-body
{
    width:135% !important;
}
.modal-content {
    width:135% !important;
}
</style>

<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Client Users
  </h3>
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Client Users</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('users/create')}}">Create Users</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('allclients')}}">Show Users</a></li>
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
                <th>Client Name</th>
                <th>User Name</th>
                <th>Location</th>
                <th>Location Server</th>
                <th>UserType</th>
                <th>Status</th>
                <th>Action</th>
                <th>Password Reset</th>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-3">Reset Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form name="" method="post" action="{{ url('users/resetpassword')}}">
                             @csrf
                                <input type="hidden" id="pass_reset" value="" name="user_id">
                                    <div class="form-group">
                                        <label for="name">New Password</label>
                                        <input type="password" class="form-control" name="new_password" required="true" size="400">
                                    </div>
                                  <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>

                </div>
        </div>
    </div>
</div>


<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="../../js/modal-demo.js"></script>
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
   var url = "{{ URL::to('users')}}";
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
    {"orderable": true, "targets":  [6]},
    {"orderable": false, "targets": [7]},
     {"orderable": true, "targets": [8]}
    ],
    columns: [
    {"data": "id"},
    {"data": "name"},
    {"data": "username"},
    {"data": "location"},
    {"data": "server_ip"},
    {"data": "usertype"},
    {"data": "status"},
    {"data": "id"},
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
        $('td:eq(6)', row).html(
          '<a href="'+ 'clientuserschangestatus'+'/'+ data.id+'" class="btn btn-success">Enable</a>'
          );
    }
    else if(data.status == 'Pending')
    {
        $('td:eq(6)', row).html(
            '<a href="'+ 'clientuserschangestatus'+'/'+ data.id+'" class="btn btn-primary">Pending</a>'
            );
    }
    else{
      $('td:eq(6)', row).html(
        '<a href="'+ 'clientuserschangestatus'+'/'+ data.id+'" class="btn btn-danger">Disable</a>'
        );
  }

  $('td:eq(7)', row).html(
    '<a class="" title="Edit" href="' + 'users' + '/' + data.id  +'/'+'edit'+'"><i class="fa fa-edit"></i></a>'
    // ' <a id="server_delete' + data.id + '" title="Delete" data-id=' + data.id + ' class=" delete_server"><i class="fa fa-trash"></i></a>'

    );
   $('td:eq(8)', row).html(

    '<button type="button" class="btn btn-primary btn-sm password_reset" data-toggle="modal" data-target="#myModal" id="'+data.id+'"><i class="fa fa-key"></i></button>'
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
   $('body').on('click', '.password_reset', function (e) {
    var id=this.id;
    $('#pass_reset').val(id);
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
