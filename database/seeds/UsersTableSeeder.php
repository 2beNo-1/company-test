<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成数据集合
        $users = factory(User::class)->times(20)->make();
        // 插入数据库
        User::insert($users->toArray());

        $user = User::find(1);
        $user->assignRole('CEO');
        $user->name = 'CEO';
        $user->email = 'CEO@mail.com';
        $user->password = \Hash::make('ceo@123456');
        $user->save();

        for ($i = 2; $i < 5; $i++){
            $user = User::find($i);
            $user->assignRole('Manager');
            $user->name = 'admin' . $i;
            $user->email = 'admin' . $i . '@mail.com';
            $user->password = \Hash::make('admin' . $i .'@123456');
            $user->save();
        }
    }
}
