<?php

namespace App\Http\Controllers;

use App\Models\central_users;
use App\Models\clients;
use App\Models\skillgroup;
use Datatables;
use DB;
use Illuminate\Http\Request;

class SkillGroupController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (request()->ajax()) {
			$client_id = session('clientid');
			if ($client_id) {
				$skillGroup = skillgroup::join('clients', 'skillgroups.client_id', '=', 'clients.id')->where('clients.id', $client_id)->select('skillgroups.*', 'clients.name')->get();
			} else {
				$skillGroup = skillgroup::join('clients', 'skillgroups.client_id', '=', 'clients.id')->select('skillgroups.*', 'clients.name')->get();
			}
			return Datatables::of($skillGroup)->make(true);
		}
		return view('skillgroup.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$client_id = session('clientid');
		if ($client_id) {
			$clients_name = clients::where('id', $client_id)->get();
		} else {
			$clients_name = clients::all();
		}
		return view('skillgroup.create', compact('clients_name'));
		//dd('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		//dd($request);
		$this->validate($request, [
			'group_name' => 'required',
			'client_id' => 'required',

		]);
		$skillgroup_list = new skillgroup;
		$skillgroup_list->group_name = $request->group_name;
		$skillgroup_list->client_id = $request->client_id;
		if ($userlist = $request->users_list) {
			$userdata = implode(',', $userlist);
			$skillgroup_list->users_id = $userdata;
		}
		$skillgroup_list->created_at = date('Y-m-d H:i:s');
		$skillgroup_list->updated_at = date('Y-m-d H:i:s');
		$skillgroup_list->save();


		return redirect('/skillgroup')->with('success', 'Group created successfully');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$editskills = skillgroup::find($id);
		$userdata = explode(',', $editskills->users_id);
		$userval = central_users::select('username', 'id')->whereIn('id', $userdata)->get();
		$client_name = clients::where('id', $editskills->client_id)->first();
		$all_clients = clients::where('id', '!=', $editskills->client_id)->get();

		$allusers = central_users::select('username', 'id')->whereNotIn('id', $userdata)->get();

		return view('skillgroup.edit', compact('userval', 'editskills', 'allusers', 'client_name', 'all_clients'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//dd($request->all());
		$this->validate($request, [
			'group_name' => 'required',
			'client_id' => 'required',
		]);
		$skillgroup_list = skillgroup::find($id);
		$skillgroup_list->group_name = $request->group_name;
		$skillgroup_list->client_id = $request->client_id;
		if ($userlist = $request->users_list) {
			$userdata = implode(',', $userlist);
			$skillgroup_list->users_id = $userdata;
		}
		$skillgroup_list->created_at = date('Y-m-d H:i:s');
		$skillgroup_list->updated_at = date('Y-m-d H:i:s');
		$skillgroup_list->save();

		//update data in 192.168.3.246 db
		// $db_ext = \DB::connection('mysql_external');
		// $skillgroup_listdata = array();
		// $skillgroup_listdata['group_name'] = $request->group_name;
		// $skillgroup_listdata['clients'] = $request->client_id;
		// if ($userlist = $request->users_list) {
		// 	$userdata = implode(',', $userlist);
		// 	$skillgroup_listdata['users_list'] = $userdata;
		// }
		// $skillgroup_listdata['created_at'] = date('Y-m-d H:i:s');
		// $skillgroup_listdata['updated_at'] = date('Y-m-d H:i:s');
		// //dd($skillgroup_listdata);
		// $db_ext->table('skill_group')->where('id', $id)->update($skillgroup_listdata);

		return redirect('/skillgroup')->with('success', 'Group Updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$response = skillgroup::find($id)->delete();
		//$db_ext = \DB::connection('mysql_external');
		//$db_ext->table('skill_group')->where('id', $id)->delete();
		if ($response) {
			return 'true';
		}

	}

	//showuserslist according to clients
	public function showuserslist(Request $request, $clientid) {
		$users = central_users::where('client_id', $clientid)->where('status', 'Active')->select('username', 'id')->get()->toArray();
		$empty_users = 'No Users Listed in this process';
		if ($users) {
			echo json_encode($users);
		} else {
			echo json_encode($empty_users);
		}

	}

	//Change Status Of SkillGroup
	public function changestatus(Request $request, $id) {
		$skillgroup = skillgroup::select('status')->where('id', $id)->first();
		if ($skillgroup->status == 'Active') {
			Skillgroup::where('id', $id)->update(['status' => 'Deactive']);
		} else {
			Skillgroup::where('id', $id)->update(['status' => 'Active']);
		}
		return redirect('/skillgroup')->with('success', 'Status Changed');
	}

	public function bulkdelete(Request $request, $ids) {
		dd($ids);
	}

}
