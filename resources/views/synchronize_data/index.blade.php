@extends('dashboard')
@section('content')
<style>
	.flip {
		padding: 5px;
		text-align: center;
		background-color: #c0bac6;
		border: solid 1px #6f5f7f;
	}
	.panel {
		padding: 50px;
		display: none;
		border: solid 1px #6f5f7f;
	}
	div#panel_clientuser select {
		display: inline;
	}
	table.dataTable {
		width: 100% !important;

	}
	div.dataTables_wrapper div.dataTables_paginate ul.pagination {
		margin: 2px 0;
		margin-right: 30px;
		white-space: nowrap;
		justify-content: flex-end;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
		Data Synchronization</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Synchronization of Data</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				@include('message')
				<div class="card-body">
					<!-- <h4 class="card-title">Data table</h4> -->
					<form method="post" action="{{ url('') }}">
						<div class="row">
							<div class="col-12">
								<div class="card-body">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Paused Data</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Pending Data</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Completed Data</a>
										</li>
									</ul>
									<div class="tab-content">



										<!-- first tab -->

										<div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
											<div class="btn-group" id="button-data" style="position: relative;left: 72%;bottom: 15px;">

												<button type="button" id="syncData" class="btn sbold red" style="position: relative;right: 12px;">Sync Data</button>

												<button type="button" id="revertData" class="btn btn-waring">Revert Change</button>

											</div>
											<div class="media">

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
																<th>Request Action</th>
																<th>Location</th>
																<th>Location Server</th>
																<th>Priority</th>
																<th>Remark</th>
																<th>View</th>
															</tr>
														</thead>
													</table>
												</div>
											</div>
										</div>

										<!-- end of first tab -->
										<!-- second tab -->


										<div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
											<div class="media">
												<div class="table-responsive">
													<table id="example3" class="table">
														<thead>
															<tr>
																<th>
																	<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																		<input type="checkbox" id="ckbCheckAll" class="group-checkable"
																		data-set="#sample_1 .checkboxes"/><span></span>
																	</label>
																</th>
																<th>Client Name</th>
																<th>Request Action</th>
																<th>Location</th>
																<th>Location Server</th>
																<th>Remark</th>
																<th>View</th>
															</tr>
														</thead>
													</table>
												</div>
											</div>
										</div>

										<!-- end of second tab -->
										<!-- third tab -->
										<div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
											<div class="media">
												<div class="table-responsive">
													<table id="example4" class="table">
														<thead>
															<tr>
																<th>
																	<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																		<input type="checkbox" id="ckbCheckAll" class="group-checkable"
																		data-set="#sample_1 .checkboxes"/><span></span>
																	</label>
																</th>
																<th>Client Name</th>
																<th>Request Action</th>
																<th>Location</th>
																<th>Location Server</th>
																<th>Remark</th>
																<th>View</th>
															</tr>
														</thead>
													</table>
												</div>
											</div>
										</div>

										<!-- end of third tab -->
									</div> <!-- tab-content -->
								</div><!-- card-body -->
							</div><!-- col-12 -->
						</div><!-- row -->

					</form>
				</div><!-- card-body -->
			</div><!-- card -->
		</div><!-- row -->
	</div><!-- content-wrapper -->
	<!-- modal body -->
	<!-- closed modal body -->
</div>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('js/tabs.js')}}"></script>
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
		pendingtable = $('#example3').DataTable({
			"paging": true,
			"ordering": true,
			"info": true,
			"lengthMenu": [[2, 5, 15, 25, -1], [2, 5, 15, 25, "All"]],
			"pageLength": 5,
			"processing": true,
			"serverSide": true,
			"destroy": true,
			"ajax": {"url": "{{ URL::to('/synchronization?status=pending')}}"},

			columnDefs: [
			{"orderable": false, "targets":[0]},
			{"orderable": true, "targets": [1]},
			{"orderable": true, "targets": [2]},
			{"orderable": true, "targets": [3]},
			{"orderable": true, "targets": [4]},
			{"orderable": true, "targets": [5]},
			{"orderable": false, "targets":[6]},
			],
			columns: [
			{"data": "id"},
			{"data": "client_details"},
			{"data": "request"},
			{"data": "location"},
			{"data": "server_ip"},
			{"data": "remark"},
			{"data": "id"},
			],
			"rowCallback": function (row, data, index) {
				$('td:eq(0)', row).html(
					'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
					'<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass" value="' + data.id + '" />' +
					'<span></span>' +
					'</label>'
					);
				if(data.remark)
				{
					var remark_val=data.remark;
					if(remark_val.length >8){
						result =  remark_val.slice(0, 10);
						$('td:eq(5)',row).html(
							'<span>'+ result+'...<a href="synchronizationview/'+data.id+'">View more	</a>'+'<span/>'

							);
					}
					else
					{
						$('td:eq(5)',row).text(
							remark_val
							);

					}
				}
				$('td:last-of-type', row).html(
					' <a type="button" id="viewdata' + data.id + '" title="View" data-id=' + data.id + ' class="btn btn-icon-only blue view_data" href="synchronizationview/'+data.id+'"><i class="fa fa-eye"></i></a>'
					);
			},

		});

    //	var complete_url = "{{ URL::to('//synchronization?status=completed')}}";
    completetable = $('#example4').DataTable({
    	"paging": true,
    	"ordering": true,
    	"info": true,
    	"lengthMenu": [[2, 5, 15, 25, -1], [2, 5, 15, 25, "All"]],
    	"pageLength": 5,
    	"processing": true,
    	"serverSide": true,
    	"destroy": true,
    	"ajax": {"url": "{{ URL::to('/synchronization?status=completed')}}"},

    	columnDefs: [
    	{"orderable": false, "targets":[0]},
    	{"orderable": true, "targets": [1]},
    	{"orderable": true, "targets": [2]},
    	{"orderable": true, "targets": [3]},
    	{"orderable": true, "targets": [4]},
    	{"orderable": true, "targets": [5]},
    	{"orderable": false, "targets":[6]},
    	],
    	columns: [
    	{"data": "id"},
    	{"data": "client_details"},
    	{"data": "request"},
    	{"data": "location"},
    	{"data": "server_ip"},
    	{"data": "remark"},
    	{"data": "id"},
    	],
    	"rowCallback": function (row, data, index) {
    		$('td:eq(0)', row).html(
    			'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
    			'<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass" value="' + data.id + '" />' +
    			'<span></span>' +
    			'</label>'
    			);
    		if(data.remark)
    		{
    			var remark_val=data.remark;
    			if(remark_val.length >8){
    				result =  remark_val.slice(0, 10);
    				$('td:eq(5)',row).html(
    					'<span>'+ result+'...<a href="synchronizationview/'+data.id+'">View more	</a>'+'<span/>'

    					);
    			}
    			else
    			{
    				$('td:eq(5)',row).text(
    					remark_val
    					);

    			}
    		}

    		$('td:last-of-type', row).html(
    			' <a type="button" id="viewdata' + data.id + '" title="View" data-id=' + data.id + ' class="btn btn-icon-only blue view_data" href="synchronizationview/'+data.id+'"><i class="fa fa-eye"></i></a>'
    			);
    	},
    });
});


