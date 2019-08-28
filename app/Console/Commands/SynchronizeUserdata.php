<?php

namespace App\Console\Commands;

use App\Models\central_users;
use App\Models\clients;
use App\Models\location_server;
use App\Models\queue;
use DB;
use Illuminate\Console\Command;

class SynchronizeUserdata extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'command:SynchronizeUserdata';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command SynchronizeUserdata';

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
		$queuesData = queue::whereIn("request", ["Create User", "Update User Status", "Edit User", "Update User Password"])->whereIn("status", ["pending", "revert"])->orderBy('priority', 'DESC')->get()->toArray();
		//dd($queuesData);
		foreach ($queuesData as $queues_data) {
			///dd($queues_data);
			$client_id = clients::select('id')->where('name', $queues_data['client_details'])->first();
			$remark_status = "";

			$location_id = $queues_data['location_id'];
			$server_id = $queues_data['server_id'];

			$server_data = location_server::select('login_credentials', 'server_ip')->where('location_id', $location_id)->where('id', $server_id)->first();
			//dd($server_data->login_credentials);
			$id = $queues_data['id'];

			if (!empty($server_data->login_credentials)) {
				//$location_data = $location_serverData[$queues_data['location_id']];
				$decrypt = base64_decode($server_data['login_credentials']);

				$decrypted = str_replace("'", '', substr($decrypt, 10, -10));

				$loginvalue = json_decode($decrypted);
				//dd($loginvalue);

				$userdata = json_decode($queues_data['data']);
				//dd($userdata);
				$userData = array();
				//dd($loginvalue->hostname);
				try {
					config(['database.connections.temp.host' => $loginvalue->hostname]);
					config(['database.connections.temp.database' => $loginvalue->dbname]);
					config(['database.connections.temp.username' => $loginvalue->username]);
					config(['database.connections.temp.password' => $loginvalue->dbpassword]);
					DB::purge('temp');
					DB::reconnect('temp');
					if ($queues_data['status'] == 'pending') {

						if ($queues_data['request'] == 'Update User Status') {
							//dd('update');
							$existuser = DB::connection('temp')->table('users')->where('username', $userdata->username)->first();
							if ($existuser) {
								$existuser = DB::connection('temp')->table('users')->where('username', $userdata->username)->update(['status' => $userdata->status]);
								queue::where('id', $id)->update(['status' => 'completed']);
								echo "Success\n";
							}
						} elseif ($queues_data['request'] == 'Edit User') {

							$usermatched_data = DB::connection('temp')->table('users')->where('username', $userdata->new_data->username)->first();

							if (!empty($usermatched_data)) {

								$fullname = $userdata->new_data->username;
								$email = $userdata->new_data->email;

								if (isset($userdata->new_data->data)) {
									$data = $userdata->new_data->data;
								} else {
									$data = null;
								}
								if (isset($userdata->new_data->invisible)) {$invisible = $userdata->new_data->invisible;} else { $invisible = '0';}

								if (isset($userdata->new_data->timezone)) {$timezone = $userdata->new_data->timezone;} else { $timezone = '-330';}
								if (isset($userdata->new_data->organization)) {$organization = $userdata->new_data->organization;} else { $organization = 'Default';}
								if (isset($userdata->new_data->group)) {$group = $userdata->new_data->group;} else { $group = 'Default';}
								if (isset($userdata->new_data->diskuse)) {$diskuse = $userdata->new_data->diskuse;} else { $diskuse = '0';}
								$lteam = $userdata->new_data->reports_to;
								$numbers = $userdata->new_data->numbers;
								$exten = $userdata->new_data->exten;
								$sel_campaign = $userdata->new_data->sel_campaign;

								$updateData = DB::connection('temp')->table('users')->where('username', $userdata->new_data->username)->update(
									['fullname' => $fullname, 'email' => $email, 'invisible' => $invisible, 'timezone' => $timezone, 'organization' => $organization, 'group' => $group, 'diskuse' => $diskuse, 'lteam' => $lteam, 'number1' => $numbers, 'exten' => $exten, 'status' => $userdata->new_data->status, 'data' => $data]);
								if ($updateData) {
									queue::where('id', $id)->update(['status' => 'completed']);
									echo "Success\n";

								}
							}

						} elseif ($queues_data['request'] == 'Create User') {

							try {

								if (count($userdata) > 1) {
									foreach ($userdata as $userqueueData) {
										//	dd($userdata->username);
										if (isset($userqueueData->data)) {
											$data = $userqueueData->data;
										} else {
											$data = null;
										}
										$userData = [
											'username' => $userqueueData->username,
											'password' => $userqueueData->password,
											'fullname' => $userqueueData->fullname,
											'email' => $userqueueData->email,
											'usertype' => $userqueueData->usertype,
											'status' => $userqueueData->status,
											'data' => $data,
											'timezone' => '-330',
											'invisible' => 0,
											'diskuse' => 0,
											'organization' => 'Default',
											'group' => 'Default'];

										$userdataList = DB::connection('temp')->table('users')->insert($userData);
										queue::where('id', $id)->update(['status' => 'completed']);
										$status_val = "Success";
										echo $status_val . "\n";
										$remark_status .= $userqueueData->username . '-' . $status_val . ',';
										queue::where('id', $id)->update(['remark' => $remark_status]);
									}
								} else {
									if (isset($userdata->data)) {
										$data = $userdata->data;
									} else {
										$data = null;
									}
									$userData = [
										'username' => $userdata->username,
										'password' => $userdata->password,
										'fullname' => $userdata->fullname,
										'email' => $userdata->email,
										'usertype' => $userdata->usertype,
										'status' => $userdata->status,
										'data' => $data,
										'timezone' => '-330',
										'invisible' => 0,
										'diskuse' => 0,
										'organization' => 'Default',
										'group' => 'Default'];

									$userdataList = DB::connection('temp')->table('users')->insert($userData);
									queue::where('id', $id)->update(['status' => 'completed']);
									$status_val = "Success";
									echo $status_val . "\n";
									$remark_status .= $userdata->username . '-' . $status_val . ',';
									queue::where('id', $id)->update(['remark' => $remark_status]);

								}
							} catch (\Illuminate\Database\QueryException $ex) {
								echo $ex->getMessage();
								$msg = $ex->getMessage();
								$remark_status .= $userdata->username . '-' . $msg . ',';
								queue::where('id', $id)->update(['remark' => $remark_status, "status" => 'pending']);
							}

							//dd($userData);

						} elseif ($queues_data['request'] == 'Update User Password') {
							$existuser = DB::connection('temp')->table('users')->where('username', $userdata->username)->first();
							if ($existuser) {
								try {
									//dd($userdata->password);
									$existuser = DB::connection('temp')->table('users')->where('username', $userdata->username)->update(['password' => $userdata->password]);

									queue::where('id', $id)->update(['status' => 'completed']);
									$status_val = "Success";
									echo $status_val . "\n";
									$remark_status .= $userdata->username . '-' . $status_val . ',';
									queue::where('id', $id)->update(['remark' => $remark_status]);

								} catch (\Illuminate\Database\QueryException $ex) {
									echo $ex->getMessage();
									$msg = $ex->getMessage();
									$remark_status .= $userdata->username . '-' . $msg . ',';
									queue::where('id', $id)->update(['remark' => $remark_status, "status" => 'pending']);

								}

							}

						}

					}
					if ($queues_data['status'] == 'revert') {
						if ($queues_data['request'] == 'Create User') {
							//dd($userdata->username);
							$clientId = clients::select('id')->where('name', $queues_data['client_details'])->first();
							$delete_user = central_users::where('username', $userdata->username)->where('client_id', $clientId->id)->where('location_id', $queues_data['location_id'])->where('server_id', $queues_data['server_id'])->delete();
							$queues_data = queue::where('id', $queues_data['id'])->delete();
							if ($delete_user && $queues_data) {
								$status_val = "Deleted successfully\n";
								echo $status_val;
								$remark_status .= $userdata->username . '-' . $status_val . ',';
								queue::where('id', $id)->update(['remark' => $remark_status]);
							}

						} elseif ($queues_data['request'] == 'Edit User') {
							$queue = queue::where('request', 'Create User')->where('client_details', $queues_data['client_details'])->where('location_id', $queues_data['location_id'])->where('server_id', $queues_data['server_id'])->get();
							//dd($queue);
							foreach ($queue as $data_queue) {
								$jsonData = json_decode($data_queue->data);

								$fullname = $userdata->old_data->username;
								$email = $userdata->old_data->email;

								if (isset($userdata->old_data->data)) {
									$data = $userdata->old_data->data;
								} else {
									$data = null;
								}
								if (isset($userdata->old_data->invisible)) {$invisible = $userdata->old_data->invisible;} else { $invisible = '0';}

								if (isset($userdata->old_data->timezone)) {$timezone = $userdata->old_data->timezone;} else { $timezone = '-330';}
								if (isset($userdata->old_data->organization)) {$organization = $userdata->old_data->organization;} else { $organization = 'Default';}
								if (isset($userdata->old_data->group)) {$group = $userdata->old_data->group;} else { $group = 'Default';}
								if (isset($userdata->new_data->diskuse)) {$diskuse = $userdata->old_data->diskuse;} else { $diskuse = '0';}
								$lteam = $userdata->old_data->reports_to;
								$numbers = $userdata->old_data->numbers;
								$exten = $userdata->old_data->exten;
								$sel_campaign = $userdata->old_data->sel_campaign;
								$status = $userdata->old_data->status;
								if ($jsonData->username == $userdata->old_data->username) {

									$central_users_revert = central_users::where('username', $userdata->old_data->username)->where('client_id', $client_id->id)->where('location_id', $queues_data['location_id'])->where('server_id', $queues_data['server_id'])->update(['fullname' => $fullname,
										'email' => $email,
										'invisible' => $invisible,
										'timezone' => $timezone,
										'organization' => $organization,
										'group' => $group,
										'diskuse' => $diskuse,
										'reports_to' => $lteam,
										'numbers' => $numbers,
										'exten' => $exten,
										'status' => $status,
										'data' => $data]);

									if ($central_users_revert) {
										queue::where('id', $id)->update(['status' => 'completed']);
										$status_val = "Changes Reverted Successfully";
										echo $status_val, "\n";
										$remark_status .= $userdata->old_data->username . '-' . $status_val . ',';
										queue::where('id', $id)->update(['remark' => $remark_status]);

									}
								} else {
									foreach ($jsonData as $jsonbulkData) {
										//print_r($jsonbulkData->username);
										if ($jsonbulkData->username == $userdata->old_data->username) {
											$central_users_revert = central_users::where('username', $userdata->old_data->username)->where('client_id', $client_id->id)->where('location_id', $queues_data['location_id'])->where('server_id', $queues_data['server_id'])->update(['fullname' => $fullname,
												'email' => $email,
												'invisible' => $invisible,
												'timezone' => $timezone,
												'organization' => $organization,
												'group' => $group,
												'diskuse' => $diskuse,
												'reports_to' => $lteam,
												'numbers' => $numbers,
												'exten' => $exten,
												'status' => $status,
												'data' => $data]);

											if ($central_users_revert) {
												queue::where('id', $id)->update(['status' => 'completed']);
												$status_val = "Changes Reverted Successfully";
												echo $status_val, "\n";
												$remark_status .= $userdata->old_data->username . '-' . $status_val . ',';
												queue::where('id', $id)->update(['remark' => $remark_status]);

											}

										} elseif ($jsonData->username != $userdata->old_data->username && $data_queue['status'] == 'paused' || $jsonbulkData->username != $userdata->old_data->username || $data_queue['status'] == 'pending') {
											$delete_queue = queue::where('id', $queues_data['id'])->delete();
											queue::where('id', $id)->update(['status' => 'completed']);
											$status_val = "Successfully deleted";
											echo $status_val . "\n";
											$remark_status .= $userdata->old_data->username . '-' . $status_val . ',';
											queue::where('id', $id)->update(['remark' => $remark_status]);
										}
									}

								}

							}
						}
					}
				} catch (\Illuminate\Database\QueryException $ex) {
					echo $ex->getMessage();
					$msg = $ex->getMessage();
					queue::where('id', $id)->update(['remark' => $msg]);
				}
			}

		}

	}
}
