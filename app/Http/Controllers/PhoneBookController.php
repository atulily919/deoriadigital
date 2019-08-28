<?php

namespace App\Http\Controllers;

use App\Models\campaign;
use App\Models\phonebooks;
use Datatables;
use Illuminate\Http\Request;

class PhoneBookController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		if (request()->ajax()) {

			$data = phonebooks::get();

			return Datatables::of($data)->make(true);
		}

		return view('phonebook.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$campaign = campaign::where('status', 'Active')->select('id', 'client_id', 'campaign_name')->get();
		return view('phonebook.create')->with('campaign', $campaign);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$base_path = base_path();

		$validaterequest = $request->validate([
			'phonebookname' => 'required|max:50',
			'campaign' => 'required',
			'priority' => 'required',
			'callerid' => 'required',
		]);

		$arr = ['phonebookname' => $request->phonebookname,
			'description' => $request->desc,
			'campaign' => $request->campaign,
			'priority' => $request->priority,
			'status' => $request->status,
			'callerid' => $request->callerid,
			'user_data_excel' => date('Y-m-d-H:i:s').'-'.$_FILES["myFile"]["name"],
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')];

		move_uploaded_file($_FILES["myFile"]["tmp_name"], $base_path . "/public/phonebook_user_excel/" . date('Y-m-d-H:i:s').'-'.$_FILES["myFile"]["name"]);

		phonebooks::insert($arr);

		return redirect('/phonebook')->with('success', 'PhoneBook saved successfully');

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
		$phonebookdata = phonebooks::where('id', $id)->first();
		$campaign = campaign::where('status', 'Active')->select('id', 'client_id', 'campaign_name')->get();
		return view('phonebook.edit')->with('campaign', $campaign)->with('phonebook', $phonebookdata);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		$base_path = base_path();
		$validaterequest = $request->validate([
			'phonebookname' => 'required|max:50',
			'campaign' => 'required',
			'priority' => 'required',
			'callerid' => 'required',
		]);

		$arr = ['phonebookname' => $request->phonebookname,
			'description' => $request->desc,
			'campaign' => $request->campaign,
			'priority' => $request->priority,
			'status' => $request->status,
			'callerid' => $request->callerid,
			'user_data_excel' => date('Y-m-d-H:i:s').'-'.$_FILES["myFile"]["name"],
			'updated_at' => date('Y-m-d H:i:s')];

		move_uploaded_file($_FILES["myFile"]["tmp_name"], $base_path . "/public/phonebook_user_excel/" . date('Y-m-d-H:i:s').'-'.$_FILES["myFile"]["name"]);
		$phonebook=phonebooks::where('id', $id)->select('user_data_excel')->first();
		unlink($base_path ."/public/phonebook_user_excel/" . $phonebook['user_data_excel']);

		phonebooks::where('id',$id)->update($arr);

		return redirect('/phonebook')->with('success', 'PhoneBook updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$base_path = base_path();
		$phonebook=phonebooks::where('id', $id)->select('user_data_excel')->first();
		unlink($base_path ."/public/phonebook_user_excel/" . $phonebook['user_data_excel']);
		phonebooks::where('id', $id)->delete();
		return 'true';
	}

	public function phonebookchangestatus($id) {

		$getstatus = phonebooks::select('status')->where('id', $id)->first();
		if ($getstatus['status'] == 'Active') {
			$arr = ['status' => 'Inactive'];

		} else if ($getstatus['status'] == 'Inactive') {
			$arr = ['status' => 'Active'];
		}
		phonebooks::where('id', $id)->update($arr);
		return redirect('/phonebook');
	}
	public function downloadphonebookexcel($id) {
		$data = phonebooks::select('user_data_excel')->where('id', $id)->first();

		$ext = pathinfo($data['user_data_excel'], PATHINFO_EXTENSION);

		//dd($ext);
		$file = base_path() . "/public/phonebook_user_excel/" . $data['user_data_excel'];
		return response()->download($file, 'users.' . $ext);
	}

}
