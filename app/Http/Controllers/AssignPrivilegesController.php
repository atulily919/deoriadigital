<?php

namespace App\Http\Controllers;

error_reporting(0);
use App\Models\assign_role_privilege;
error_reporting(0);
use App\Models\clients;
use App\Models\pages;
use App\Models\system_roles;
use Illuminate\Http\Request;

class AssignPrivilegesController extends Controller {
	public function show() {
		$allclients = clients::where('status', 1)->get();
		$allroles = system_roles::where('status', 'Active')->get()->toArray();

		$pages = pages::where('status', 'Active')->get()->toArray();
		$subpages = pages::where('status', 'Active')->where('parent_page', '!=', '0')->get()->toArray();

		$role_privileges = assign_role_privilege::where('status', 'Active')->get()->toArray();

		return view('assignprivileges.index')->with('allclients', $allclients)->with('allroles', $allroles)->with('pages', $pages)->with('role_privileges', $role_privileges)->with('subpages', $subpages);
	}
	public function store(Request $request) {
		//dd($request);
		foreach ($request->pages_id as $page) {
			$data[] = explode('-', $page);
		}
		foreach ($request->subpages_names as $subpage) {
			$data[] = explode('-', $subpage);
		}
		//dd($data);

		assign_role_privilege::truncate();
		foreach ($data as $roledata) {

			$roleprivileges = new assign_role_privilege;
			$roleprivileges->client_id = $roledata[0];
			$roleprivileges->roles_id = $roledata[1];
			$roleprivileges->pages_id = $roledata[2];
			$roleprivileges->save();

		}
		return redirect('/privileges')->with('success', 'Privileges assigned to roles succesfully');

	}
}
