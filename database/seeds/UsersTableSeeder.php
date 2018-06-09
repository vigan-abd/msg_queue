<?php

use Illuminate\Database\Seeder;
use App\Model\Domain\Enum\UserRoleEnum;
use App\Model\Domain\Enum\StoryStatusEnum;
use App\Model\Domain\Enum\ProductStatusEnum;
use App\Model\Domain\Enum\MediaTypeEnum;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1, 
            'name' => 'admin', 
            'email' => 'admin@example.com', 
            'username' => 'admin', 
            'role' => 'A',
            'password' => bcrypt('123456'), 
        ]);
    }
}
