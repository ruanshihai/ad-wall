<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('uid')->unsigned();
			$table->string('title');
			$table->string('img_path');
			$table->integer('type')->unsigned();
			$table->text('content');
			$table->string('uname');
			$table->float('longitude');
			$table->float('latitude');
			$table->date('begin_at');
			$table->date('end_at');
			$table->integer('status')->unsigned()->default(0);
			$table->integer('page_view')->unsigned()->default(0);
			$table->integer('page_click')->unsigned()->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ads');
	}

}
