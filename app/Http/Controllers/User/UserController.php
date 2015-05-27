<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Input, Redirect;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('user.home');
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
		//
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
	 * Display personal information of user.
	 *
	 * @return Response
	 */
	public function getInfo()
	{
		return view('user.info');
	}

	/**
	 * Update personal information of user.
	 *
	 * @return Response
	 */
	public function postInfo(Request $request)
	{
		$this->validate($request, [
			'address' => 'required|max:255',
        ]);

        $user = User::find(Input::get('id'));
        $user->address = Input::get('address');
        //$user->address = Input::get('address');
        //$user->longitude = Input::get('longitude');
        //$user->latitude = Input::get('latitude');//Auth::user()->id;

        if ($user->save()) {
            return Redirect::back();
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
	}

}
