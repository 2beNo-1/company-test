<?php

use App\Models\Work;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class WorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成员工 id 数组
        $staff_ids = Staff::all()->pluck('id')->toArray();
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $works = factory(Staff::class)
                    ->times(30)
                    ->make()
                    ->each(function ($work, $index) use ($faker, $staff_ids){
                        $work->staff_id = $faker->randomElement($staff_ids);
                        $work->content = $faker->sentence();
                    });
        Work::insert($works->toArray());
    }
}
