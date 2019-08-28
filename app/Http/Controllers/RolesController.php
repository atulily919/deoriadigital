<?php

namespace App\Http\Controllers;
//error_reporting(0);
use App\Models\clientfeatures;
use App\Models\clientlocation_details;
use App\Models\clients;
use App\Models\feature;
use App\Models\location_server;
use App\Models\queue;
use App\Models\roles;
use Config;
use Datatables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		if (request()->ajax()) {

			$allroles = roles::join('clients', 'clients.id', '=', 'roles.client_id')->select('roles.*', 'clients.name')->get();
			// dd($allroles);
			return Datatables::of($allroles)->make(true);
		}
		return view('roles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$allclients = clients::where('status', '1')->get();
		$allmodules = feature::where('status', '1')->get();
		return view('roles.create')->with('allmodules', $allmodules)->with('client_data', $allclients);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		//dd($request->all());
		$modulerights['read'] = $modulerights['write'] = $modulerights['admin'] = array();
		$grouprights['read'] = $grouprights['write'] = $grouprights['admin'] = array();
		foreach ($_POST as $key => $value) {
			if (strpos($key, 'read_') === 0) {
				// value starts with read

				$readvalues = str_replace('_', '', strstr($key, '_'));
				array_push($modulerights['read'], $readvalues);
			} else if (strpos($key, 'write_') === 0) {
				$writevalues = str_replace('_', '', strstr($key, '_'));
				array_push($modulerights['write'], $writevalues);
			} else if (strpos($key, 'admin_') === 0) {
				$adminvalues = str_replace('_', '', strstr($key, '_'));
				array_push($modulerights['admin'], $adminvalues);
			} else if (strpos($key, 'group_') === 0) {
				$key == 'group_read' ? $grouprights['read'] = 'Default' : '';
				$key == 'group_write' ? $grouprights['write'] = 'Default' : '';
				$key == 'group_admin' ? $grouprights['admin'] = 'Default' : '';

			}

		}
		$group_permission = json_encode($grouprights);
		$module_permission = json_encode($modulerights);
		$features_id = array_unique(array_merge($modulerights['read'], $modulerights['write'], $modulerights['admin']));
		$features_data = collect(feature::whereIn("id", $features_id)->get())->keyBy("id");
		if (roles::where('client_id', '=', $request->client_id)->where('rolename', '=', $request->roles_name)->exists()) {
			$message = 'Role already present';
			$type = 'warning';

		} else {

			$roles = new roles;
			$roles->client_id = $request->client_id;
			$roles->rolename = $request->roles_name;
			$roles->status = $request->status;
			$roles->module_permission = $module_permission;
			$roles->group_permission = $group_permission;
			$roles->default = $request->default;
			$roles->group = $request->group;
			$roles->rolegroup = 'Default';
			$roles->created_at = date('Y-m-d H:i:s');
			$roles->updated_at = date('Y-m-d H:i:s');
			$clientName = clients::select('name')->where('id', $request->client_id)->first();
			$arr_data = [
				'rolename' => $request->roles_name,
				'status' => $request->roles_name,
				'module_permission' => $module_permission,
				'group_permission' => $group_permission,
				'default' => $request->default,
				'group' => $request->group,
				'rolegroup' => 'Default'];

			$json_val = json_encode($arr_data);
			$queue_data = ['request' => 'Create Role',
				'client_details' => $clientName->name,
				'data' => $json_val,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')];
			//dd($queue_data);
			queue::insert($queue_data);
			$roles->save();

			$message = 'Role Added succesfully';
			$type = 'success';

		}

		return redirect('/roles')->with($type, $message);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function showeditroles($id, $clientid) {
		$rolebyid = roles::where('id', $id)->first()->toArray();
		$moduleaccess = json_decode($rolebyid['module_permission']);
		$access['read'] = $access['write'] = $access['admin'] = array();
		$group['read'] = $group['write'] = $group['admin'] = array();
		$groupaccess = json_decode($rolebyid['group_permission']);
		$clientname = clients::where('id', $clientid)->select('id', 'name')->where('status', '1')->first()->toArray();

		$allmodules = clientfeatures::join('features', 'clientfeatures_details.features_id', '=', 'features.id')->where('clientfeatures_details.client_id', $clientid)
			->where('clientfeatures_details.status', '1')
			->select('clientfeatures_details.client_id', 'clientfeatures_details.features_id', 'features.features_name')
			->get()->toArray();

		foreach ($moduleaccess->read as $read) {
			array_push($access['read'], $read);
		}
		foreach ($moduleaccess->write as $write) {
			array_push($access['write'], $write);
		}
		foreach ($moduleaccess->admin as $admin) {
			array_push($access['admin'], $admin);
		}

		if (!empty($groupaccess->admin)) {
			$group['admin'] = 'Default';
		}
		if (!empty($groupaccess->read)) {
			$group['read'] = 'Default';
		}
		if (!empty($groupaccess->write)) {
			$group['write'] = 'Default';
		}

		return view('roles.edit')->with('rolebyid', $rolebyid)->with('access', $access)->with('allmodules', $allmodules)->with('group', $group)->with('clientname', $clientname);
	}
	public function show($id) {

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		//dd($request);
		// dd($request);
		$modulerights['read'] = $modulerights['write'] = $modulerights['admin'] = array();
		$grouprights['read'] = $grouprights['write'] = $grouprights['admin'] = array();
		foreach ($_POST as $key => $value) {
			if (strpos($key, 'read_') === 0) {
				// value starts with read

				$readvalues = str_replace('_', '', strstr($key, '_'));
				array_push($modulerights['read'], $readvalues);
			} else if (strpos($key, 'write_') === 0) {
				$writevalues = str_replace('_', '', strstr($key, '_'));
				array_push($modulerights['write'], $writevalues);
			} else if (strpos($key, 'admin_') === 0) {
				$adminvalues = str_replace('_', '', strstr($key, '_'));
				array_push($modulerights['admin'], $adminvalues);
			} else if (strpos($key, 'group_') === 0) {
				$key == 'group_read' ? $grouprights['read'] = 'Default' : '';
				$key == 'group_write' ? $grouprights['write'] = 'Default' : '';
				$key == 'group_admin' ? $grouprights['admin'] = 'Default' : '';

			}

		}
		//dd($grouprights);
		$group_permission = json_encode($grouprights);
		$module_permission = json_encode($modulerights);
		$previous_role = roles::where('id', $id)->first();
		//dd($previous_role);
		$role_olddata = [
			'role_name' => $previous_role->rolename,
			'module_permission' =>  $previous_role->module_permission,
			'group_permission' =>  $previous_role->group_permission,
			'status' => $previous_role->status,
			'rolegroup' => $previous_role->rolegroup,
		    'default' => $previous_role->default,
			'group' => $previous_role->group];
		try {
			// dd($request);

			$clientName = clients::select('name')->where('id', $request->cli_id)->first();
			$updatecolumns = ["rolename" => $request->roles_name,
				"rolegroup" => 'Default',
				"status" => $request->status,
				"module_permission" => $module_permission,
				"group_permission" => $group_permission,
				"default" => $request->default,
				"group" => $request->group];


		$json_data = array('new_data' => $updatecolumns, 'old_data' => $role_olddata);
		$jsonData = json_encode($json_data);
		//dd($jsonData);
			$json_val = json_encode($updatecolumns);
			$queue_data = ['request' => 'Edit Role',
				'client_details' => $clientName->name,
				'data' => $jsonData,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')];
			
			queue::insert($queue_data);
			roles::where('id', $id)->update($updatecolumns);
			
			$message = 'Role edited succesfully';
			$type = 'success';

		} catch (Exception $ex) {
			dd($ex);
		}

		return redirect('/roles')->with($type, $message);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//dd('aaya');
		roles::where('id', $id)->delete();
		return 'true';
	}
	public function roleschangestatus($id) {
		$getstatus = roles::select('status')->where('id', $id)->first();
		if ($getstatus['status'] == 'Active') {
			$arr = ['status' => 'Inactive'];

		} else if ($getstatus['status'] == 'Inactive') {
			$arr = ['status' => 'Active'];
		}
		roles::where('id', $id)->update($arr);
		return redirect('/roles');

	}
	public function listfeaturesclientwise(Request $request) {
		$getfeatures = clientfeatures::join('features', 'clientfeatures_details.features_id', '=', 'features.id')->where('clientfeatures_details.client_id', $request->clientid)
			->where('clientfeatures_details.status', '1')
			->select('clientfeatures_details.client_id', 'clientfeatures_details.features_id', 'features.features_name')
			->get()->toArray();

		echo json_encode($getfeatures);

	}

	public function pushrole(Request $request) {
		$rolesdata = roles::all();
		foreach ($rolesdata as $role_data) {
			$client_locations = clientlocation_details::where('client_id', $role_data->client_id)->get();
			foreach ($client_locations as $clientlogin) {
				//dd($clientlogin);
				$server_data = $clientlogin->location_server_id;
				if (!empty($server_data)) {
					$serverdata_array = explode(',', $server_data);
					$server_details = location_server::whereIn('id', $serverdata_array)->get();
					//print_r($server_details);
					foreach ($server_details as $serverDetails) {
						$decrypted = Crypt::decryptString($serverDetails->login_credentials);
						//print_r($decrypted);die;
						$decrypted = str_replace("'", '', $decrypted);
						$loginvalue = json_decode($decrypted);
						$config = Config::set("database.connections.mysql_ext", [
							'driver' => 'mysql',
							'host' => $loginvalue->hostname,
							'database' => $loginvalue->dbname,
							'username' => $loginvalue->username,
							'password' => $loginvalue->dbpassword,
							'charset' => 'utf8mb4',
							'collation' => 'utf8mb4_unicode_ci',
							'prefix' => '',
							'options' => ['mode' => 'ssl'],
							'strict' => false,
							'engine' => null,
						]);

						echo "hello";
						$news = \DB::connection('mysql_ext')->select("SELECT * FROM roles");
						dd($news);
					}
				} else {
					echo 'dcdc';
				}
			}

		}
		die;

	}

	public function checkduplicaterole(Request $request)
	{
		//dd($request);
		$ifexists=roles::where('rolename',$request->roles_name)->where('client_id',$request->clientid)->get()->toArray();

	//	dd($request->clientid);

		echo json_encode($ifexists);
	}

}
