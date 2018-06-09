<?php
namespace App\Service\MessageQueue;

use Illuminate\Support\Facades\DB;

/**
 * Used to handle message queues (FIFO Queue)
 * 
 * @version 1.0.0
 * @author vigan.abd <vigan.abd@gmail.com>
 */
class QueueHandle
{
    protected function __construct() 
    {
        //private constructor
    }

    /**
     * Enques an array of messages to queue channel
     *
     * @param mixed $messages Array of messages
     * @param string $queue Queue identifier
     * @return void
     */
    public static function enqueueMany($messages, string $queue)
    {
        foreach($messages as $message)
        {
            static::enqueue($message, $queue);
        }
    }

    /**
     * Enques a message to queue channel
     *
     * @param mixed $message Message that will be enqued
     * @param string $queue Queue identifier
     * @return void
     */
    public static function enqueue($message, string $queue)
    {
        $model = new QueueMessage();
        $model->fill([
		    'queue' => $queue,
		    'message' => json_encode($message)
        ]);
        $model->save();
    }

    /**
     * Deques a message from queue channel and deletes the message forever
     *
     * @param string $queue Queue identifier
     * @return \App\Service\MessageQueue\QueueResponse
     */
    public static function dequeue(string $queue)
    {
        $model = QueueMessage::where('queue', $queue)
            ->oldest()
            ->first();
        if(empty($model))
        {
            throw new \Exception("Queue is empty!");
        }
        $message = new QueueResponse($model->queue, json_decode($model->message));
        QueueMessage::destroy($model->id);

        return $message;
    }

    /**
     * Deques all messages from queue channel and deletes the messages forever
     *
     * @param string $queue Queue identifier
     * @return \App\Service\MessageQueue\QueueResponse[]
     */
    public static function dequeueMany(string $queue)
    {
        $models = QueueMessage::where('queue', $queue)
            ->get();
        
        if(count($models) == 0)
        {
            throw new \Exception("Queue is empty!");
        }

        $messages = [];
        foreach($models as $model)
        {
            $messages[] = new QueueResponse($model->queue, json_decode($model->message));
        }

        DB::table('message_queue')
            ->where('queue', $queue)
            ->delete();
        
        return $messages;
    }


    /**
     * Deques all messages from queue channel and deletes the messages forever
     *
     * @param string $queue Queue identifier
     * @param int $limit Max amount of messages
     * @return \App\Service\MessageQueue\QueueResponse[]
     */
    public static function dequeueWithLimit(string $queue, int $limit)
    {
        $models = QueueMessage::where('queue', $queue)
            ->oldest()
            ->limit($limit)
            ->get();
        
        if(count($models) == 0)
        {
            throw new \Exception("Queue is empty!");
        }

        $messages = [];
        $identifiers = [];
        foreach($models as $model)
        {
            $messages[] = new QueueResponse($model->queue, json_decode($model->message));
            $identifiers[] = $model->id;
        }

        DB::table('message_queue')
            ->where('queue', $queue)
            ->whereIn('id', $identifiers)
            ->delete();
        
        return $messages;
    }
}
?>