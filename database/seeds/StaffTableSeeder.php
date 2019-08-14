<?php

use App\Models\User;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 为 staff 绑定用户账号
        $user_ids = User::where('id', '>', 4)->pluck('id')->toArray();
        // 为 staff 分配管理经理
        $administrator_ids = [2, 3, 4];

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $staff = factory(Staff::class)
                    ->times(16)
                    ->make()
                    ->each(function ($staff, $index) use ($user_ids, $administrator_ids, $faker){
                        $staff->user_id = $faker->unique()->randomElement($user_ids);
                        $staff->administrator_id = $faker->randomElement($administrator_ids);
                    });
        Staff::insert($staff->toArray());
    }
}
