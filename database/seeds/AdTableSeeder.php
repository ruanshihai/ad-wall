<?php

use Illuminate\Database\Seeder;  
use App\Ad;

class AdTableSeeder extends Seeder {

  public function run()
  {
    DB::table('ads')->delete();

    $imgs = array('2015-06-09-06-45-14-465.png', '2015-06-09-11-42-59-111.png', '2015-06-09-11-43-32-544.png',
                  '2015-06-09-12-02-11-636.png', '2015-06-09-12-02-26-650.png', '2015-06-09-12-02-42-669.png',
                  '2015-06-09-12-03-02-88.png', '2015-06-09-12-03-18-933.gif');

    for ($i=1; $i <= 5000; $i++) {
      Ad::create([
        'uid'         => $i%200+1,
        'title'       => 'Title ('.$i.')',
        'type'        => $i%2,
        'img_path'    => $imgs[$i%8],
        'content'     => 'Content ('.$i.')',
        'uname'       => 'Uname ('.($i%200+1).')',
        'longitude'   => 113.398238+($i%200+1)/5000,
        'latitude'    => 23.06668+($i%200+1)/5000,
        'begin_at'    => '2015-07-'.($i%31+1),
        'end_at'      => '2015-08-'.($i%31+1),
        'status'      => $i%4,
        'page_view'   => 0,
        'page_click'  => 0,
      ]);
    }
  }

}
