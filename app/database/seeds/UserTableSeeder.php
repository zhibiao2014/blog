<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $user = array(
            'username' => 'hongmin',
            'password' => Hash::make('20140210'),
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
    }

}
