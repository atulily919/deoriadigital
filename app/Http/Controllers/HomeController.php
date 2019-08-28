<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Models\clients;
use App\Models\system_roles;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request) {
		// $clientcount = DB::select("SELECT count(u.username) as count,c.name,c.id FROM users as u RIGHT JOIN clients as c ON c.id=u.client_id WHERE c.status=1 GROUP BY u.client_id, c.id");
		$clientcount = clients::rightjoin('users', 'users.client_id', 'clients.id')->select('clients.name', 'clients.id', DB::raw('COUNT(users.username) as count'))->where('clients.status', '1')->groupby('users.client_id', 'clients.id')->get();

		//dd($clientcount);

		return view('maincontent')->with('clientcount', $clientcount);
	}
	public function centralclient() {
		$assign_role = Auth::User()->assign_roles;
		$json_val = json_decode($assign_role);
		//dd($json_val);
		foreach ($json_val as $json_value) {
			// dd($json_value);
			$data['client'][] = clients::select('id', 'name')->where('id', $json_value->clientid)->first()->toArray();
			$data['role'][] = system_roles::select('id', 'rolename')->where('id', $json_value->roleid)->first()->toArray();
			//dd(count($data));

		}
		//dd($data);
		for ($i = 0; $i < count($json_val); $i++) {
			$array[] = array(["clientname" => $data['client'][$i], "rolename" => $data['role'][$i]]);
		}
		//dd($array);

		return view('centralclient')->with('privileges', $array);
	}

	//Manage central's user profile
	public function manageprofile(Request $request) {
		$user_detail = User::where('id', Auth::user()->id)->first();
		return view('centralclient_registration.manageprofile', compact('user_detail'));
	}

	//Update Central's User Profile
	public function updateprofile(Request $request, $id) {
		$validaterequest = $request->validate([
			'name' => 'required|max:50',
			'email' => 'required|email',
		]);
		$user_update = User::find($id);
		$user_update->name = $request->name;
		$user_update->email = $request->email;
		$user_update->Status = $request->status;

		$user_update->save();
		if ($user_update) {
			return redirect('/userprofile')->with('success', 'User Updated Successfully');
		}

	}

	//Reset User Password
	public function resetpassword(Request $request) {
		$password = Hash::make($request->password);
		$update_user = User::select('id', $request->id)->update(['password' => $password]);
		if ($update_user) {
			return 1;

		}
	}
}
