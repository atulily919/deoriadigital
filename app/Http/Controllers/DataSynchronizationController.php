<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Models\central_users;
use App\Models\feature;
use App\Models\location_master;
use App\Models\location_server;
use App\Models\queue;
use Datatables;
use Illuminate\Http\Request;

class DataSynchronizationController extends Controller {

	public function index(Request $request) {
		$status = $request->input('status');

		if (request()->ajax()) {

			$clientdata = queue::Leftjoin('location_masters', 'location_masters.id', 'queues.location_id')->Leftjoin('location_servers', 'location_servers.id', 'queues.server_id')->select('queues.*', 'location_masters.location', 'location_servers.server_ip')->where('queues.status', $status)->orderBy('id', 'DESC')->get();
			return Datatables::of($clientdata)->make(true);
		}

		return view('synchronize_data.index');
	}

	public function syncdata(Request $request) {
		//dd($request->all());
		$ids = $request->all();
		$data_val = implode(',', $ids);
		$string_val = str_replace(",", " ", $data_val);
		$array_val = explode(' ', $string_val);
		$update_status = queue::whereIn('id', $array_val)->where('status', 'paused')->update(['status' => 'pending', 'updated_at' => date('Y-m-d H:i:s')]);
		$data = 'pending';
		if ($update_status) {
			echo json_encode($data);
		}
	}

	//get current status of current updated time
	public function changestate(Request $request) {
		$data = queue::orderBy('updated_at', 'DESC')->select('status', 'remark')->first();
		//$data = $get_currentData->status;
		if ($data) {
			echo json_encode($data);
		}

	}

	//Change status from pending to paused and failed
	public function changependingstatus(Request $request) {
		$update_status = queue::where('id', $request->queueid)->update(['status' => $request->status]);
		if ($update_status) {
			return '1';
		}
	}
	public function prioritychange(Request $request) {
		$data = $request->all();
		$data_val = implode('-', $data);
		$string_val = str_replace("-", " ", $data_val);
		$array_val = explode(' ', $string_val);
		$update = queue::where('id', $array_val[0])->update(['priority' => $array_val[1]]);
		if ($update) {
			return '1';
		}
	}

	public function revertdata(Request $request) {
		$ids = $request->all();
		$data_val = implode(',', $ids);
		$string_val = str_replace(",", " ", $data_val);
		$array_val = explode(' ', $string_val);
		$update_status = queue::whereIn('id', $array_val)->where('status', 'paused')->update(['status' => 'revert', 'updated_at' => date('Y-m-d H:i:s')]);
		$data = 'revert';
		if ($update_status) {
			echo json_encode($data);
		}
	}
	public function view(Request $request, $id) {
		$queue_data = queue::where('id', $id)->first();
		if ($queue_data->request == 'Create Campaign' || $queue_data->request == 'Edit Campaign' || $queue_data->request == 'Camapign Inactive') {
			$camp_json = json_decode($queue_data->data);

			if ($queue_data->request == 'Create Campaign') {
				$exp_user = explode(',', $camp_json->user_id);

				$users_name = central_users::select('username')->whereIn('id', $exp_user)->get()->toArray();
			} elseif ($queue_data->request == 'Edit Campaign') {
				$users = explode(',', $camp_json->new_data->user_id);
				$users_name = central_users::select('username')->whereIn('id', $users)->get()->toArray();
				//print_r($users_name);

			}
			return view('synchronize_data.view', compact('camp_json', 'queue_data', 'users_name'));

		} elseif ($queue_data->request == 'Create User' || $queue_data->request == 'Edit User' || $queue_data->request == 'Update User Status') {
			//dd($queue_data);
			$user_json = json_decode($queue_data->data);
			//var_dump($user_json);
			if (count($user_json) > 1) {
				foreach ($user_json as $userJsonData) {
					$user_name[] = $userJsonData->username;
				}
				$jsonUserName = implode(',', $user_name);
			} else {
				$jsonUserName = $user_json->username;
			}

			$location_master = location_master::select('location')->where('id', $queue_data->location_id)->first();
			$server_ip = location_server::select('server_ip')->where('location_id', $queue_data->location_id)->where('id', $queue_data->server_id)->first();
			return view('synchronize_data.view', compact('user_json', 'queue_data', 'location_master', 'server_ip', 'jsonUserName'));

		} elseif ($queue_data->request == 'Create Role' || $queue_data->request == 'Edit Role') {
			//dd($queue_data);
			$role_json = json_decode($queue_data->data);
			$module_permission = json_decode($role_json->module_permission);
			$group_permission = json_decode($role_json->group_permission);
			$features_data['admin'] = feature::select('features_name')->whereIn('id', $module_permission->admin)->get()->toArray();
			$features_data['read'] = feature::select('features_name')->whereIn('id', $module_permission->read)->get()->toArray();
			$features_data['write'] = feature::select('features_name')->whereIn('id', $module_permission->write)->get()->toArray();
			//$implode_admin = implode(',', $features_data['admin']);
			return view('synchronize_data.view', compact('role_json', 'queue_data', 'features_data', 'group_permission'));

		}

	}
}