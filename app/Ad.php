<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model {

	protected $fillable = ['uid', 'title', 'img_path', 'type', 'content', 'uname', 'longitude', 'latitude',
							'begin_at', 'end_at', 'status', 'page_view', 'page_click'];

}
