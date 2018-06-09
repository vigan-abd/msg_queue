<?php
namespace App\Service\MessageQueue;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Used to setup queue model
 * 
 * @version 1.0.0
 * @author vigan.abd <vigan.abd@gmail.com>
 */
class QueueSetup
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function up()
    {
        Schema::create('message_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('queue')->default('');
            $table->text('message')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public static function down()
    {
        Schema::drop('message_queue');
    }
}
?>