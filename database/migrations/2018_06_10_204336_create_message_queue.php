<?php

use App\Service\MessageQueue\QueueSetup;
use Illuminate\Database\Migrations\Migration;

class CreateMessageQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        QueueSetup::up();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        QueueSetup::down();
    }
}