window.onload = function() {
	var url = "{{ URL::to('/synchronization?status=paused')}}";
	var table = $('#example2').DataTable({
		"paging": true,
		"ordering": true,
		"dom": 'Bfrtip',
		buttons: [
		'selected',
		'selectAll',
		'selectNone',
		'selectRows',
		'selectColumns',
		'selectCells'
		],
		"select": true,
		"info": true,
		"lengthMenu": [[2, 5, 15, 25, -1], [2, 5, 15, 25, "All"]],
		"pageLength": 5,
		"processing": true,
		"serverSide": true,
		"destroy": true,
		"ajax": {"url": url},

		columnDefs: [
		{"orderable": false,"targets": [0]},
		{"orderable": true, "targets": [1]},
		{"orderable": true, "targets": [2]},
		{"orderable": true, "targets": [3]},
		{"orderable": true, "targets": [4]},
		{"orderable": true, "targets": [5]},
		{"orderable": true, "targets": [6]},
		{"orderable": false, "targets":[7]},
		],
		columns: [
		{"data": "id"},
		{"data": "client_details"},
		{"data": "request"},
		{"data": "location"},
		{"data": "server_ip"},
		{"data": "id"},
		{"data": "remark"},
		{"data": "id"},
		],
		"rowCallback": function (row, data, index) {
			$('td:eq(0)', row).html(
				'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
				'<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass" value="' + data.id + '" />' +
				'<span></span>' +
				'</label>'
				);

			if(data.remark)
			{
				var remark_val=data.remark;
				if(remark_val.length >8){
					result =  remark_val.slice(0, 10);
					$('td:eq(6)',row).html(
						'<span>'+ result+'...<a href="synchronizationview/'+data.id+'">View more	</a>'+'<span/>'

						);
				}
				else
				{
					$('td:eq(6)',row).text(
						remark_val
						);

				}
			}

			$('td:eq(5)', row).html(
				'<select name="priorityname" id="get_priority" class="getPriority"><option value="'+data.id+'-0">0</option><option value="'+data.id+'-1">1</option><option value="'+data.id+'-2">2</option><option value="'+data.id+'-3">3</option><option value="'+data.id+'-4">4</option><option value="'+data.id+'-4">4</option><option value="'+data.id+'-6">6</option><option value="'+data.id+'-7">7</option>value="'+data.id+'-8">8</option><option value="'+data.id+'-9">9</option></select>'
				);
			$('td:last-of-type', row).html(
				' <a type="button" id="viewdata' + data.id + '" title="View" data-id=' + data.id + ' class="btn btn-icon-only blue view_data" href="synchronizationview/'+data.id+'"><i class="fa fa-eye"></i></a>'
				);
		},
	});
}


