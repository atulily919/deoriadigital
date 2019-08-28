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
			Edit Roles
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
<form class="forms-sample" role="form" action="{{url('roles/'.$rolebyid['id'])}}" method="post" name="roles_form" id="roles_form">
	<div class="form-group">
		{{ Form::hidden('_method', 'PUT') }}
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
		<input type = "hidden" name = "cli_id" id="cli_id" value = "{{$clientname['id']}}">

		<h4 class="card-title">Basic</h4>


		<div class="form-group">
			<label for="roles_name">Client Name</label>
			<input type="text" class="form-control" name="client_id" id="client_id" placeholder="Enter Role" value="{{$clientname['name']}}" disabled>
		</div>

		<div class="form-group">
			<label for="roles_name"> Role's Name</label>
			<input type="text" class="form-control" name="roles_name" id="roles_name" placeholder="Enter Role" value="{{ old('roles_name',$rolebyid['rolename'])}}">
		</div>
		<div class="form-group" id="exist">

                    </div>
		<div class="form-group">
			<label for="group">Status</label>
			<select class="form-control" name="status" id="status">
				@if($rolebyid['status']=='Active')
				<option value="Active" selected>Active</option>
				@else
				<option value="Active">Active</option>
				@endif

			</select>
		</div>
		<div class="form-group">
			<label for="group">Group</label>
			<select class="form-control" name="group" id="group">
				@if($rolebyid['status']=='Default')
				<option value="Default" selected>Default</option>
				@else
				<option value="Default">Default</option>
				@endif

			</select>
		</div>
		<div class="form-group">
			<label for="">Default</label>
			<select class="form-control" name="default" id="" >
				@if($rolebyid['default'] =='0')
				<option value="0" selected="">0</option>
				@elseif($rolebyid['default'] =='1')
				<option value="1" selected>1</option>

				@endif

			</select>
		</div>
		<h4 class="card-title">Modules Access
			<a href="javascript:void(0)"><i class="fa fa-chevron-down" id="more" aria-hidden="true"></i>
			</a></h4>

			<div id="message" style="display:none">
				<table id="order-listing" class="table">
					<thead>
						<tr>
							<th>Modules</th>
							<th>Read</th>
							<th>Write</th>
							<th>Admin</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allmodules as $modules)
						<tr>
							<td>{{$modules['features_name']}}</td>
							<td>

								@if(in_array($modules['features_id'],$access['read']))
								<?php $checked = 'checked';?>
								@else
								<?php $checked = '';?>
								@endif
								<div class="form-check form-check-primary">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input"
										name="read_{{$modules['features_id']}}" {{$checked}}><i class="input-helper"></i>
									</label>
								</div>
							</td>

							<td>
								@if(in_array($modules['features_id'],$access['write']))
								<?php $checked = 'checked';?>
								@else
								<?php $checked = '';?>
								@endif
								<div class="form-check form-check-primary">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="write_{{$modules['features_id']}}" {{$checked}}><i class="input-helper"></i>
									</label>
								</div>
							</td>
							<td>
								@if(in_array($modules['features_id'],$access['admin']))
								<?php $checked = 'checked';?>
								@else
								<?php $checked = '';?>
								@endif
								<div class="form-check form-check-primary">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="admin_{{$modules['features_id']}}" {{$checked}}><i class="input-helper"></i>
									</label>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
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
								<th>Admin</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Default</td>
								<td>

									@if($group['admin']=='Default')
									<?php $admincheck = "checked"?>
									@else
									<?php $admincheck = ""?>
									@endif
									@if($group['read']=='Default')
									<?php $readcheck = "checked"?>
									@else
									<?php $readcheck = ""?>
									@endif
									@if($group['write']=='Default')
									<?php $writecheck = "checked"?>
									@else
									<?php $writecheck = ""?>
									@endif

									<div class="form-check form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input"
											name="group_read" {{$readcheck}}><i class="input-helper"></i>
										</label>
									</div>
								</td>

								<td>

									<div class="form-check form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="group_write" {{$writecheck}}><i class="input-helper"></i>
										</label>
									</div>
								</td>
								<td>

									<div class="form-check form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="group_admin" {{$admincheck}}><i class="input-helper"></i>
										</label>
									</div>
								</td>
							</tr>

						</tbody>
					</table>


				</div>

				<button type="submit" class="btn btn-primary mr-2">Update</button>
			</form>
		</div>
	</div>
</div>
</div>
</div>

<script src="{{ asset('js/data-table.js') }}"></script>
<script>
	$(document).ready(function(){
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
             var clientid = $("#cli_id").val();
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
</script>
@endsection