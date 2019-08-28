<?php

namespace App\Http\Controllers;
error_reporting(0);

use App\Http\Controllers\Controller;
use App\Models\location_master;
use App\Models\location_server;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationServerController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		//echo $location->location_masters->location;

		if (request()->ajax()) {
			$location = location_server::with('location_masters')->where('status', '1')->get();
			return Datatables::of($location)->make(true);
		}
		return view('servers.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$locationMaster = location_master::where('status', '1')->get()->toArray();
		return view('servers.create', compact('locationMaster'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'server_ip' => 'required|unique:location_servers',
			'location_id' => 'required',
		]);
		$data = array();
		$server_data = location_server::where('server_ip', $request->server_ip)->first();
		if ($server_data) {
			return back()->with('error', 'Server IP is already exist.');
		}

		$prev_server_ip = implode(',', $request->prev_server_ip);
		$login_deatils = array();
		$logindetails = $request->loginDetails;
		$jsonval = json_encode($logindetails);

		$startrand = mt_rand(1000000000, 9999999999);
		$endrand = mt_rand(1000000000, 9999999999);
		$finalvalue = $startrand . $jsonval . $endrand;
		$encrypted = base64_encode($finalvalue);
		$serverIP = $request->server_ip;

		$data['location_id'] = $request->location_id;
		$data['server_ip'] = $serverIP;
		$data['prev_server_ip'] = $prev_server_ip;
		$data['login_credentials'] = $encrypted;
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		if ($request->address) {
			$data['address'] = $request->address;
		}

		location_server::insert($data);
		return redirect('/locationserver')->with('success', 'Server added successfully');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

		$location_server = location_server::where('id', $id)->with('location_masters')->first();
		$decrypt = base64_decode($location_server->login_credentials);
		$decrypted = str_replace("'", '', substr($decrypt, 10, -10));
		$loginvalue = json_decode($decrypted);
		$host = $loginvalue->hostname;
		$port = $loginvalue->portname;
		$username = $loginvalue->username;
		$password = $loginvalue->dbpassword;
		$dbname = $loginvalue->dbname;
		$locationMaster = location_master::where('status', '1')->get()->toArray();

		return view('servers.edit', compact('location_server', 'locationMaster', 'host', 'port', 'username', 'password', 'dbname'));

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
		$data = array();
		$server_data = new location_server;

		$login_deatils = array();

		$serverIP = $request->server_ip;
		$data['location_id'] = $request->location_id;

		$data['server_ip'] = $serverIP;
		if ($request->prev_server_ip) {
			$prev_server_ip = implode(',', $request->prev_server_ip);
			$data['prev_server_ip'] = $prev_server_ip;
		}

		if ($logindetails = $request->loginDetails) {
			$jsonval = json_encode($logindetails);
			$startrand = mt_rand(1000000000, 9999999999);
			$endrand = mt_rand(1000000000, 9999999999);
			$finalvalue = $startrand . $jsonval . $endrand;
			$encrypted = base64_encode($finalvalue);
			$data['login_credentials'] = $encrypted;
		}
		if ($request->address) {
			$data['address'] = $request->address;
		}

		$data['updated_at'] = date('Y-m-d H:i:s');
		//dd($data);

		DB::table('location_servers')->where('id', $id)->update($data);

		return redirect('/locationserver')->with('Success', 'Server Updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$response = location_server::find($id)->delete();
		if ($response) {
			return 'true';
		}

	}

	public function bulkDelete(Request $request) {
		dd($request->ids);

	}
	public function validation_server_ip(Request $request) {
		//dd($request);

		$serverip = location_server::where('server_ip', $request->server_ip)->first();
		return json_encode($serverip);
	}
}
