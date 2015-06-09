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
			//'phone' => 'required|regex:/^1[3-5,8]{1}[0-9]{9}$/|regex:/^([0-9]{3,4}-)?[0-9]{7,8}$/',
			'phone' => 'required|max:12',
			'address' => 'required|max:255',
        ]);

        $user = User::find(Input::get('id'));
        $user->name = Input::get('name');
        $user->phone = Input::get('phone');
        $user->address = Input::get('address');
        $user->longitude = Input::get('longitude');
        $user->latitude = Input::get('latitude');

        if ($user->save()) {
            return Redirect::back();
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
	}

}
