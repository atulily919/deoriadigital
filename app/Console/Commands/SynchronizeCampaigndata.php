<?php

namespace App\Console\Commands;

use App\Models\campaign;
use App\Models\clientlocation_details;
use App\Models\clients;
use App\Models\location_server;
use App\Models\queue;
use App\Models\Screen;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizeCampaigndata extends Command {
/**
 * The name and signature of the console command.
 *
 * @var string
 */
	protected $signature = 'command:SynchronizeCampaigndata';

/**
 * The console command description.
 *
 * @var string
 */
	protected $description = 'Command SynchronizeCampaigndata';

/**
 * Create a new command instance.
 *
 * @return void
 */
	public function __construct() {
		parent::__construct();
	}

/**
 * Execute the console command.
 *
 * @return mixed
 */
	public function handle() {
		$queuesData = queue::whereIn("request", ["Create Campaign", "Edit Campaign"])->whereIn("status", ["pending", "revert"])->orderBy("priority", "DESC")->get()->toArray();
		$client_name = array_unique(array_column($queuesData, "client_details"));
		$client_details_data = clients::whereIn("name", $client_name)->pluck("id", "name");

		$clientlocation_details = clientlocation_details::whereIn("client_id", $client_details_data)->get();
		$clientlocation_details_data = array();
		$location_server_id = array();

		foreach ($clientlocation_details as $clientlocation_details_value) {
			$location_server_id = array_merge($location_server_id, explode(',', $clientlocation_details_value->location_server_id));

			$clientlocation_details_data[$clientlocation_details_value->client_id][] = explode(',', $clientlocation_details_value->location_server_id);
		}
		$location_servers_data = collect(location_server::whereIn("id", $location_server_id)->get())->keyBy("id");
		$updatation_id = array();
		$error_log = array();
		$assign_campaign = array();
		// echo print_r($location_servers_data);die();
		foreach ($queuesData as $queuesValue) {
			$id = $queuesValue['id'];
			//dd($queuesValue);
			$query_data = $clientlocation_details_data[$client_details_data[$queuesValue["client_details"]]];
			// echo print_r($query_data);die();
			if ($query_data) {
				foreach ($query_data as $query_datavalue) {
					foreach ($query_datavalue as $query_value) {
						if ($query_value) {

							$decrypt = base64_decode($location_servers_data[$query_value]['login_credentials']);

							$decrypted = str_replace("'", '', substr($decrypt, 10, -10));

							$loginvalue = json_decode($decrypted);
							$clientId = clients::select('id')->where('name', $queuesValue['client_details'])->first();

							try {

								config(['database.connections.temp.host' => $loginvalue->hostname]);
								config(['database.connections.temp.database' => $loginvalue->dbname]);
								config(['database.connections.temp.username' => $loginvalue->username]);
								config(['database.connections.temp.password' => $loginvalue->dbpassword]);

								// config(['database.connections.temp.host' => '192.168.3.231']);
								// config(['database.connections.temp.database' => 'kstych_flexydial']);
								// config(['database.connections.temp.username' => 'root']);
								// config(['database.connections.temp.password' => 'yb9738z']);

								DB::purge('temp');
								DB::reconnect('temp');
								// echo print_r($loginvalue);die();

								if ($queuesValue['status'] == 'pending') {

									if ($queuesValue['request'] == "Create Campaign") {
										$campaign_json = json_decode($queuesValue['data']);
										$param_value = ($campaign_json->param_value) ? base64_encode($campaign_json->param_value) . '==' : '';

										DB::connection('temp')->table('hrms_masters')->insert(
											array(['mkey' => json_decode($queuesValue['data'], true)['campaign_name'], 'mtype' => 'coreconfig', 'mvalue' => ''],
												['mkey' => json_decode($queuesValue['data'], true)['campaign_name'], 'mtype' => 'company', 'mvalue' => 'monthworkdays~|agencyfeesvalue~|agencyfeefunction~|contractstartdate~|contractenddate~|insurancerequired~|servicedby~|contactname~|contactemail~|contactphone~|hrsendfiles~bnVsbA==|contactnameacct~|contactemailacct~|contactphoneacct~|offerletter~|confirmationletter~|promotionletter~|appraisalletter~|warningletter~|terminationletter~|nocletter~|experienceletter~|endofserviceletter~|yrmeternityleaves~|yrsickleaves~|yrannualleaves~|yemaxcarryleaves~|developerparam~' . $param_value . '|screenname~' . $campaign_json->screen_name . '|trackerfields~|campaignscript~|'])
										);
										$status_val = 'Success';
										echo $status_val . "\n";

									}
									if ($queuesValue['request'] == "Edit Campaign") {
										$campaign_json = json_decode($queuesValue['data']);
										$campaign_data = campaign::where("campaign_name", $campaign_json->new_data->campaign_name)->first();
										//dd($campaign_json->new_data->screen_name);

										$hrms_master_data = DB::connection('temp')->table('hrms_masters')->where('mkey', $campaign_json->new_data->campaign_name)->where('mtype', 'company')->first();

										$mvalue_array = explode('|', $hrms_master_data->mvalue);

										foreach ($mvalue_array as $mvalue_key => $mvalue_value) {
											if (strpos($mvalue_value, 'developerparam~') !== false) {
												$param_value = ($campaign_data->param_value) ? base64_encode($campaign_data->param_value) . '==' : '';
												$mvalue_array[$mvalue_key] = 'developerparam~' . $param_value . '==';
											}
											if (strpos($mvalue_value, 'screenname~') !== false) {
												$screen_name = ($campaign_json->new_data->screen_name) ? $campaign_json->new_data->screen_name . '==' : '';
												$mvalue_array[$mvalue_key] = 'screenname~' . $screen_name . '==';
											}
										}
										//dd($mvalue_array);
										DB::connection('temp')->table('hrms_masters')->where('mkey', $campaign_json->new_data->campaign_name)->where('mtype', 'company')->update(['mvalue' => implode('|', $mvalue_array)]);

										$status_val = "edit successfully";
										echo $status_val . "\n";

									}
								} elseif ($queuesValue['status'] == 'revert') {
									$campaign_json = json_decode($queuesValue['data']);
									if ($queuesValue['request'] == 'Create Campaign') {

										$delete_camapign = campaign::where('campaign_name', $campaign_json->old_data->campaign_name)->where('client_id', $clientId->id)->delete();
										$queues_data = queue::where('id', $queues_data['id'])->delete();
										if ($delete_camapign && $queues_data) {
											$status_val = "Camapign Deleted successfully\n";
											echo $status_val;
										}

									} elseif ($queuesValue['request'] == 'Edit Campaign') {
										$queue = queue::where('request', 'Create Campaign')->where('client_details', $queuesValue['client_details'])->get();
										foreach ($queue as $queueData) {
											$jsonData = json_decode($queueData['data']);
											//dd($campaign_json->new_data->start_date->date);
											if ($jsonData->campaign_name == $campaign_json->old_data->campaign_name) {
												$clientId = clients::select('id')->where('name', $queuesValue['client_details'])->first();
												if ($campaign_name->old_data->screen_name != '') {
													$screen = Screen::select('id')->where('screen_name', $campaign_name->old_data->screen_name)->first();
													$screen = $screen->id;
												} else {
													$screen = null;

												}
												$change_campData = campaign::where('client_id', $clientId->id)->where('campaign_name', $campaign_json->old_data->campaign_name)->update([
													'users_id' => $campaign_json->old_data->user_id,
													'campaign_type' => $campaign_json->old_data->campaign_type,
													'param_value' => $campaign_json->old_data->param_value,
													'screen_id' => $screen,
													'start_date' => $campaign_json->old_data->start_date->date,
													'end_date' => $campaign_json->old_data->end_date->date,

												]);
												if ($change_campData) {
													$status_val = "Changes Reverted Successfully\n";
													echo $status_val;

												}

												queue::where('id', $id)->update(['status' => 'completed']);

											} elseif ($jsonData->campaign_name != $campaign_json->old_data->campaign_name && $queuesValue['status'] == 'paused' || $queuesValue['status'] == 'pending') {
												$delete_queue = queue::where('id', $queues_data['id'])->delete();
												queue::where('id', $id)->update(['status' => 'completed']);
												$status_val = "Successfully deleted\n";
												echo $status_val;
											}

										}

									}

								}

								$updatation_id[] = $queuesValue['id'];
							} catch (\Illuminate\Database\QueryException $ex) {

								$errorlog_data = array("location_servers_id" => $query_value, "server_id" => $location_servers_data[$query_value]['server_ip'], "error_data" => $ex->getMessage());
								$error_log[$queuesValue['id']][] = $errorlog_data;
							}
						}
					}
				}
			}
		}
		if ($updatation_id) {
			DB::table('queues')->whereIn('id', $updatation_id)->update(['status' => 'completed', 'remark' => $status_val]);
		}

	}
}