$('#home-tab').click(function(event) {
// $('#example2').empty();

var url = "{{ URL::to('/synchronization?status=paused')}}";
var table = $('#example2').DataTable({
	"paging": true,
	"ordering": true,
	"info": true,
	"lengthMenu": [[2, 5, 15, 25, -1], [2, 5, 15, 25, "All"]],
	"pageLength": 5,
	"processing": true,
	"serverSide": true,
	"destroy": true,
	"ajax": {"url": url},

	columnDefs: [
	{"orderable": false,"targets": [0]},
	{"orderable": true, "targets": [1]},
	{"orderable": true, "targets": [2]},
	{"orderable": true, "targets": [3]},
	{"orderable": true, "targets": [4]},
	{"orderable": true, "targets": [5]},
	{"orderable": true, "targets": [6]},
	{"orderable": false, "targets":[7]},
	],
	columns: [
	{"data": "id"},
	{"data": "client_details"},
	{"data": "request"},
	{"data": "location"},
	{"data": "server_ip"},
	{"data": "id"},
	{"data": "remark"},
	{"data": "id"},
	],
	"rowCallback": function (row, data, index) {
		$('td:eq(0)', row).html(
			'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">' +
			'<input type="checkbox" class="checkboxes set_checkbox_atr checkBoxClass" value="' + data.id + '" />' +
			'<span></span>' +
			'</label>'
			);
		$('td:eq(5)', row).html(
			'<select name="priorityname" id="get_priority" class="getPriority"><option value="'+data.id+'-0">0</option><option value="'+data.id+'-1">1</option><option value="'+data.id+'-2">2</option><option value="'+data.id+'-3">3</option><option value="'+data.id+'-4">4</option><option value="'+data.id+'-4">4</option><option value="'+data.id+'-6">6</option><option value="'+data.id+'-7">7</option>value="'+data.id+'-8">8</option><option value="'+data.id+'-9">9</option></select>'
			);

		if(data.remark)
		{
			var remark_val=data.remark;
			if(remark_val.length >8){
				result =  remark_val.slice(0, 10);
				$('td:eq(6)',row).html(
					'<span>'+ result+'...<a href="synchronizationview/'+data.id+'">View more	</a>'+'<span/>'

					);
			}
			else
			{
				$('td:eq(6)',row).text(
					remark_val
					);

			}
		}

		$('td:last-of-type', row).html(
			' <a type="button" id="viewdata' + data.id + '" title="View" data-id=' + data.id + ' class="btn btn-icon-only blue view_data" href="synchronizationview/'+data.id+'"><i class="fa fa-eye"></i></a>'
			);
	},
});
});


