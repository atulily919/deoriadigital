<?php

namespace App\Http\Controllers;
error_reporting(0);

use App\Models\campaign;
use App\Models\campaign_sqlQuery;
use App\Models\clients;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CampaignQueryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$clientname = clients::where('status', '1')->get();
		return view('campaign_query.create', compact('clientname'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//dd($request->all());
		$clientname = $request->client_name;
		$client_campaignid = $request->avbl_campaign;
		$table_name = $request->table_name;
		//$select=$request->all;
		$sql_data = '';
		for ($i = 0; $i < count($request->where); $i++) {
			$wheredata = (array) $request->where;
			$query_conddata = (array) $request->query_cond;
			$condition_ondata = (array) $request->condition_on;
			$concatenate_opt = (array) $request->concatenate_opt;

			if (isset($wheredata[$i]) && isset($query_conddata[$i]) && isset($condition_ondata[$i])) {
				if ($query_conddata[$i] == 'BETWEEN' || $query_conddata[$i] == 'NOT BETWEEN') {
					$sql_data .= $wheredata[$i] . ' ' . $query_conddata[$i] . ' ' . $condition_ondata[$i] . '';
				} else {
					$sql_data .= $wheredata[$i] . ' ' . $query_conddata[$i] . ' "' . $condition_ondata[$i] . '" ';
				}

				if ($i != (count($wheredata) - 1)) {
					$sql_data .= $concatenate_opt[$i] . ' ';
				}
			}
		}
		// dd($sql_data);
		$query = "Select * from $table_name where " . $sql_data;
		$campaign_query = new campaign_sqlQuery;
		$campaign_query->campaign_id = $client_campaignid;
		$campaign_query->query = $query;
		$campaign_query->select_col = '*';
		$campaign_query->where_con = $sql_data;
		$campaign_query->current_queue = $request->current_queue;
		$campaign_query->created_at = date('Y-m-d H:i:s');
		$campaign_query->updated_at = date('Y-m-d H:i:s');
		$campaign_query->save();

		return redirect('/campaignquery')->with('success', 'Query saved');
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function campaignname(Request $request, $clientid) {
		$client_id = $request->all();
		$data = campaign::select('campaign_name', 'id')->where('client_id', $client_id)->where('start_date', '>=', Carbon::now())->where('status', 'Active')->get()->toArray();
		echo json_encode($data);
		//return view('campaign_query.create',compact('data'));
	}

	public function runquery(Request $request) {
		$clientname = $request->clientname;
		$client_campaignid = $request->avbl_campaign;
		$table_name = $request->table_name;
		//$select=$request->all;
		$sql_data = '';
		for ($i = 0; $i < count($request->where_con); $i++) {
			$wheredata = (array) $request->where_con;
			$query_conddata = (array) $request->query_con;
			$condition_ondata = (array) $request->condition_on;
			$concatenate_opt = (array) $request->concatenate_opt;

			if (isset($wheredata[$i]) && isset($query_conddata[$i]) && isset($condition_ondata[$i])) {
				if ($query_conddata[$i] == 'BETWEEN' || $query_conddata[$i] == 'NOT BETWEEN') {
					$sql_data .= $wheredata[$i] . ' ' . $query_conddata[$i] . ' ' . $condition_ondata[$i] . '';
				} else {
					$sql_data .= $wheredata[$i] . ' ' . $query_conddata[$i] . ' "' . $condition_ondata[$i] . '" ';
				}

				if ($i != (count($wheredata) - 1)) {
					$sql_data .= $concatenate_opt[$i] . ' ';
				}
			}
		}
		// dd($sql_data);
		$querydata = DB::select("Select id,currentstatus,legalstatus,mobile,status,dialer_status,dialer_substatus from $table_name where " . $sql_data);
		$querydata = Collect($querydata);
		echo json_encode($querydata);
	}
}
