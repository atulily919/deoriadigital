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
			Roles
		</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Roles</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('roles/create')}}">Create Roles </a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('roles')}}">Show Roles</a></li>
			</ol>
		</nav>

	</div>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
<!-- <h4 class="card-title">Client</h4>
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
<form class="forms-sample" role="form" action="{{url('roles')}}" method="post" name="roles_form" id="roles_form">
	<div class="form-group">

		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

		<h4 class="card-title">Basic</h4>
		<div class="form-group">
			<label for="name">Client Name</label>
			<select class="form-control js-example-basic-single featuresClass" name="client_id" id="client_id" onchange="featureslist()">
				<option value="" disabled="true" selected>Select Client</option>
				@foreach($client_data as $clientsData)
				<option value="{{$clientsData->id}}">{{$clientsData->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="roles_name"> Role's Name</label>
			<input type="text" class="form-control" name="roles_name" id="roles_name" placeholder="Enter Role" >
		</div>

		<div class="form-group" id="exist">

                    </div>
		<div class="form-group">
			<label for="group">Status</label>
			<select class="form-control" name="status" id="status" >
				<option value="Active" selected>Active</option>

			</select>
		</div>
		<div class="form-group">
			<label for="group">Group</label>
			<select class="form-control" name="group" id="group" >
				<option value="Default" selected>Default</option>

			</select>
		</div>
		<div class="form-group">
			<label for="">Default</label>
			<select class="form-control" name="default" id="" >
				<option value="0" selected="">0</option>
				<option value="1">1</option>

			</select>
		</div>
		<h4 class="card-title">Modules Access
			<a href="javascript:void(0)"><i class="fa fa-chevron-down" id="more" aria-hidden="true"></i>
			</a></h4>

			<div id="message" style="display:none">
				<table id="order-listing" class="table modulelist">
					<thead>
						<tr>
							<th>Modules</th>
							<th>Read</th>
							<th>Write</th>
							<!-- <th>Status</th> -->
							<th>Admin</th>
						</tr>
					</thead>
				</table>

			</div><!-- message close -->
			<h4 class="card-title">Groups Access
				<a href="javascript:void(0)"><i class="fa fa-chevron-down" id="moregroup" aria-hidden="true"></i>
				</a></h4>
				<div id="groupaccess" style="display:none">
					<table id="order-listing" class="table">
						<thead>
							<tr>
								<th>Modules</th>
								<th>Read</th>
								<th>Write</th>
								<!-- <th>Status</th> -->
								<th>Admin</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Default</td>
								<td>
									<div class="form-check form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input"
											name="group_read"><i class="input-helper"></i>
										</label>
									</div>
								</td>
								<td>
									<div class="form-check form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="group_write"><i class="input-helper"></i>
										</label>
									</div>
								</td>
								<td>
									<div class="form-check form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="group_admin"><i class="input-helper"></i>
										</label>
									</div>
								</td>
							</tr>


						</tbody>
					</table>

				</div>

				<button type="submit" class="btn btn-primary mr-2">Submit</button>
			</form>
		</div>
	</div>
</div>
</div>
</div>

<script src="{{ asset('js/data-table.js') }}"></script>
<script>
	$(document).ready(function(){
		 error=true;
		$("#more").click(function(){
			$("#message").slideUp();
			$("#message").show();
		});

		$("#moregroup").click(function(){
			$("#groupaccess").slideUp();
			$("#groupaccess").show();
		});



		$("#roles_name").keyup(function(){
           
            var roles_name = $(this).val();
             var clientid = $("#client_id").val();
            var url = "{{ URL::to('checkduplicaterole') }}";
            $("#exist").empty('');
            $.ajax({
              type: 'GET',
              url:url,
              data:{'roles_name':roles_name,'clientid':clientid},
              success:function(data){
              	arrdata=JSON.parse(data);
                if(typeof arrdata !== 'undefined' && arrdata.length > 0)
                {
                  $("#exist").html('<p style="color:red">* This Role for the selected client already exist</p>');
                 error=false;
                }
                else
                {
                 error=true;
                }
              }
            })
          });





		 $('form[id="roles_form"]').validate({
            rules: {
              client_id: 'required',
              roles_name: 'required',
              status:'required',
              group: 'required',
              

            },
            messages: {
              client_id: 'Client name is required',
              roles_name: 'Role Name is required',
              status:'Status is required',
              group: 'Group is required',
              

            },
            submitHandler: function(form) {
            if(error==true)
              {
                  form.submit();
              }
              else
              {
                 return false;
              }
            }
          });

	});

	function featureslist()
	{
		var clientid = document.getElementById("client_id").value;
		var url = "{{ URL::to('/listfeaturesclientwise')}}";
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			url:url,
			data:'clientid='+clientid,
			success:function(data){
				if(data)
				{
					list = $.parseJSON(data);
					$.each(list, function (index, value) {

						$(".modulelist").append('<tbody><tr><td>'+value['features_name']+'</td><td><div class="form-check form-check-primary"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="read_'+value['features_id']+'"><i class="input-helper"></i></label></div></td><td><div class="form-check form-check-primary"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="write_'+value['features_id']+'"><i class="input-helper"></i></label></div></td><td><div class="form-check form-check-primary"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="admin_'+value['features_id']+'"><i class="input-helper"></i></label></div></td></tr></tbody>');
					});



				}

			}
		});

	}


</script>
@endsection