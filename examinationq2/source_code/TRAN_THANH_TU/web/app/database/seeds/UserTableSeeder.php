<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        for ($i = 1; $i < 10; $i ++) {
            $insertItems = [
                'full_name' => 'nguyen van '.$i,
                'username' => 'admin'.$i,
                'password' =>  Hash::make('123456'),
                'email' =>'admin'.$i.'@gmail.com',
                'remember_token' => null,
                'is_admin' => 1,
                'is_active'=> 1
            ];
            DB::table('users')->insert($insertItems);
        }
    }

}