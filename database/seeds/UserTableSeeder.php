<?php

use Illuminate\Database\Seeder;  
use App\User;

class UserTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

    for ($i=0; $i < 20; $i++) {
      User::create([
        'name'		=> 'person'.$i,
        'email'		=> $i.'@qq.com',
        'password'	=> 'w8yjkhsadjskdfhfshjkhsahasdkljasdddddddddddddddsajkdbahewjsd'	,
        'type'		=> 1,
        'address'	=> 'Sun Yat-sen University',
        'longitude' => 110.15+$i,
        'latitude'  => 28.21+$i,
      ]);
    }
  }

}