$('#profile-tab').click(function(event) {
	setTimeout(function(){
	},2000);
});




$('#contact-tab').click(function(event) {

	setTimeout(function(){

	},2000);


});
$(document).ready(function($) {
	$('.getPriority').change(function(event) {
		var data=$(this).val();
		var url="{{ URL::to('/prioritychange')}}";
		$.ajax({
			url: url,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: 'data=' + data
		})
	});
});
$('#syncData').on('click', function (e) {
// alert('sdxcdc');
var allVals = [];
$(".checkboxes:checked").each(function () {
	allVals.push($(this).val());
});
if (allVals.length <= 0) {
	alert("Please select row.");
} else {
	var check = confirm("Are you sure you want to sync data?");
	if (check == true) {
//var join_selected_values = allVals.join(",");
var url = "{{ URL::to('/syncdata')}}";
var status_data;
//alert(join_selected_values);
$.ajax({
	url: url,
	type: 'POST',
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	data: 'ids=' + allVals,
	success: function(result){
		var status_data=JSON.parse(result);
		setStatus(status_data);
	}

});
}
function setStatus(statusData)
{
if(statusData == "pending")
{
	pendingtable.ajax.reload(null,false);
	$("#profile-tab").trigger('click');
	var complete_status;
	completeData=setInterval(function(){
		$.ajax({
			url: "{{ URL::to('/synchronization/changestate')}}",
			type: 'GET',
			success:function(result)
			{
				//console.log(result);
				complete_status = $.parseJSON(result);
				//alert(complete_status.status);
				setCompleteStatus(complete_status);

			}

		});
	},40000)
}
}
function setCompleteStatus(complete_status)
{
if(complete_status.status=='completed')
{
       // var remark=complete_status.remark;
       // var remark = complete_status.remark.split('-')[0];
       alert("Successfully processed")
       completetable.ajax.reload(null,false);
       $("#contact-tab").trigger('click');
       clearInterval(completeData);

   }else if(complete_status.status=='pending' && complete_status.remark != '')
   {
   	alert(complete_status.remark);
   	clearInterval(completeData);

   }
}

//location.reload()
}
});
$('#revertData').on('click', function (e) {
// alert('sdxcdc');
var allVals = [];
$(".checkboxes:checked").each(function () {
	allVals.push($(this).val());
});
if (allVals.length <= 0) {
	alert("Please select row.");
} else {
	var check = confirm("Are you sure you want to revert changes?");
	if (check == true) {
//var join_selected_values = allVals.join(",");
var url = "{{ URL::to('/revertdata')}}";
var status_revertdata;
//alert(join_selected_values);
$.ajax({

	url: url,
	type: 'POST',
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	data: 'ids=' + allVals,
	success: function(result){
		status_revertdata=JSON.parse(result);
		setTimeout(function(){
			if(status_revertdata == 'revert')
			{
				alert('Successfully processed');
				location.reload();
			}

		},5000);
	}

});
}


}
});

</script>
@endsection