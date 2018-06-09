<?php

use Illuminate\Database\Seeder;
use App\Model\Domain\Enum\UserRoleEnum;
use App\Model\Domain\Enum\StoryStatusEnum;
use App\Model\Domain\Enum\ProductStatusEnum;
use App\Model\Domain\Enum\MediaTypeEnum;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}
