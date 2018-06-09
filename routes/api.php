<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'mq', 'middleware' => ['api']], function (){
    /***************************************************************************//** 
     * @brief Message Queue Routes
     * 
     * Routes for reading data for stories
     ******************************************************************************/
    Route::post('/enqueue/{queue}', ['uses' => 'Api\MQ\MQController@enqueue', 'as' => 'mq.enqueue']);
    Route::post('/enqueue/{queue}/many', ['uses' => 'Api\MQ\MQController@enqueueMany', 'as' => 'mq.enqueue.many']);
    Route::get('/dequeue/{queue}', ['uses' => 'Api\MQ\MQController@dequeue', 'as' => 'mq.dequeue']);
    Route::get('/dequeue/{queue}/many', ['uses' => 'Api\MQ\MQController@dequeueMany', 'as' => 'mq.dequeue.many']);
    Route::get('/dequeue/{queue}/limit/{limit}', ['uses' => 'Api\MQ\MQController@dequeueWithLimit', 'as' => 'mq.dequeue.limit']);
    /***************************************************************************//** 
     * @endOf Message Queue Routes
     ******************************************************************************/
});