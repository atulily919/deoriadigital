<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Models\clientlocation_details;
use App\Models\clients;
use App\Models\location_master;
use App\Models\location_server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ClientController extends Controller {
	public function versionone() {
		return view('dashboard.v1');
	}
	public function showserver(Request $request) {

		$selectedloc = $request['selectedloc'];
		//dd($request['clientid']);

		$locdetails=location_master::select('id','location')->whereIn('id',$selectedloc)->get()->toArray();

		$serverdetails=location_server::select('id','location_id','server_ip')->whereIn('location_id',$selectedloc)->get()->toArray();

		$allselectedservers=clientlocation_details::where('location_server_id','!=','')->get()->toArray();

			if(!empty($request['clientid']))
			{
		$checkemptylocdetails=clientlocation_details::where('client_id',$request['clientid'])->get()->toArray();
			}

		//dd($checkemptylocdetails);

		foreach($allselectedservers as $allcheck)
		{
			$dontshowserverip[$allcheck['client_id']][]=explode(',',$allcheck['location_server_id']);

		}

		//dd($serverdetails);
		foreach($serverdetails as $key=>$values)
		{
			foreach($dontshowserverip as $master=>$dont)
			{
				foreach($dont as $d){
					if(!empty($request['clientid']))  //edit
					{
						//dd($request['clientid']);
						if(!empty($checkemptylocdetails))
						{
							if($request['clientid']!=$master)
							{
								
								foreach($dontshowserverip[$master] as $mas)
								{
									//dd($mas);
									foreach($mas as $m)
									{
										//dd($m);
										//print_r($key);
										if($m==$values['id'])
										{
											//dd($m);
											unset($serverdetails[$key]);
										}
									}
								}	
							}
						}
						else
						{
							if(in_array($values['id'],$d))
							{
								unset($serverdetails[$key]);
							}	
						}

					}
					else //create
					{
						if(in_array($values['id'],$d))
						{
							unset($serverdetails[$key]);
						}
					}
				}
				
			}
		}
			

		if(!empty($request['clientid']))
		{
			$selected_sip=clientlocation_details::where('client_id',$request['clientid'])->get()->toArray();
		}


		$selrecords=array();
		$allrecords=array();
		$records=array();
		if(!empty($selected_sip))
		{
			foreach($selected_sip as $sip)
			{
				if(!empty($sip['location_server_id']))
				{
				$selrecords[$sip['location_master_id']]=explode(',',$sip['location_server_id']);
				}
			}
		}
		
		foreach($locdetails as $loc)
		{
			foreach($serverdetails as $server)
			{
				if($server['location_id']==$loc['id'])
				{
					$allRecords[$loc['id'].'-'.$loc['location']][]=$server['id'].'-'.$server['server_ip'];
				if(!empty($selrecords))
					{
						if(count($selrecords)==1)
							{
								$flag='true';
							}
							else
							{
								$flag='false';
							}
						foreach($selrecords as $key=>$value)
						{
							if($key==$loc['id'])
							{	
								//echo "<br>if-------".$loc['id'].$i."<br>";
								if(in_array($server['id'],$value))
								{
									$allrecords[$loc['id'].'-'.$loc['location']][]=$server['id'].'-'.$server['server_ip'].'-selected';
								}
								else
								{	
									$allrecords[$loc['id'].'-'.$loc['location']][]=$server['id'].'-'.$server['server_ip'];
								}
							}
							
						}
						
					}
					else
					{
						$allrecords[$loc['id'].'-'.$loc['location']][]=$server['id'].'-'.$server['server_ip'];
					}	
					
				}
			}		
		}

		foreach($allRecords as $rec=>$value)
		{
			if(!empty($allrecords))
			{
				foreach($allrecords as $selrec=>$val)
				{
					if($rec==$selrec)
					{	
					  $allRecords[$rec]=array_replace($allRecords[$rec],$allrecords[$selrec]);
					}
					
				}
			}
		}
	//	dd($allRecords);
		$records['selrecords']=$selrecords;
		$records['allrecords']=$allRecords;

		echo json_encode($records);

	}

	public function clientform() {
		$client_id = session('clientid');
		if (!empty($client_id)) {
			$clientname = clients::select('id', 'name')->where('id', $client_id)->first();
			$location = location_master::where('status', '1')->get();
			return view('clients.create_client')->with('location', $location)->with('clientname', $clientname);
		} else {
			$clientname = clients::select('id', 'name')->where('id', $client_id)->first();
			$location = location_master::where('status', '1')->get();
			return view('clients.create_client')->with('location', $location);
		}
	}

	public function showserverlist() {
		$servers = location_server::join('location_masters', 'location_servers.location_id', '=', 'location_masters.id')->whereIn('location_servers.location_id', $_POST['city'])->where('location_servers.status', 1)->select('location_servers.id as loc_ser_id', 'location_servers.location_id', 'location_servers.server_ip', 'location_masters.*')->get();

		//dd($servers);

		echo json_encode($servers);
	}

	public function checkclient(Request $request) {
		// dd($request->clientname);
		$clientdata = clients::where('name', $request->clientname)->first();
		return json_encode($clientdata);
	}

	public function saveclient(Request $request) {

		// dd($request);
		$validaterequest = $request->validate([
			'client_name' => 'required|max:50',
		]);

		try
		{
			$clientname = Str::upper($request->client_name);
			$client = new clients;
			$clientdata = clients::where('name', $clientname)->first();
			if (count($clientdata) > 0) {
				return Redirect::back()->with('warning', 'This Client is already exist');
			} else {
				$client->name = $clientname;
				$client->description = $request->desc;
				$client->save();
				$clientid = $client->id;
				if ($clientid > 0) {

					// dd($request);
					$location = $request->location;

					if ($request->location) {
						$master_feat = array();
						foreach ($location as $k => $v) {
							$master_feaat[$v]['feature'] = $v;
							$master_feaat[$v]['subfeatures'] = array();
						}
						$avbl_server = $request->avbl_server;
						foreach ($avbl_server as $k => $v) {
							$valArr = explode('-', $v);
							if (isset($master_feaat[$valArr[1]]['feature'])) {
								$master_feaat[$valArr[1]]['subfeatures'][] = $valArr[0];
							}

						}

						foreach ($master_feaat as $msfKey => $msgVal) {
							$finalval = new clientlocation_details;
							$fetID = $msfKey;

							foreach ($msgVal as $feturesData => $msgVal1) {
								$msgVal2 = (array) $msgVal1;
								//dd($msgVal2);
								$subVAL = array_values($msgVal2);

								$subfeatureID = implode(',', $subVAL);
								$finalval->client_id = $clientid;
								$finalval->location_master_id = $fetID;
								$finalval->location_server_id = $subfeatureID;
							}
							$finalval->save();
						}
					}
				}
			}
		} catch (Exception $ex) {
			dd($ex);
		}

		return redirect('/allclients');
	}

	public function showallclients() {
		$client_id = session('clientid');
		if ($client_id) {
			$allclients = clients::with('clientlocation_details')->where('id', $client_id)->get()->toArray();
		} else {
			$allclients = clients::with('clientlocation_details')->get()->toArray();
		}

		$location = location_master::get()->toArray();
		// dd($allclients);
		return view('clients.index')->with('allclients', $allclients)->with('location', $location);
	}

	public function showservercitywise(Request $request) {

		$subservers[] = array();
		$finalfeatures = array();

		$id = $request['cityid'];
		$clientid = $request['clientid'];
		$locid = clientlocation_details::select('location_server_id')
			->where('location_master_id', $id)->where('client_id', $clientid)
			->where('status', 1)
			->first()->toArray();
		// dd($locid);

		$arr = explode(',', $locid['location_server_id']);
		// dd($arr);
		foreach ($arr as $a) {
			// dd($a);
			$locserver[] = location_server::select('server_ip', 'id')
				->where('id', $a)->where('status', '1')->get()->toArray();
			//  dd($locserver);

		}

		//dd($locserver);
		echo json_encode($locserver);
	}

	public function deleteclientrow(Request $request) {
		$clientid = $request['id'];
		$delclid = clientlocation_details::where('client_id', $clientid)->delete();
		if ($delclid) {
			return "true";
		} else {
			return "false";
		}

	}

	public function editSubservers(Request $request) {
		$city_id = $request->cityid;
		$client_id = $request->clientid;

		if (isset($request['subservers'])) {
			$subservers = $request->subservers;
			$subservers = implode(',', $subservers);
			$updatestatus = clientlocation_details::where('client_id', $client_id)->where('location_master_id', $city_id)->update(['location_server_id' => $subservers]);
			return redirect('/allfeatures')->with('message', 'Servers edited succesfully');
		} else {
			//dd($request);
			$deletecity = clientlocation_details::where('client_id', $client_id)->where('location_master_id', $city_id)->delete();
			return redirect('/allfeatures')->with('message', 'Client Locations Deleted  succesfully');
		}

	}

	public function editclient(Request $request, $clientid) {
		$location = location_master::where('status', 1)->get();
		$client = clients::with('clientlocation_details')->where('id', $clientid)->get()->toArray();
		$city_array = $arr = array();
		$server_list = '0,';

		foreach ($client[0]['clientlocation_details'] as $locid) {
			array_push($arr, $locid['location_master_id']);
			array_push($city_array, $locid['location_master_id']);
			$server_list .= $locid['location_server_id'] . ',';
		}

		if (!empty($city_array)) {
			$server_list = explode(',', substr($server_list, 0, -1));
			$serverips = location_server::whereIn('location_id', $city_array)->exists();
			if ($serverips) {
				$ips = location_server::whereIn('location_id', $city_array)->get()->toArray();
				foreach ($ips as $ip) {
					$fArray[$ip['location_id']][$ip['id']] = $ip;
				}
			} else {
				$fArray = array();
				// $fArray[$ip['location_id']][$ip['id']]=$ip;
			}
		} else {
			$fArray = array();
		}
		//dd($fArray);
		$json_val = json_encode($fArray);

		$locsel = location_master::select('id', 'location')->whereIn('id', $arr)->where('status', 1)->get()->toArray();
		//dd($locsel);
		return view('clients.edit_client')->with('clientid', $clientid)->with('location', $location)->with('client', $client)->with('arr', $arr)->with('serverids', $server_list)->with('selectedips', $fArray)->with('sellocname', $locsel)->with('json_val', $json_val);
	}

	public function updateclient(Request $request) {
		//dd($request->all());
		// $description=$request->desc;
		$validaterequest = $request->validate([
			'client_name' => 'required|max:50',
		]);

		try
		{
			$updateDetails = [
				'name' => $request->client_name,
				'description' => $request->desc,
			];
			$client = clients::find($request->clientid);
			$client->update($updateDetails);

			$location = $request->location;
			$avbl_server = $request->avbl_server;
			// dd($avbl_server);
			$master_feat = $allloc = array();
			if ($location) {
				foreach ($location as $k => $v) {
					array_push($allloc, $v);
					$master_feaat[$v]['feature'] = $v;
					$master_feaat[$v]['subfeatures'] = array();
				}
			}
			clientlocation_details::where('client_id', $request->clientid)
				->whereNotIn('location_master_id', $allloc)
				->delete();

			if ($avbl_server) {
				foreach ($avbl_server as $k => $v) {
					$valArr = explode('-', $v);
					if (isset($master_feaat[$valArr[1]]['feature'])) {
						$master_feaat[$valArr[1]]['subfeatures'][] = $valArr[0];
					}

				}
			}
			//if masterfeat not presesnt delete all the rows with that clientid
			// dd($master_feaat);
			if ($master_feaat) {
				foreach ($master_feaat as $msfKey => $msgVal) {

					$finalval = new clientlocation_details;
					$fetID = $msfKey;

					if (clientlocation_details::where('client_id', '=', $request->clientid)->where('location_master_id', '=', $fetID)->exists()) {

						// if a particular location id exists for a particular client,then update it
						if (!empty($msgVal['subfeatures'])) {
							$subfeatureID = implode(',', $msgVal['subfeatures']);
						} else {
							$subfeatureID = '';
						}
						clientlocation_details::where('client_id', '=', $request->clientid)
							->where('location_master_id', '=', $msgVal['feature'])
							->update(['location_server_id' => $subfeatureID]);
					} else {
						//if a particular location id doesnot exists for a particular client,then insert a new row
						$finalval = new clientlocation_details;

						foreach ($msgVal as $feturesData => $msgVal1) {
							$msgVal2 = (array) $msgVal1;
							$subVAL = array_values($msgVal2);
							$subfeatureID = implode(',', $subVAL);
							$finalval->client_id = $request->clientid;
							$finalval->location_master_id = $fetID;
							$finalval->location_server_id = $subfeatureID;
						}
						$finalval->save();
					}

				} //foreach masterfeat
			} //if masterfeat
			else {
				// if location not present
				clientlocation_details::where('client_id', '=', $request->clientid)->delete();
			}
		} //try
		 catch (Exception $ex) {
			dd($ex);
		}
//dd('done');
		return redirect('/allclients')->with('success', 'Updated Successfully');
	}

	// show roles according to client at the time of registration

}