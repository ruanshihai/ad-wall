<?php

use Illuminate\Database\Seeder;  
use App\User;

class UserTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

    for ($i=1; $i <= 200; $i++) {
      User::create([
        'name'		=> 'Uname'.$i,
        'email'		=> $i.'@qq.com',
        'password'	=> 'w8yjkhsadjskdfhfshjkhsahasdkljasdddddddddddddddsajkdbahewjsd'	,
        'type'		=> 1,
        'phone' => '13824477'.($i+100),
        'address'	=> 'Sun Yat-sen University ('.$i.')',
        'longitude' => 113.398238+$i/5000,
        'latitude'  => 23.06668+$i/5000,
      ]);
    }
  }

}
