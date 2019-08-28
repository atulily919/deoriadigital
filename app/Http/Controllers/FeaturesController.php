<?php

namespace App\Http\Controllers;
error_reporting(0);

use App\Http\Controllers\Controller;
use App\Models\clientfeatures;
use App\Models\clients;
use App\Models\feature;
use App\Models\sub_feature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FeaturesController extends Controller {
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function index() {
		$client_id = session('clientid');
		if ($client_id) {
			$allclients = clients::with('clientfeatures_details')->where('id', $client_id)->get()->toArray();
		} else {
			$allclients = clients::with('clientfeatures_details')->get()->toArray();

		}
		$feature = feature::get()->toArray();
//dd($location);
		return view('features.index')->with('allclients', $allclients)->with('feature', $feature);

	}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function create() {
		$clientfeat=clientfeatures::select('client_id')->groupby('client_id')->get()->toArray();

		//dd($clientfeat);	

		$client_id = session('clientid');
		if ($client_id) {
			$client_data = clients::where('id', $client_id)->whereNotIn('id',$clientfeat)->get();
		} else {
			$client_data = clients::whereNotIn('id',$clientfeat)->get();
		}

		//dd($client_data);
		$feature_data = feature::where('status', '1')->get();
		return view('features.create', compact('client_data', 'feature_data'));
	}

/**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
	public function store(Request $request) {
		$validaterequest = $request->validate([
			'name' => 'required|max:50',
			'features_id' => 'required',
		]);

		try
		{
			$fetures = $request->features_id;

			$master_feat = array();
			foreach ($fetures as $kkk => $vll) {
				$master_feaat[$vll]['feature'] = $vll;
				$master_feaat[$vll]['subfeatures'] = array();
			}
			$sub_features = $request->subfeatures_id;
			foreach ($sub_features as $kkk => $vlll) {
				$valArr = explode('@@', $vlll);
				if (isset($master_feaat[$valArr[1]]['feature'])) {
					$master_feaat[$valArr[1]]['subfeatures'][] = $valArr[0];
				}

			}

			foreach ($master_feaat as $msfKey => $msgVal) {
				$finalval = new clientfeatures;
				$fetID = $msfKey;
				$clientid = $request->name;
				foreach ($msgVal as $feturesData => $msgVal1) {

					$subVAL = array_values($msgVal1);

					$subfeatureID = implode(',', $subVAL);
					$finalval->client_id = $request->name;
					$finalval->features_id = $fetID;
					$finalval->subfeatures_id = $subfeatureID;
				}
				$finalval->save();
			}

		} catch (Exception $ex) {
			dd($ex);
		}
		return redirect('/clientfeatures')->with('success', 'Client Features Created Successfully');
	}

/**
 * Display the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function show($featuresData) {

		$featuresDatas = explode(',', $featuresData);
		$fetname = feature::select('id', 'features_name')->whereIn('id', $featuresDatas)->get()->toArray();
		foreach ($featuresDatas as $features_value) {
			foreach ($fetname as $f) {
				if ($f['id'] == $features_value) {
					$features = $f['features_name'];
				}
			}
			$subFeatures['data'][$features_value . '-' . $features] = sub_feature::select('id', 'sub_features_name')->where('features_id', '=', $features_value)->where('status', '1')->get();
		}
		echo json_encode($subFeatures);
	}

/**
 * Show the form for editing the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function edit(Request $request, $id, $data) {
		$b = json_decode($data);
		dd($b);
	}

/**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function update(Request $request, $id) {
//
	}

/**
 * Remove the specified resource from storage.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
	public function destroy($id) {
//
	}
	public function showsubfeature(Request $request) {
// dd($request->all());

		$subfeatures[] = array();
		$finalfeatures = array();
		$id = $request['featureid'];
		$clientid = $request['clientid'];
		$featureid = clientfeatures::select('subfeatures_id')->where('features_id', $id)->where('client_id', $clientid)->where('status', 1)->first()->toArray();

		$arr = explode(',', $featureid['subfeatures_id']);
//dd($arr);
		foreach ($arr as $a) {
			$clientfeatures[] = sub_feature::select('sub_features_name', 'id')->where('id', $a)->where('status', '1')->get()->toArray();

		}
// dd($clientfeatures);
		echo json_encode($clientfeatures);
	}

	public function getAllsubfeatures(Request $request) {
		$featureid = $request->featureid;
		$Allsubfeatures = sub_feature::where('features_id', $featureid)->get();

		echo json_encode($Allsubfeatures);

	}
	public function deletefeaturerow(Request $request) {

		$clientid = $request['id'];
// dd($clientid);
		$delclid = clientfeatures::where('client_id', $clientid)->delete();
		if ($delclid) {
			return "true";
		} else {
			return "false";
		}
	}

	public function editSubfeatures(Request $request) {
		$features_id = $request->featureid;
		$client_id = $request->clientid;
		if (isset($request['subfeatures'])) {
			$subFeatures = $request->subfeatures;
			$subFeatures = implode(',', $subFeatures);
			$updatestatus = clientfeatures::where('client_id', $client_id)->where('features_id', $features_id)->update(['subfeatures_id' => $subFeatures]);
			return redirect('/clientfeatures')->with('message', 'SubFeature List edited successfully');
		} else {
			$deletefeature = clientfeatures::where('client_id', $client_id)->where('features_id', $features_id)->delete();

			return redirect('/clientfeatures')->with('success', 'Client Feature Deleted Successfully');
		}

	}

	public function editclientfeatures(Request $request, $clientid) {

		$client_data = clients::all();
		$features = feature::where('status', 1)->get();
		$client = clients::with('clientfeatures_details')->where('id', $clientid)->get()->toArray();
		$feature_array = $arr = array();
		$server_list = '0,';
// dd($client);

		foreach ($client[0]['clientfeatures_details'] as $fetid) {
			array_push($arr, $fetid['features_id']);
			array_push($feature_array, $fetid['features_id']);
			$subfeature_list .= $fetid['subfeatures_id'] . ',';
		}
		if (!empty($feature_array)) {
			$subfeature_list = explode(',', substr($subfeature_list, 0, -1));
			$subfeatures_val = sub_feature::whereIn('features_id', $feature_array)->exists();
			if ($subfeatures_val) {
				$ips = sub_feature::whereIn('features_id', $feature_array)->get()->toArray();
				foreach ($ips as $ip) {
					$fArray[$ip['features_id']][$ip['id']] = $ip;
				}
			} else {
				$fArray = array();
			}
		} else {
			$fArray = array();
// dd($fArray);
		}
		$json_val = json_encode($fArray);

		return view('features.edit')->with('client_data', $client_data)->with('clientid', $clientid)->with('features', $features)->with('client', $client)->with('arr', $arr)->with('subfeature_list', $subfeature_list)->with('selectedfet', $fArray)->with('json_val', $json_val);

	}

	public function editfeatures(Request $request) {

//dd($request);

		$allval = array_diff($request['selectedFeatures'], $request['fet_id']);
		$selectedfeatures = $request['fet_id'];

		foreach ($selectedfeatures as $selfet) {
			$serverips['selectedfet'][$selfet] = sub_feature::select('id', 'sub_features_name')->where('features_id', '=', $selfet)->where('status', '1')->get();
		}

		foreach ($allval as $loc) {
			$serverips['data'][$loc] = sub_feature::select('id', 'sub_features_name')->where('features_id', '=', $loc)->where('status', '1')->get();
		}
		echo json_encode($serverips);
	}

	public function updateclientfeatures(Request $request) {

		$validaterequest = $request->validate([
			'name' => 'required|max:50',
		]);
		try
		{
			$features = $request->features_id;
			$subfeatures_id = $request->subfeatures_id;
			$master_feat = $allfet = array();
			if ($features) {
				foreach ($features as $k => $v) {
					array_push($allfet, $v);
					$master_feaat[$v]['feature'] = $v;
					$master_feaat[$v]['subfeatures'] = array();
				}
			}
			clientfeatures::where('client_id', '=', $request->clientid)
				->whereNotIn('features_id', $allfet)
				->delete();
			if ($subfeatures_id) {
				foreach ($subfeatures_id as $k => $v) {
					$valArr = explode('-', $v);
					if (isset($master_feaat[$valArr[1]]['feature'])) {
						$master_feaat[$valArr[1]]['subfeatures'][] = $valArr[0];
					}
				}
			}
			if ($master_feaat) {
				foreach ($master_feaat as $msfKey => $msgVal) {
// dd($msgVal);
					$finalval = new clientfeatures;
					$fetID = $msfKey;
					if (clientfeatures::where('client_id', '=', $request->clientid)->where('features_id', '=', $fetID)->exists()) {

// if a particular location id exists for a particular client,then update it
						if (!empty($msgVal['subfeatures'])) {
							$subfeatureID = implode(',', $msgVal['subfeatures']);
						} else {
							$subfeatureID = '';
						}

						clientfeatures::where('client_id', '=', $request->clientid)
							->where('features_id', '=', $msgVal['feature'])
							->update(['subfeatures_id' => $subfeatureID]);
					} else {
//if a particular location id doesnot exists for a particular client,then insert a new row
						$finalval = new clientfeatures;
						foreach ($msgVal as $feturesData => $msgVal1) {
							$msgVal2 = (array) $msgVal1;
							$subVAL = array_values($msgVal2);
							$subfeatureID = implode(',', $subVAL);
							$finalval->client_id = $request->clientid;
							$finalval->features_id = $fetID;
							$finalval->subfeatures_id = $subfeatureID;
						}
						$finalval->save();
					}

				}
			} else {
// if location not present
				clientfeatures::where('client_id', '=', $request->clientid)->delete();
			}
		} catch (Exception $ex) {
			dd($ex);
		}
		return redirect('/clientfeatures')->with('success', 'Clients Features Updated');
	}
	public function ajaxeditclientfeatures($selfeaturesid, Request $request) {
		$featuresid = explode(',', $selfeaturesid);
		$featuresdetails = feature::whereIn('id', $featuresid)->get()->toArray();
//dd($featuresname);
		$subfeatures = sub_feature::whereIn('features_id', $featuresid)->get()->toArray();
//dd($subfeatures);
		$selectedsubfeat = clientfeatures::where('client_id', $request->clientid)->get()->toArray();
//dd($selectedsubfeat);
		$selrecords = array();
		$allrecords = array();
		$records = array();
		foreach ($selectedsubfeat as $selsubfeat) {
			if (!empty($selsubfeat['subfeatures_id'])) {
				$selrecords[$selsubfeat['features_id']] = explode(',', $selsubfeat['subfeatures_id']);
			}
		}
		foreach ($featuresdetails as $feat) {
//print_r($feat);
			foreach ($subfeatures as $subfeat) {

				if ($subfeat['features_id'] == $feat['id']) {
//print_r($feat);

					$allRecords[$feat['id'] . '-' . $feat['features_name']][] = $subfeat['id'] . '-' . $subfeat['sub_features_name'];

					if (!empty($selrecords)) {

						foreach ($selrecords as $key => $value) {
							if ($key == $feat['id']) {
								if (in_array($subfeat['id'], $value)) {

									$allrecords[$feat['id'] . '-' . $feat['features_name']][] = $subfeat['id'] . '-' . $subfeat['sub_features_name'] . '-selected';
								} else {
									$allrecords[$feat['id'] . '-' . $feat['features_name']][] = $subfeat['id'] . '-' . $subfeat['sub_features_name'];
								}
							}

						}
					} else {
						$allrecords[$feat['id'] . '-' . $feat['features_name']][] = $subfeat['id'] . '-' . $subfeat['sub_features_name'];
					}
				}

//$subfeat['features_id']
			}

		}
		foreach ($allRecords as $rec => $value) {
			foreach ($allrecords as $selrec => $val) {
				if ($rec == $selrec) {

					$allRecords[$rec] = array_replace($allRecords[$rec], $allrecords[$selrec]);

				}

			}
		}
		$records['selrecords'] = $selrecords;
		$records['allrecords'] = $allRecords;

		echo json_encode($records);

	}
}