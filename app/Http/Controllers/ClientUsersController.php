<?php

namespace App\Http\Controllers;

use App\Models\campaign;
error_reporting(0);
use App\Models\central_users;
use App\Models\clientlocation_details;
use App\Models\clients;
use App\Models\location_server;
use App\Models\queue;
use Datatables;
use Excel;
use Illuminate\Http\Request;

class ClientUsersController extends Controller {
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function index() {

		if (request()->ajax()) {
			$client_id = session('clientid');
			if ($client_id) {
				$users = central_users::join('clients', 'clients.id', 'users.client_id')->join('location_masters', 'location_masters.id', 'users.location_id')->join('location_servers', 'location_servers.id', 'users.server_id')->select('users.id', 'users.username', 'users.fullname', 'users.email', 'users.status', 'users.usertype', 'clients.name', 'location_masters.location', 'location_servers.server_ip')->where('clients.id', $client_id)->get();
			} else {
				$users = central_users::join('clients', 'clients.id', 'users.client_id')->join('location_masters', 'location_masters.id', 'users.location_id')->join('location_servers', 'location_servers.id', 'users.server_id')->select('users.id', 'users.username', 'users.fullname', 'users.email', 'users.status', 'users.usertype', 'clients.name', 'location_masters.location', 'location_servers.server_ip')->get();
			}

// dd($users);
			return Datatables::of($users)->make(true);
		}

		return view('clientusers.index');
	}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function create() {
		$client_id = session('clientid');
		if (!empty($client_id)) {
			$client_data = clients::where('id', $client_id)->where('status', 1)->get();
		} else {
			$client_data = clients::where('status', 1)->get();
		}
		return view('clientusers.create')->with('client_data', $client_data);
	}

/**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
	public function store(Request $request) {

		$request->validate([
			'clientid' => 'required',
			'locid' => 'required',
			'serverid' => 'required',
			'username' => 'required',
			'password' => 'required',
			'fullname' => 'required',
			'email' => 'required',

		]);
		$data = '{"uservoice":"Active","personal":{"fname":"' . $request->fullname . '","gender":""},"hrmsdata":"b:0;"}';
		$arr = ['client_id' => $request->clientid,
			'location_id' => $request->locid,
			'server_id' => $request->serverid,
			'username' => $request->username,
			'password' => bcrypt(md5($request->password)),
			'fullname' => $request->fullname,
			'email' => $request->email,
			'usertype' => $request->usertype,
			'status' => $request->status,
			'data' => $data];
		$queue_data = [
			'username' => $request->username,
			'password' => bcrypt(md5($request->password)),
			'fullname' => $request->fullname,
			'email' => $request->email,
			'usertype' => $request->usertype,
			'data' => $data,
			'status' => $request->status,
		];
		$jsonData = json_encode($queue_data);
		$clientname = clients::select('name')->where('id', $request->clientid)->first();

		if (!empty($arr)) {
			$create_user = array();
			$create_user = [
				'request' => 'Create User',
				'client_details' => $clientname->name,
				'location_id' => $request->locid,
				'server_id' => $request->serverid,
				'data' => $jsonData,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')];
			queue::insert($create_user);

			central_users::insert($arr);
		}

		return redirect('/users')->with('success', 'Records inserted successfully.');
	}

/**
 * Display the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function show($id) {
		return view('clientusers.edit');
	}

/**
 * Show the form for editing the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function edit($id) {
		$data = central_users::where('users.id', $id)->join('clients', 'clients.id', 'users.client_id')->join('location_masters', 'location_masters.id', 'users.location_id')->join('location_servers', 'location_servers.id', 'users.server_id')->select('users.*', 'clients.name', 'location_masters.location', 'location_servers.server_ip')->first();

		$location = clientlocation_details::where('clientlocation_details.client_id', $data['client_id'])->join('location_masters', 'location_masters.id', 'clientlocation_details.location_master_id')->select('location_masters.location', 'clientlocation_details.location_master_id')->get()->toArray();

		$campaign_data = campaign::select('campaign_name', 'users_id')->where('status', 'Active')->get();
		foreach ($campaign_data as $campaignData) {
			$userids[] = explode(',', $campaignData['users_id']);
		}
		foreach ($userids as $user_ids) {
			$user_exist = in_array($id, $user_ids);

		}
		if ($user_exist) {
			$campaign_data = campaign::select('campaign_name', 'id')->where('status', 'Active')->get();
		} else {
			$campaign_data = "No campaign assigned";
		}
//dd(\Hash::make($data['password']));

		return view('clientusers.edit')->with('data', $data)->with('location', $location)->with('campaign_data', $campaign_data);
	}

/**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function update(Request $request, $id) {

		$clientname = $request->clientid;
		$request->validate([
			'locid' => 'required',
			'serverid' => 'required',
			'username' => 'required',
			'fullname' => 'required',
			'email' => 'required',

		]);
		$previous_val = central_users::where('id', $id)->first();
//dd($previous_val->fullname);
		$data = '{"uservoice":"Active","personal":{"fname":"' . $request->fullname . '","gender":""},"hrmsdata":"b:0;"}';
		$clientname = $request->clientid;
		$arr = ['location_id' => $request->locid,
			'server_id' => $request->serverid,
			'username' => $request->username,
			'fullname' => $request->fullname,
			'email' => $request->email,
			'status' => $request->status,
			'usertype' => $request->usertype,
			'organization' => $request->organisation,
			'group' => $request->group,
			'reports_to' => $request->reports_to,
			'supervisor' => $request->supervisor,
			'numbers' => $request->number,
			'exten' => $request->extension,
			'data' => $data,
			'sel_campaign' => $request->sel_campaign];

		$queue_data = [
			'username' => $request->username,
			'password' => md5($request->password),
			'fullname' => $request->fullname,
			'email' => $request->email,
			'status' => $request->status,
			'usertype' => $request->usertype,
			'organization' => $request->organisation,
			'group' => $request->group,
			'reports_to' => $request->reports_to,
			'supervisor' => $request->supervisor,
			'numbers' => $request->number,
			'exten' => $request->extension,
			'data' => $data,
			'sel_campaign' => $request->sel_campaign,

		];
		$queue_olddata = [
			'username' => $previous_val->username,
			'password' => md5($previous_val->password),
			'fullname' => $previous_val->fullname,
			'email' => $previous_val->email,
			'status' => $previous_val->status,
			'usertype' => $previous_val->usertype,
			'organization' => $previous_val->organisation,
			'group' => $previous_val->group,
			'reports_to' => $previous_val->reports_to,
			'supervisor' => $previous_val->supervisor,
			'numbers' => $previous_val->number,
			'exten' => $previous_val->extension,
			'data' => $previous_val->data,
			'sel_campaign' => $previous_val->sel_campaign,

		];
		$json_data = array('new_data' => $queue_data, 'old_data' => $queue_olddata);
		$jsonData = json_encode($json_data);
//dd($jsonData);
		if (!empty($arr)) {
			$create_user = new queue();
			$create_user->request = 'Edit User';
			$create_user->client_details = $clientname;
			$create_user->location_id = $request->locid;
			$create_user->server_id = $request->serverid;
			$create_user->data = $jsonData;
			$create_user->save();

			central_users::where('id', $id)->update($arr);
		}

		return redirect('/users')->with('success', 'Records updated successfully.');
	}

/**
 * Remove the specified resource from storage.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function destroy($id) {
		central_users::where('id', $id)->delete();
		return 'true';
	}

	public function downloadExcel($type) {
		$data = central_users::get()->toArray();

		return Excel::create('clientusers', function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {

				$sheet->cell('A1', function ($cell) {$cell->setValue('Username');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('Password');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('FullName');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Email');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('UserType');});
				$sheet->fromArray();
			});
		})->download($type);

	}

	public function importExcel(Request $request) {
		$request->validate([
			'import_file' => 'required',
			'client_id' => 'required',
			'loc_id' => 'required',
			'server_id' => 'required',
		]);

//dd($request);

		$path = $request->file('import_file')->getRealPath();
		$data = Excel::load($path)->get();

//dd($data);[]
		//$userarr[];

		if ($data->count()) {
			foreach ($data as $key => $value) {
//echo "<pre>";
				//print_r($value);

				if (($value->username != "") && ($value->password != "") && ($value->fullname != "") && ($value->email != "")) {

					$user = central_users::where('username', '=', $value->username)->exists();
					$useremail = central_users::where('email', '=', $value->email)->exists();
					if ($user || $useremail) {
						$userarr[] = $value->username;
					} else {

//echo "array queue";
						$clientdata = '{"uservoice":"Active","personal":{"fname":"' . $value->fullname . '","gender":""},"hrmsdata":"b:0;"}';
// dd($data);
						$arr[] = ['client_id' => $request->client_id,
							'location_id' => $request->loc_id,
							'server_id' => $request->server_id,
							'username' => $value->username,
							'password' => bcrypt(md5($value->password)),
							'fullname' => $value->fullname,
							'email' => $value->email,
							'usertype' => $value->usertype,
							'status' => $request->status,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')];

						$queueArray[] = array('username' => $value->username, 'password' => bcrypt(md5($value->password)), 'fullname' => $value->fullname, 'email' => $value->email, 'data' => $clientdata, 'status' => $request->status, 'usertype' => $value->usertype);

					}

				}

			}

			$jsonData = json_encode($queueArray);
			$clientname = clients::select('name')->where('id', $request->client_id)->first();
			$create_user[] = [
				'request' => 'Create User',
				'client_details' => $clientname->name,
				'location_id' => $request->loc_id,
				'server_id' => $request->server_id,
				'data' => $jsonData,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')];

			if (!empty($userarr)) {
				$showmsg = implode(',', $userarr);
			} else {
				$showmsg = 'None';
			}
			if (!empty($arr)) {

				queue::insert($create_user);
				central_users::insert($arr);

			}

//exit;
			return back()->with('warning', ' Duplicate entries- ' . $showmsg . ' . Rest uploaded successfully');

		}

	}
	public function listlocationclientwise(Request $request) {

		$locations = clientlocation_details::join('location_masters', 'clientlocation_details.location_master_id', 'location_masters.id')->where('clientlocation_details.client_id', $request->clientid)->select('location_masters.location', 'clientlocation_details.*')->get()->toArray();

		echo json_encode($locations);

	}
	public function listserverlocationwise(Request $request) {
		$servers = clientlocation_details::where('client_id', $request->clientid)->where('location_master_id', $request->loc_id)->where('status', 1)->get()->toArray();
		$serverlist = explode(',', $servers[0]['location_server_id']);
		$allserver = location_server::whereIn('id', $serverlist)->where('status', 1)->get()->toArray();

		echo json_encode($allserver);
	}
	public function clientuserschangestatus($id) {
		$status = central_users::where('id', $id)->select('status', 'client_id', 'location_id', 'server_id', 'username')->first();
		$clientname = clients::where('id', $status->client_id)->select('name')->first();

		if ($status['status'] == 'Active') {
			$arr = ['status' => 'Pending'];
			$arr1 = 'Pending';

		} elseif ($status['status'] == 'Pending') {
			$arr = ['status' => 'Inactive'];
			$arr1 = 'Inactive';

		} elseif ($status['status'] == 'Inactive') {
			$arr = ['status' => 'Active'];
			$arr1 = 'Active';
		}
		$json_data = [
			'username' => $status->username,
			'status' => $arr1];
		$json_val = json_encode($json_data);
		$queue_data = [
			'request' => 'Update User Status',
			'client_details' => $clientname->name,
			'location_id' => $status->location_id,
			'server_id' => $status->server_id,
			'data' => $json_val,
		];
		queue::insert($queue_data);
		central_users::where('id', $id)->update($arr);
		return redirect('/users');
	}

//Rest User Password

	public function resetpassword(Request $request) {

		$password = $request->new_password;
		$password = bcrypt(md5($password));
		$user_details = central_users::where('id', $request->user_id)->select('status', 'client_id', 'location_id', 'server_id', 'username')->first();
		$clientname = clients::where('id', $user_details->client_id)->select('name')->first();
		$json_data = [
			'username' => $user_details->username,
			'password' => $password];
		$json_val = json_encode($json_data);
		$queue_data = [
			'request' => 'Update User Password',
			'client_details' => $clientname->name,
			'location_id' => $user_details->location_id,
			'server_id' => $user_details->server_id,
			'data' => $json_val,
		];
		$update_pass = central_users::where('id', $request->user_id)->update(['password' => $password]);
		$reset_pw = queue::insert($queue_data);

		if ($update_pass && $reset_pw) {
			return redirect('/users')->with('success', 'Password reset successfully.');
		}

	}

	public function reportsto(Request $request) {

		$users = central_users::where('client_id', $request->clientid)->where('id', '!=', $request->userid)->get()->toArray();

		echo json_encode($users);
	}
}