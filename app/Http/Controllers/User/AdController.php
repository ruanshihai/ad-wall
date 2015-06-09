<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Ad;

use Redirect, Input, Auth;

class AdController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::to('user/ad/create');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user.ad.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
            'title' => 'required|max:255',
            'type' => 'required',
            'begin_at' => 'required|date',
            'end_at' => 'required|date',
            'content' => 'required',
        ]);

        $ad = new Ad;
        $ad->uid = Auth::user()->id;
        $ad->uname = Auth::user()->name;
        $ad->longitude = Auth::user()->longitude;
        $ad->latitude = Auth::user()->latitude;
        $ad->title = Input::get('title');
        $ad->type = Input::get('type');
        $ad->status = 0;
        $ad->begin_at = Input::get('begin_at');
        $ad->end_at = Input::get('end_at');
        $ad->content = Input::get('content');

        // 广告封面图片
        if ($file = $_FILES['img']['name'] != '')
        {
            if (($_FILES['img']['type']=='image/gif' || $_FILES['img']['type']=='image/jpg' 
            	|| $_FILES['img']['type']=='image/jpeg' || $_FILES['img']['type']=='image/bmp' 
            	|| $_FILES['img']['type']=='image/png') 
                && ($_FILES['img']['size']<5120000))
            {
                $fname = date('Y-m-d-H-i-s', time()).'-'.mt_rand(0, 1000);
                $info = pathinfo($_FILES['img']['name']);
                $extension = strtolower($info['extension']);

                if ($_FILES['img']['error']>0){
                    return Redirect::back()->withInput()->withErrors('图片上传错误！');
                }
                else
                {
                    if (!file_exists('uploads/pictures/'.$fname.'.'.$extension))
                    {
                        $img_r = '';
                        if ($extension=='gif')
                            $img_r = imagecreatefromgif($_FILES['img']['tmp_name']);
                        elseif ($extension=='jpg' || $extension=='jpeg')
                            $img_r = imagecreatefromjpeg($_FILES['img']['tmp_name']);
                        elseif ($extension=='png')
                            $img_r = imagecreatefrompng($_FILES['img']['tmp_name']);
                        elseif ($extension=='bmp')
                            $img_r = imagecreatefromwbmp($_FILES['img']['tmp_name']);
                        list($width, $height) = getimagesize($_FILES['img']['tmp_name']);
                        $dst_r = ImageCreateTrueColor(200, 150);
                        imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, 200, 150, $width, $height);
                        header('Content-Type:'.$_FILES['img']['type']);
                        imagejpeg($dst_r, 'uploads/pictures/'.$fname.'.'.$extension, 100);
                        imagedestroy($img_r);
                        imagedestroy($dst_r);
                    }
                    else
                    {
                        return Redirect::back()->withInput()->withErrors('图片文件命名冲突，请重新上传！');
                    }
                    $ad->img_path = $fname.'.'.$extension;
                }
            }
            else{
                return Redirect::back()->withInput()->withErrors('图片格式不接受或文件太大！');
            }
        }

        if ($ad->save()) {
            return Redirect::to('user/ad/waiting-list');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('user.ad.show')->withAd(Ad::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('user.ad.edit')->withAd(Ad::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
            'title' => 'required|max:255',
            'type' => 'required',
            'begin_at' => 'required|date',
            'end_at' => 'required|date',
            'content' => 'required',
        ]);

        $ad = Ad::find($id);
        if ($ad) {
	        $ad->title = Input::get('title');
        	$ad->type = Input::get('type');
	        $ad->begin_at = Input::get('begin_at');
	        $ad->end_at = Input::get('end_at');
	        $ad->content = Input::get('content');
	        // 已回绝情况下可以修改广告信息变更为待复核状态
	        if ($ad->status == 2) {
	        	$ad->status = 3;
	        }

	        // 广告封面图片
	        if ($file = $_FILES['img']['name'] != '')
	        {
	            if (($_FILES['img']['type']=='image/gif' || $_FILES['img']['type']=='image/jpg' 
	            	|| $_FILES['img']['type']=='image/jpeg' || $_FILES['img']['type']=='image/bmp' 
	            	|| $_FILES['img']['type']=='image/png') 
	                && ($_FILES['img']['size']<5120000))
	            {
	                $fname = date('Y-m-d-H-i-s', time()).'-'.mt_rand(0, 1000);
	                $info = pathinfo($_FILES['img']['name']);
	                $extension = strtolower($info['extension']);

	                if ($_FILES['img']['error']>0){
	                    return Redirect::back()->withInput()->withErrors('图片上传错误！');
	                }
	                else
	                {
	                    if (!file_exists('uploads/pictures/'.$fname.'.'.$extension))
	                    {
	                        $img_r = '';
	                        if ($extension=='gif')
	                            $img_r = imagecreatefromgif($_FILES['img']['tmp_name']);
	                        elseif ($extension=='jpg' || $extension=='jpeg')
	                            $img_r = imagecreatefromjpeg($_FILES['img']['tmp_name']);
	                        elseif ($extension=='png')
	                            $img_r = imagecreatefrompng($_FILES['img']['tmp_name']);
	                        elseif ($extension=='bmp')
	                            $img_r = imagecreatefromwbmp($_FILES['img']['tmp_name']);
	                        list($width, $height) = getimagesize($_FILES['img']['tmp_name']);
	                        $dst_r = ImageCreateTrueColor(200, 150);
	                        imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, 200, 150, $width, $height);
	                        header('Content-Type:'.$_FILES['img']['type']);
	                        imagejpeg($dst_r, 'uploads/pictures/'.$fname.'.'.$extension, 100);
	                        imagedestroy($img_r);
	                        imagedestroy($dst_r);
	                    }
	                    else
	                    {
	                        return Redirect::back()->withInput()->withErrors('图片文件命名冲突，请重新上传！');
	                    }
	                    $ad->img_path = $fname.'.'.$extension;
	                }
	            }
	            else{
	                return Redirect::back()->withInput()->withErrors('图片格式不接受或文件太大！');
	            }
	        }

        	if ($ad->save()) {
	            return Redirect::to('user/ad/waiting-list');
	        } else {
	            return Redirect::back()->withInput()->withErrors('修改信息失败！');
	        }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$ad = Ad::find($id);
		if ($ad) {
			$ad->delete();
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
		$ads = Ad::whereRaw('uid = ? and (status = ? or status = ?)', [Auth::user()->id, 0, 3])->orderBy('created_at', 'desc')->paginate(10);

		return view('user.ad.waitinglist')->withAds($ads);
	}

	/**
	 * Display a listing of the passed ads.
	 *
	 * @return Response
	 */
	public function getPassedList()
	{
		$ads = Ad::whereRaw('uid = ? and status = ?', [Auth::user()->id, 1])->orderBy('created_at', 'desc')->paginate(10);
		
		return view('user.ad.passedlist')->withAds($ads);
	}

	/**
	 * Display a listing of the rejected ads.
	 *
	 * @return Response
	 */
	public function getRejectedList()
	{
		$ads = Ad::whereRaw('uid = ? and status = ?', [Auth::user()->id, 2])->orderBy('created_at', 'desc')->paginate(10);

		return view('user.ad.rejectedlist')->withAds($ads);
	}

}
