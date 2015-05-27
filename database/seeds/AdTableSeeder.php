<?php

use Illuminate\Database\Seeder;  
use App\Ad;

class AdTableSeeder extends Seeder {

  public function run()
  {
    DB::table('ads')->delete();

    for ($i=0; $i < 100; $i++) {
      Ad::create([
        'uid'         => $i%20+1,
        'title'       => 'Title '.$i,
        'type'        => $i%3,
        'img_path'    => 'Path '.$i,
        'content'     => 'Content '.$i,
        'uname'       => 'uname is NULL',
        'longitude'   => 108.0,
        'latitude'    => 80.0,
        'begin_at'    => '2015-05-24',
        'end_at'      => '2015-06-01',
        'status'      => 0,
        'page_view'   => 0,
        'page_click'  => 0,
      ]);
    }
  }

}
