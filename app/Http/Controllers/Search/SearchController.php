<?php namespace App\Http\Controllers\Search;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Ad;

use Redirect, Input, DB;

class SearchController extends Controller {

	/**
	 * Get the ads for search based on type, (longitude, latitude, region) or keyword.
	 *
	 * @return Json
	 */
	public function getSearchAds(Request $request)
	{
		$type = $request->input('type');
		$region = $request->input('region', 0.2);
		$lng = $request->input('lng');
		$lat = $request->input('lat');
		$keyword = $request->input('keyword');

		$earthRadius = 6378.138;
		$dlng =  2 * asin(sin($region / (2 * $earthRadius)) / cos(deg2rad($lat)));
		$dlng = rad2deg($dlng);
		$dlat = $region/$earthRadius;
		$dlat = rad2deg($dlat);
		
		if ($type)
		{
			$ads = Ad::where('type', $type);
			if ($lng && $lat)
			{
				$ads = $ads->whereBetween('longitude', [$lng-$dlng, $lng+$dlng])
							->whereBetween('latitude', [$lat-$dlat, $lat+$dlat]);
			}
			if ($keyword)
			{
				$ads = $ads->where('title', 'like', '%'.$keyword.'%');
			}
			$ads = $ads->paginate(10);

			return $ads->toJson();
		}
		else if ($lng && $lat)
		{
			$ads = Ad::whereBetween('longitude', [$lng-$dlng, $lng+$dlng])
						->whereBetween('latitude', [$lat-$dlat, $lat+$dlat]);
			if ($keyword)
			{
				$ads = $ads->where('title', 'like', '%'.$keyword.'%');
			}
			$ads = $ads->paginate(10);
			
			return $ads->toJson();
		}
		else if ($keyword)
		{
			$ads = Ad::where('title', 'like', '%'.$keyword.'%');
			$ads = $ads->paginate(10);
			
			return $ads->toJson();
		}
	}

	/**
	 * Get the information of an user by id.
	 *
	 * @return Json
	 */
	public function getUserInfo(Request $request)
	{
		$userInfo = User::select('name', 'address', 'longitude as lng', 'latitude as lat')->find($request->input('id'));

		return $userInfo->toJson();
	}

}
