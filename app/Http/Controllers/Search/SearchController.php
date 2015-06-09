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
		$uid = $request->input('uid');
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

		//return 'region='.$region.', lnt='.$lng.', lat='.$lat.', dlng='.$dlng.', dlat='.$dlat;
		
		if ($uid)
		{
			$ads = Ad::where('uid', $uid);
			$ads = $ads->where('status', 1)->paginate(10);

			return $ads->toJson();
		}
		else if ($type)
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
			$ads = $ads->where('status', 1)->paginate(10);

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
			$ads = $ads->where('status', 1)->paginate(10);
			
			return $ads->toJson();
		}
		else if ($keyword)
		{
			$ads = Ad::where('title', 'like', '%'.$keyword.'%');
			$ads = $ads->where('status', 1)->paginate(10);
			
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
		$id = $request->input('id');

		if ($id) {
			$userInfo = User::select('name', 'phone', 'address', 'longitude as lng', 'latitude as lat')->find($id);
			return $userInfo->toJson();
		} else {
			$allUserInfo = User::select('name', 'phone', 'address', 'longitude as lng', 'latitude as lat')->get();
			return $allUserInfo->toJson();
		}

	}

}
