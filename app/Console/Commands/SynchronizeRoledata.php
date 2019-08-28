<?php

namespace App\Console\Commands;
error_reporting(0);
use App\Models\clientlocation_details;
use App\Models\clients;
use App\Models\feature;
use App\Models\location_server;
use App\Models\queue;
use App\Models\roles;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizeRoledata extends Command {
/**
 * The name and signature of the console command.
 *
 * @var string
 */
	protected $signature = 'command:SynchronizeRoledata';

/**
 * The console command description.
 *
 * @var string
 */
	protected $description = 'Command SynchronizeRoledata';

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
		$feature_data = feature::where("status", "1")->pluck("features_name", "id")->toArray();
		$queuesData = queue::whereIn("request", ["Create Role", "Edit Role"])->whereIn("status", ["pending", "revert"])->orderBy("priority", "ASC")->get()->toArray();
		//dd($queuesData);
		//$id = $queues_data['id'];
		//dd($id);
		$client_name = array_unique(array_column($queuesData, "client_details"));

		$client_details_data = clients::whereIn("name", $client_name)->pluck("id", "name");

		$clientlocation_details = clientlocation_details::whereIn("client_id", $client_details_data)->get();
		$clientlocation_details_data = array();
		$location_server_id = array();
		foreach ($clientlocation_details as $clientlocation_details_value) {
			//print_r($clientlocation_details_value);
			$location_server_id = array_merge($location_server_id, explode(',', $clientlocation_details_value->location_server_id));

			$clientlocation_details_data[$clientlocation_details_value->client_id][] = explode(',', $clientlocation_details_value->location_server_id);
		}
		$location_servers_data = collect(location_server::whereIn("id", $location_server_id)->get())->keyBy("id");

		$updatation_id = array();
		$error_log = array();
		foreach ($queuesData as $queuesValue) {
			$id = $queuesValue['id'];
			$query_data = $clientlocation_details_data[$client_details_data[$queuesValue["client_details"]]];
			if ($query_data) {
				foreach ($query_data as $query_datavalue) {
					foreach ($query_datavalue as $query_value) {
						if ($query_value) {

							$decrypt = base64_decode($location_servers_data[$query_value]['login_credentials']);

							$decrypted = str_replace("'", '', substr($decrypt, 10, -10));

							$loginvalue = json_decode($decrypted);
							//dd($loginvalue);

							try {
								config(['database.connections.temp.host' => $loginvalue->hostname]);
								config(['database.connections.temp.database' => $loginvalue->dbname]);
								config(['database.connections.temp.username' => $loginvalue->username]);
								config(['database.connections.temp.password' => $loginvalue->dbpassword]);

								DB::purge('temp');
								DB::reconnect('temp');

								if ($queuesValue['status'] == 'pending') {
									if ($queuesValue['request'] == "Create Role") {
										$role_json = json_decode($queuesValue['data'], true);

										$exist_role = DB::connection('temp')->table('roles')->where("rolename", $role_json["rolename"])->first();
										if (!$exist_role) {
											$module_permission = json_decode($role_json["module_permission"]);

											$group_permission = json_decode($role_json["group_permission"]);
											$createrole = DB::connection('temp')->table('roles')->insert([
												"rolename" => $role_json["rolename"],
												"status" => "Active",
												"created_at" => new DateTime(),
												"updated_at" => new DateTime(),
												"modulerwa" => implode(',', array_keys(array_intersect(array_flip($feature_data), $module_permission->admin))),
												"modulerw" => implode(',', array_keys(array_intersect(array_flip($feature_data), array_merge($module_permission->write, $module_permission->admin)))),
												"moduler" => implode(',', array_keys(array_intersect(array_flip($feature_data), array_merge($module_permission->read, $module_permission->admin)))),
// "grouprwa"=>implode(',', $group_permission->admin),
												// "grouprw"=>$group_permission->write,
												// "groupr"=>$group_permission->read,
												"rolegroup" => $role_json["rolegroup"],
												"data" => '[]',
												"default" => $role_json["default"],
												"group" => $role_json["group"],
											]);

											if ($createrole) {
												$status_val = "Success";
												echo $status_val . '\n';

											}

										}

									}
									if ($queuesValue['request'] == "Edit Role") {
										$role_json = json_decode($queuesValue['data'], true);

										$role_json = json_decode($queuesValue['data']);
										$role_data = roles::where("rolename", $role_json->new_data->rolename)->first();
										//  dd($role_data);
										$rolematched_data = DB::connection('temp')->table('roles')->where('rolename', $role_data->rolename)->first();

										$module_permission = json_decode($role_data["module_permission"]);
										$modulerwa = implode(',', array_keys(array_intersect(array_flip($feature_data), $module_permission->admin)));
										//dd($modulerwa);
										$modulerw = implode(',', array_keys(array_intersect(array_flip($feature_data), array_merge($module_permission->write, $module_permission->admin))));
										//  dd($modulerw);
										$moduler = implode(',', array_keys(array_intersect(array_flip($feature_data), array_merge($module_permission->read, $module_permission->admin))));

										if (!empty($rolematched_data)) {

											//dd($role_data->rolename);
											$updateData = DB::connection('temp')->table('roles')->where('rolename', $role_data->rolename)->update(['status' => $role_data->status,
												'modulerwa' => $modulerwa,
												'modulerw' => $modulerw,
												'moduler' => $moduler,
												'rolegroup' => $role_data['rolegroup'],
												'data' => '[]',
												'default' => $role_data['default'],
												'group' => $role_data['group'],
											]);
											if ($updateData) {
												$status_val = "Success";
												echo $status_val . '\n';
											}
										}

									}
								} //if pending close
								if ($queuesValue['status'] == 'revert') {
									$role_json = json_decode($queuesValue['data'], true);
									//dd($role_json['old_data']['module_permission']);
									if ($queuesValue['request'] == "Create Role") {
										$clientId = clients::select('id')->where('name', $queuesValue['client_details'])->first();
										$delete_role = roles::where('rolename', $role_json["rolename"])->where('client_id', $clientId->id)->delete();
										$queues_data = queue::where('id', $queues_data['id'])->delete();
										if ($delete_role && $queues_data) {
											$status_val = "Success";
											echo $status_val . '\n';

										}

									} elseif ($queuesValue['request'] == 'Edit Role') {
										$queue = queue::where('request', 'Create Role')->where('client_details', $queuesValue['client_details'])->get();
										foreach ($queue as $queueData) {
											//dd($role_json['old_data']['role_name']);
											$jsonData = json_decode($queueData['data']);
											if ($jsonData->rolename == $role_json['old_data']['role_name']) {
												$clientId = clients::select('id')->where('name', $queuesValue['client_details'])->first();
												$revert_roleData = role::where('client_id', $clientId->id)->where('rolename', $role_json['old_data']['role_name'])->update([

													'rolegroup' => $role_json['old_data']['rolegroup'],
													'module_permission' => $role_json['old_data']['module_permission'],
													'group_permission' => $role_json['old_data']['group_permission'],
													'status' => $role_json['old_data']['status'],
													'default' => $role_json['old_data']['default'],
													'group' => $role_json['old_data']['group'],

												]);
												if ($revert_roleData) {
													$status_val = "Changes Reverted Successfully";
													echo $status_val . '\n';

												}

											} elseif ($jsonData->rolename != $role_json['old_data']['role_name'] && $queuesValue['status'] == 'paused' || $queuesValue['status'] == 'pending') {
												$delete_queue = queue::where('id', $queues_data['id'])->delete();
												$status_val = "Success";
												echo $status_val . '\n';

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