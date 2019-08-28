<?php

namespace App\Http\Controllers;

use App\Models\campaign;
use App\Models\central_users;
error_reporting(0);
use App\Models\clients;
use App\Models\queue;
use App\Models\Screen;
use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CampaignController extends Controller {
	/**
	 * Display a listing of the resource.x
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		if (request()->ajax()) {
			$client_id = session('clientid');
			if ($client_id) {
				$campaign = campaign::join('clients', 'campaigns.client_id', '=', 'clients.id')->select('campaigns.*', 'clients.name')->where('clients.id', $client_id)->get();
			} else {
				$campaign = campaign::join('clients', 'campaigns.client_id', '=', 'clients.id')->select('campaigns.*', 'clients.name')->get();

			}

			return Datatables::of($campaign)->make(true);
		}
		return view('campaign.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$client_id = session('clientid');
		if ($client_id) {
			$allclients = clients::where('id', $client_id)->where('status', '1')->get();
			$allscreens = Screen::select('id', 'screen_name')->where('Status', 'Active')->get();

		} else {
			$allclients = clients::where('status', '1')->get();
			$allscreens = Screen::select('id', 'screen_name')->where('Status', 'Active')->get();
		}
		// $userslist=central_users::where('status','Active')->get();
		return view('campaign.create', compact('allclients', 'allscreens'));
	}

	/**
	 * Get User's List According to Client
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function clientusers(Request $request) {
		$clientid = $request->clientid;
		$data = central_users::select('id', 'username')->where('client_id', $clientid)->where('status', 'Active')->get()->toArray();
		echo json_encode($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//dd($request->all());
		$this->validate($request, [
			'campaign_name' => 'required',
			'client_id' => 'required',
		]);
		$campaign_data = new campaign();
		$exist_camp = campaign::where('client_id', $request->client_id)->where('campaign_name', $request->campaign_name)->first();
		if ($exist_camp) {
			return back()->with('error', 'This Campaign already exist in same client');
		} else {

			$campaign_data->campaign_name = $request->campaign_name;
			$campaign_data->client_id = $request->client_id;
			$campaign_data->param_value = $request->param_val;
			$campaign_data->campaign_type = $request->camp_status;
			if (isset($request->screen_name)) {
			$campaign_data->screen_id = $request->screen_name;
		}
			$clientname = clients::select('name')->where('id', $request->client_id)->first();
			if (isset($request->screen_name)) {
				$screens = screen::select('screen_name')->where('id', $request->screen_name)->first();

			}
			if ($userlist = $request->users_id) {
				$userlist = implode(',', $userlist);
				$campaign_data->users_id = $userlist;
			}

			$campaign_data->start_date = Carbon::parse($request->start_date);
			$campaign_data->end_date = Carbon::parse($request->end_date);
			if ($status = $request->status) {
				$campaign_data->status = $status;
			}
			$campaign_data->created_at = date('Y-m-d H:i:s');
			$campaign_data->updated_at = date('Y-m-d H:i:s');
			$campaigndata = [
				'campaign_name' => $request->campaign_name,
				'user_id' => $userlist,
				'screen_name' => $screens->screen_name,
				'start_date' => Carbon::parse($request->start_date),
				'end_date' => Carbon::parse($request->end_date),
			];
			$campaignData = json_encode($campaigndata);
			$campaign_val = [
				'request' => 'Create Campaign',
				'client_details' => $clientname->name,
				'data' => $campaignData,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),

			];
			//dd($campaign_val);
			if ($campaign_data) {
				$campaign_data->save();
				queue::insert($campaign_val);

			}

			return redirect('/createcampaign')->with('success', 'Campaign created successfully');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		return view('campaign.edit');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$campaign = campaign::leftjoin('screens', 'screens.id', 'campaigns.screen_id')->select('campaigns.*', 'screens.screen_name')->where('campaigns.id', $id)->first();

		//dd($campaign);
		$userdata = explode(',', $campaign->users_id);
		$userval = central_users::select('username', 'id')->whereIn('id', $userdata)->get();
		$client_name = clients::where('id', $campaign->client_id)->first();
		$all_clients = clients::where('id', '!=', $campaign->client_id)->get();
		$allusers = central_users::select('username', 'id')->whereNotIn('id', $userdata)->get();
		$screen = Screen::where('Status', 'Active')->where('id', '!=', $campaign->screen_id)->get();
		$allscreen = Screen::where('Status', 'Active')->get();
		return view('campaign.edit', compact('userval', 'campaign', 'allusers', 'client_name', 'all_clients', 'screen', 'allscreen'));
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
		$screen_name='';
		$this->validate($request, [
			'campaign_name' => 'required',
			'client_id' => 'required',
		]);
		$campaign_list = campaign::find($id);
		$previous_camp = campaign::leftjoin('screens', 'screens.id', 'campaigns.screen_id')->select('campaigns.*', 'screens.screen_name')->where('campaigns.id', $id)->first();

		//dd(Carbon::parse($previous_camp->end_date));
		$queue_olddata = [
			'campaign_name' => $previous_camp->campaign_name,
			'user_id' => (array) $previous_camp->users_id,
			'param_value' => $previous_camp->param_value,
			'campaign_type' => $previous_camp->campaign_type,
			'screen_name' => $previous_camp->screen_name,
			'start_date' => Carbon::parse($previous_camp->start_date),
			'end_date' => Carbon::parse($previous_camp->end_date)];

		$campaign_list->campaign_name = $request->campaign_name;
		$campaign_list->campaign_type = $request->camp_status;
		$campaign_list->param_value = $request->param_val;
		if (isset($request->screen_name)) {
		$campaign_list->screen_id = $request->screen_name;
		$screen_name = screen::select('screen_name')->where('id', $request->screen_name)->first();
		}
		$campaign_list->client_id = $request->client_id;
		
		$clientname = clients::select('name')->where('id', $request->client_id)->first();
		$userdata = "";
		if ($userlist = $request->users_list) {
			$userdata = implode(',', $userlist);

		}
		$campaign_list->users_id = $userdata;

		if ($startDate = $request->start_date) {
			$starttimes = strtotime($startDate);
			$start_datetime = date('Y-m-d H:i:s', $starttimes);
			$campaign_list->start_date = $start_datetime;
		}
		if ($endDate = $request->end_date) {
			$endtimes = strtotime($request->end_date);
			$end_datetime = date('Y-m-d H:i:s', $endtimes);
			$campaign_list->end_date = $end_datetime;
		}

		$campaign_list->created_at = date('Y-m-d H:i:s');
		$campaign_list->updated_at = date('Y-m-d H:i:s');
		$campaign_list->save();

		if (empty($userdata)) {
			$userdata = '';
		}
		if(!empty($screen_name))
		{
			$screenname=$screen_name->screen_name;
		}
		else
		{
			$screenname='';
		}

		$campaigndata = [
			'campaign_name' => $campaign_list->campaign_name,
			'user_id' => $userdata,
			'param_value' => $campaign_list->param_value,
			'screen_name' => $screenname,
			'start_date' => Carbon::parse($request->start_date),
			'end_date' => Carbon::parse($request->end_date),
			'campaign_type' => $request->camp_status,
		];
		$json_data = array('new_data' => $campaigndata, 'old_data' => $queue_olddata);
		$jsonData = json_encode($json_data);
		//dd($jsonData);
		$campaign_val = [
			'request' => 'Edit Campaign',
			'client_details' => $clientname->name,
			'data' => $jsonData,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')];
		//dd($campaign_val);

		queue::insert($campaign_val);

		return redirect('/createcampaign')->with('success', 'Campaign Updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy($id) {
	// 	$response = campaign::find($id)->delete();
	// 	if ($response) {
	// 		return 'true';
	// 	}

	// }

	public function changestatus(Request $request, $id) {
		$campaign = campaign::select('status')->where('id', $id)->first();
		if ($campaign->status == 'Active') {
			campaign::where('id', $id)->update(['status' => 'Deactive']);
		} else {
			campaign::where('id', $id)->update(['status' => 'Active']);
		}
		return redirect('/createcampaign')->with('success', 'Status Changed');
	}

	public function checkenddate() {
		$enddate = campaign::select('end_date', 'id', 'client_id', 'campaign_name')->where('status', 'Active')->get();
		foreach ($enddate as $end_dateData) {
			//	$clientName = clients::where('id', $end_dateData['client_id'])->select('name')->first();

			$today = Carbon::today();
			$enddate = $end_dateData['end_date'];
			if ($enddate < $today) {
				// $json_data = ['campaign_name' => $end_dateData['campaign_name'],
				// 	'status' => 'Inactive'];
				// $json_val = json_encode($json_data);
				// $camp_arr = [
				// 	'request' => 'Camapign Inactive',
				// 	'client_details' => $clientName->name,
				// 	'data' => $json_val];
				// queue::insert($camp_arr);
				campaign::where('id', $end_dateData['id'])->update(['status' => 'Inactive']);
			}
		}
		return 'true';
	}

	public function checkduplicatecampaign(Request $request)
	{
		
		$ifexists=campaign::where('campaign_name',$request->campaign_name)->where('client_id',$request->clientid)->get()->toArray();

		echo json_encode($ifexists);
	}

}
