<?php

namespace App\Http\Controllers;

use App\Models\clientfeatures;
use App\Models\feature;
use App\Models\sub_feature;
use DB;
use Illuminate\Http\Request;

class AllFeaturesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$features = feature::all();
		return view('Allfeatures.index', compact('features'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('Allfeatures.create');
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
			'features_name' => 'required',
		]);
		$data = array();
		$subFeatures = $request->sub_features_name;
		$all_features = new feature;
		$all_features->features_name = $request->features_name;
		$all_features->created_at = date('Y-m-d H:i:s');
		$all_features->updated_at = date('Y-m-d H:i:s');
		$all_features->save();
		$allFeatures_data = feature::where('features_name', $request->features_name)->orderBy('created_at', 'DESC')->first();
		if (($subFeatures)) {
			// dd($subFeatures[0]);
			$subFeatures = $request->sub_features_name;
			foreach ($subFeatures as $key => $subFeatures_data) {
				if ($subFeatures_data != null) {
					$data['features_id'] = $allFeatures_data->id;
					$data['sub_features_name'] = $subFeatures_data;
					$data['created_at'] = date('Y-m-d H:i:s');
					$data['updated_at'] = date('Y-m-d H:i:s');
					sub_feature::insert($data);
				}

			}
		}
		return redirect('/allfeatures')->with('success', 'Features added successfully');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$subfeatures_details = feature::with('subfeatures')->find($id)->toArray();
		return view('Allfeatures.edit', compact('subfeatures_details'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'features_name' => 'required',
		]);
		// dd($request->all());
		$subfeatures_formvalue = $request->sub_features_name;
		$subfeaturesName = $request->sub_features_name;
		if ($request->features_name) {
			feature::where('id', $id)->update(['features_name' => $request->features_name]);
		}
		if ($subfeatures_formvalue) {

			foreach ($subfeatures_formvalue as $key => $subfeaturesform_value) {

				// print_r($key);
				// echo "<br/>";
				$val = sub_feature::where('features_id', $id)->where('id', $key)->exists();
				if ($val) {
					$val = sub_feature::where('features_id', $id)->where('id', $key)->get();
					foreach ($val as $subval) {
						//print_r($subval['id']);

						if ($subval['id'] == $key && !empty($subfeaturesform_value)) {

							sub_feature::where('id', $key)->update(['sub_features_name' => $subfeaturesform_value]);
						} elseif ($subval['id'] == $key && empty($subfeaturesform_value)) {

							$deletesubfeatures = sub_feature::where('features_id', $id)->where('id', $key)->delete();
							$clientval = clientfeatures::select('subfeatures_id')->where('features_id', $id)->get();
							if ($clientval) {
								foreach ($clientval as $clientvalue) {

									$clientvalue = explode(',', $clientvalue['subfeatures_id']);
									$deleteval = array_search($key, $clientvalue);
									unset($clientvalue[$deleteval]);
									$updatesub_features = implode(',', $clientvalue);
									$clientval = DB::table("clientfeatures_details")
										->whereRaw("FIND_IN_SET('$key',subfeatures_id) > 0")
										->where("features_id", $id)
										->select("id")
										->get();

									if (!empty($clientval)) {
										foreach ($clientval as $client_value) {
											clientfeatures::where('id', $client_value->id)->update(['subfeatures_id' => $updatesub_features]);
										}

									}
								}
							}
						}
					}
				} else {
					$data['features_id'] = $id;
					$data['sub_features_name'] = $subfeaturesform_value;
					$data['created_at'] = date('Y-m-d H:i:s');
					$data['updated_at'] = date('Y-m-d H:i:s');
					sub_feature::insert($data);
				}

			}
		}

		return redirect('/allfeatures')->with('success', 'Feature Updated Successfully');

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
	public function changeStatus($id) {
		//dd($id);
		$selectfeature = feature::where('id', $id)->get()->toArray();
		if ($selectfeature[0]['status'] == "1") {
			$updatestatus = feature::where('id', $id)->update(['status' => 0]);
		} else {
			$updatestatus = feature::where('id', $id)->update(['status' => 1]);

		}
		return redirect('/allfeatures')->with('info', 'Status Changed');

	}

	public function showallsubfeatures(Request $request) {
		// dd($request);
		$featureid = $request->featureid;
		$subfeatures = sub_feature::where('features_id', $featureid)->where('status', '1')->get()->toArray();
		echo json_encode($subfeatures);
	}
	public function savesubfeatures(Request $request) {

		$getlist = sub_feature::where('features_id', $request['featureid'])->get()->toArray();

		// dd($request);

		foreach ($getlist as $list) {
			$id = $list['id'];
			if (isset($request['subfeatures_' . $id])) {
				if ($request['subfeatures_' . $id] == $list['id']) {
					$updatestatus = sub_feature::where('id', $list['id'])->update(['status' => 1]);
				}
			} else {
				$updatestatus = sub_feature::where('id', $list['id'])->update(['status' => 0]);
			}
		}
		return redirect('/allfeatures');
	}

	public function deleteallfeatures(Request $request) {
		// dd($request->all());
		$id = $request->id;
		$features = array();
		$features_subfeatures = sub_feature::where('features_id', $id)->exists();
		if ($features_subfeatures) {
			$subfeatures = sub_feature::where('features_id', $id)->delete();
		}
		$features = feature::find($id)->delete();
		if ($features || $subfeatures) {
			return "true";

		}

	}

}
