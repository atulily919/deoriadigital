<?php

namespace App\Http\Controllers;

use App\Models\assign_campaign_detail;
use App\Models\campaign;
use App\Models\clients;
use App\Models\skillgroup;
use Datatables;
use Illuminate\Http\Request;

class AssignCampaignController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (request()->ajax()) {
			$client_id = session('clientid');
			if ($client_id) {
				$data = assign_campaign_detail::leftjoin('clients', 'clients.id', 'assign_campaign_details.client_id')->leftjoin('campaigns', 'campaigns.id', 'assign_campaign_details.campaign_id')->leftjoin('skillgroups', 'skillgroups.id', 'assign_campaign_details.groupskill_id')->select('clients.name', 'assign_campaign_details.*', 'campaigns.campaign_name', 'skillgroups.group_name')->where('clients.id', $client_id)->get()->toArray();
			} else {
				$data = assign_campaign_detail::leftjoin('clients', 'clients.id', 'assign_campaign_details.client_id')->leftjoin('campaigns', 'campaigns.id', 'assign_campaign_details.campaign_id')->leftjoin('skillgroups', 'skillgroups.id', 'assign_campaign_details.groupskill_id')->select('clients.name', 'assign_campaign_details.*', 'campaigns.campaign_name', 'skillgroups.group_name')->get()->toArray();

			}

			return Datatables::of($data)->make(true);
		}
		return view('assigncampaign.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$client_id = session('clientid');
		if ($client_id) {
			$client_data = clients::where('id', $client_id)->where('status', 1)->get();
		} else {
			$client_data = clients::where('status', 1)->get();
		}

		return view('assigncampaign.create')->with('client_data', $client_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$arr = ['client_id' => $request->clientid,
			'groupskill_id' => $request->groupskill,
			'campaign_id' => $request->campaign,
			'status' => $request->status,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')];

		assign_campaign_detail::insert($arr);

		return redirect('/assigncampaign')->with('success', 'Campaign assigned succesfully');
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
		$data = assign_campaign_detail::where('assign_campaign_details.id', $id)->join('clients', 'clients.id', 'assign_campaign_details.client_id')->join('campaigns', 'campaigns.id', 'assign_campaign_details.campaign_id')->join('skillgroups', 'skillgroups.id', 'assign_campaign_details.groupskill_id')->select('clients.name', 'assign_campaign_details.*', 'campaigns.campaign_name', 'skillgroups.group_name')->first();

		
		//dd($data);

		$groupskills = skillgroup::where('status', 'Active')->where('client_id',$data->client_id)->get();
		$campaign = campaign::where('status', 'Active')->get();

		return view('assigncampaign.edit')->with('data', $data)->with('groupskills', $groupskills)->with('campaign', $campaign);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		// dd('hey');

		//dd($request->status);
		$arr = ['groupskill_id' => $request->groupskill,
			'campaign_id' => $request->campaign,
			'status' => $request->status,
			'updated_at' => date('Y-m-d H:i:s')];

		assign_campaign_detail::where('id', $id)->update($arr);

		return redirect('/assigncampaign')->with('success', 'Campaign updated succesfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		assign_campaign_detail::where('id', $id)->delete();
		return 'true';
	}

	public function skillcampaignclientwise(Request $request) {
		$skillgroup = skillgroup::where('client_id', $request->clientid)->where('status', 'Active')->get()->toArray();
		$campaign = campaign::where('client_id', $request->clientid)->where('status', 'Active')->get()->toArray();

		$data['skillgroup'] = $skillgroup;
		$data['campaign'] = $campaign;

		echo json_encode($data);
	}
	public function assigncampaignchangestatus($id) {
		//$arr=array();
		$getstatus = assign_campaign_detail::select('status')->where('id', $id)->first();
	//	dd($getstatus);
		if ($getstatus['status'] == 'Active') {
			$arr = ['status' => 'Inactive'];
		} else if ($getstatus['status'] == 'Inactive') {
			$arr = ['status' => 'Active'];
		}
		else
		{
			$arr = ['status' => 'Active'];
		}
		assign_campaign_detail::where('id', $id)->update($arr);
		return redirect('/assigncampaign');
	}
}
