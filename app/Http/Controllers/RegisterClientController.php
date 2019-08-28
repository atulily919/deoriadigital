<?php

namespace App\Http\Controllers;

use App\Models\assign_role_privilege;
use App\Models\clients;
use App\User;
use Datatables;
error_reporting(0);
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterClientController extends Controller {
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function index() {

		$data = User::where('admin_status', '0')->get()->toArray();

		foreach ($data as $clientdata) {
			$array[$clientdata['id']]['id'] = $clientdata['id'];
			$array[$clientdata['id']]['clientid'] = $clientdata['client_id'];
			$array[$clientdata['id']]['email'] = $clientdata['email'];
			$array[$clientdata['id']]['name'] = $clientdata['name'];
			$array[$clientdata['id']]['status'] = $clientdata['Status'];
		}

		foreach ($array as $key => $value) {
			if (!empty($value['clientid'])) {
				$arr = $value['clientid'];
				$client = DB::select(" SELECT name FROM clients WHERE id IN(" . $arr . ")");
				foreach ($client as $clientname) {
					$array[$key]['clientname'] .= $clientname->name . ",";
				}
			} else {
				$array[$key]['clientname'] = '-----';
			}

		}
//dd($array[$clientdata['id']]['clientid']);

		if (request()->ajax()) {
			return Datatables::of($array)->make(true);
		}
		return view('centralclient_registration.index');

	}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function create() {

		$client_data = clients::where('status', '1')->get();

		return view('centralclient_registration.create', compact('client_data'));
	}

/**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
	public function store(Request $request) {
// dd($request->all());
		$request->validate([
			'name' => 'required', 'string', 'max:255',
			'email' => 'required', 'string', 'email', 'max:255', 'unique:central_users',
			'password' => 'required', 'string', 'min:6', 'confirmed',

		]);
		$reg_val = array();
// dd($request->assign_role);
		if (!empty($request->avbl_roles)) {

			foreach ($request->avbl_roles as $key => $assign_role) {
				$assignRole[$key] = explode('-', $assign_role);
			}
			$count = count($assignRole);
			for ($i = 0; $i < $count; $i++) {
				$j = $i + 1;
				if ($assignRole[$i][1] == $assignRole[$j][1]) {
					return Redirect::back()->with(['error', 'You can not select multiple roles of same Client']);
				} else {
					$data['roles_id'] = $assignRole[$i][0];
					$data['clientid'] = $assignRole[$i][1];
					$client_roledata[] = array('clientid' => $data['clientid'], 'roleid' => $data['roles_id']);
				}
			}
			$reg_val['assign_roles'] = json_encode($client_roledata);
			$reg_val['client_id'] = implode(',', $request->client_id);
			$reg_val['name'] = $request->name;
			$reg_val['email'] = $request->email;
			$reg_val['password'] = Hash::make($request->password);

			DB::table('central_users')->insert($reg_val);

			return redirect('/home')->with('success', 'Central Client Create Successfully');

		} else {
			User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'client_id' => implode(',', $request->client_id),
			]);
			return redirect('/home')->with('success', 'Central Client Create Successfully');

		}
	}

/**
 * Display the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function show($id) {

	}

/**
 * Show the form for editing the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function edit($id) {
//dd($id);

		$usersdata = User::where('id', $id)->first();
		$uservalue = explode(',', $usersdata->client_id);
		$userselectedrole = json_decode($usersdata->assign_roles);
// dd($userselectedrole);
		$clientname = clients::get();
// dd($uservalue);
		$rolename = assign_role_privilege::whereIn('client_id', $uservalue)->groupBy('roles_id', 'client_id')->join('clients', 'clients.id', 'assign_role_privileges.client_id')->join('system_roles', 'assign_role_privileges.roles_id', 'system_roles.id')->select('assign_role_privileges.*', 'clients.name', 'system_roles.rolename')->get()->toArray();
		$json_val = json_decode($usersdata->assign_roles);
		foreach ($json_val as $jsonVal) {
			$roleid[$jsonVal->clientid] = $jsonVal->roleid;
		}

		$arraycheck = [];

		foreach ($roleid as $clientid => $rolesid) {
			$arraycheck[$clientid] = assign_role_privilege::where('client_id', $clientid)->where('roles_id', '!=', $rolesid)->where('status', 'Active')->groupby('roles_id')->get()->toArray();

		}
// dd($arraycheck);
		foreach ($roleid as $key => $client_id) {
			$client_name = clients::select('name')->where('id', $key)->first();

			$selectedrole[$client_name->name][] = DB::select("select rs.roles_id,rs.id,ra.rolename,rs.status,rs.client_id from assign_role_privileges rs left JOIN system_roles ra on rs.roles_id = ra.id WHERE rs.client_id= " . $key . " GROUP BY rs.roles_id");
		}

//dd($data);

		return view('centralclient_registration.edit')->with('usersdata', $usersdata)->with('clientname', $clientname)->with('uservalue', $uservalue)->with('roledata', $roleid)->with('selectedrole', $selectedrole)->with('userselectedrole', $userselectedrole);

	}

/**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function update(Request $request, $id) {
// dd($id);

		$request->validate([
			'name' => 'required', 'string', 'max:255',
			'email' => 'required', 'string', 'email', 'max:255', 'unique:central_users',

		]);
		$reg_val = array();
// dd($request->assign_role);
		if (!empty($request->avbl_roles)) {

			foreach ($request->avbl_roles as $key => $assign_role) {
				$assignRole[$key] = explode('-', $assign_role);
			}
			$count = count($assignRole);
			for ($i = 0; $i < $count; $i++) {
				$j = $i + 1;
				if ($assignRole[$i][1] == $assignRole[$j][1]) {
					return Redirect::back()->with(['error', 'You can not select multiple roles of same Client']);
				} else {
					$data['roles_id'] = $assignRole[$i][0];
					$data['clientid'] = $assignRole[$i][1];
					$client_roledata[] = array('clientid' => $data['clientid'], 'roleid' => $data['roles_id']);
				}
			}
			$reg_val['assign_roles'] = json_encode($client_roledata);
			$reg_val['client_id'] = implode(',', $request->client_id);
			$reg_val['name'] = $request->name;
			$reg_val['email'] = $request->email;

			DB::table('central_users')->where('id', $id)->update($reg_val);

			return redirect('/registration')->with('success', 'Central Client Updated Successfully');

		} else {
			User::where('id', $id)->update([
				'name' => $request->name,
				'email' => $request->email,
				'client_id' => implode(',', $request->client_id),
				'assign_roles' => NULL,
			]);
			return redirect('/registration')->with('success', 'Central Client Updated Successfully');

		}

	}

/**
 * Remove the specified resource from storage.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function destroy($id) {
		User::where('id', $id)->delete();
		return 'true';
	}

	public function clientroles(Request $request, $clientid) {
		$clientId = $request->clientid;

		$clientID = explode(',', $clientId);
		foreach ($clientID as $key => $client_id) {
			$client_name = clients::select('name')->where('id', $client_id)->first();

			$data[$client_name->name][] = DB::select("select rs.roles_id,rs.id,ra.rolename,rs.status,rs.client_id from assign_role_privileges rs left JOIN system_roles ra on rs.roles_id = ra.id WHERE rs.client_id= " . $client_id . " GROUP BY rs.roles_id");
		}
// $data[] = collect($query);
		//dd($data);

		echo json_encode($data);

	}
	public function editclientroles(Request $request, $clientid) {
// dd($request);
		$clientId = $request->clientid;

		$usersdata = User::where('id', $request->editid)->first();

		$json_val = json_decode($usersdata->assign_roles);
		$req = array();
		foreach ($clientId as $cli) {
			foreach ($json_val as $jsonVal) {
				if ($cli == $jsonVal->clientid) {
					$roleid[$cli][] = $jsonVal->roleid;
				} else {
					$roleid[$cli][] = "";

				}

			}
		}
		$array = array_map('array_filter', $roleid);

		foreach ($array as $client_id => $rolesid) {
			if (empty($rolesid)) {
				$rolesid = '';
			}

			$arraycheck[$client_id] = assign_role_privilege::where('assign_role_privileges.client_id', $client_id)->where('assign_role_privileges.roles_id', '!=', $rolesid)->where('assign_role_privileges.status', 'Active')->groupby('roles_id')->join('clients', 'clients.id', 'assign_role_privileges.client_id')->join('system_roles', 'assign_role_privileges.roles_id', 'system_roles.id')->select('assign_role_privileges.*', 'clients.name', 'system_roles.rolename')->get()->toArray();

		}

//dd($clientId);
		foreach ($clientId as $key => $client_id) {
			$client_name = clients::select('name')->where('id', $client_id)->first();

			$data[$client_name->name][] = DB::select("select rs.roles_id,rs.id,ra.rolename,rs.status,rs.client_id from assign_role_privileges rs left JOIN system_roles ra on rs.roles_id = ra.id WHERE rs.client_id= " . $client_id . " GROUP BY rs.roles_id");
		}
// $data[] = collect($query);
		//dd($data);
		$senddata['unsel'] = $arraycheck;
		$senddata['data'] = $data;

		echo json_encode($senddata);

	}
	public function changestatus($id) {
		$getstatus = User::select('status')->where('id', $id)->first();

		if ($getstatus['status'] == 'Active') {
			$arr = ['status' => 'Inactive'];

		} else if ($getstatus['status'] == 'Inactive') {
			$arr = ['status' => 'Active'];
		}
		User::where('id', $id)->update($arr);
		return redirect('/registration');
	}

}