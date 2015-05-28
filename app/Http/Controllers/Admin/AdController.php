<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Ad;

use Redirect, Input, Auth;
use DB, URL;

class AdController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::to('admin/ad/waiting-list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('admin.ad.show')->withAd(Ad::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getPass($id)
	{
		$ad = Ad::find($id);
		if ($ad) {
			$ad->status = 1;
			if ($ad->save()) {
				return Redirect::To('admin/ad/waiting-list');
			}
		}

		return Redirect::back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getReject($id)
	{
		$ad = Ad::find($id);
		if ($ad) {
			$ad->status = 2;
			if ($ad->save()) {
				return Redirect::To('admin/ad/waiting-list');
			}
		}

		return Redirect::back();
	}

	/**
	 * Display a listing of the ads in waiting queue.
	 *
	 * @return Response
	 */
	public function getWaitingList()
	{
		$ads = Ad::whereRaw('status = ? or status = ?', [0, 3])->orderBy('created_at', 'desc')->paginate(10);

		return view('admin.ad.waitinglist')->withAds($ads);
	}

	/**
	 * Display a listing of the passed ads.
	 *
	 * @return Response
	 */
	public function getPassedList()
	{
		$ads = Ad::whereRaw('status = ?', [1])->orderBy('created_at', 'desc')->paginate(10);
		
		return view('admin.ad.passedlist')->withAds($ads);
	}

	/**
	 * Display a listing of the rejected ads.
	 *
	 * @return Response
	 */
	public function getRejectedList()
	{
		$ads = Ad::whereRaw('status = ?', [2])->orderBy('created_at', 'desc')->paginate(10);

		return view('admin.ad.rejectedlist')->withAds($ads);
	}

}
