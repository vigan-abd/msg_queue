<?php

use App\Service\MessageQueue\QueueHandle;

define('MQ_READ_SINGLE', 1, false);
define('MQ_READ_MULTIPLE', 2, false);

if(!function_exists('mq_enqueue'))
{
    /**
     * Enqueue message/messages for queue
     *
     * @param string|string[] $message Payload
     * @param string $queue Queue identifier
     * @return void
     * 
     * @version 1.0.0
     * @author vigan.abd <vigan.abd@gmail.com>
     */
    function mq_enqueue($message, $queue)
    {
        if (is_array($message))
        {
            QueueHandle::enqueueMany($message, $queue);
        }
        else
        {
            QueueHandle::enqueue($message, $queue);
        }
    }
}

if(!function_exists('mq_dequeue'))
{
    /**
     * Dequeue message/messages from queue
     *
     * @param string $queue Queue identifier
     * @param integer $mode Read mode: MQ_READ_SINGLE, MQ_READ_MULTIPLE
     * @param integer $limit Max amount of messages
     * @throws \Exception
     * @return \App\Service\MessageQueue\QueueResponse|\App\Service\MessageQueue\QueueResponse[]
     * 
     * @version 1.0.0
     * @author vigan.abd <vigan.abd@gmail.com>
     */
    function mq_dequeue($queue, $mode = 1, $limit = null)
    {
        if ($mode == MQ_READ_SINGLE)
        {
            return QueueHandle::dequeue($queue);
        }
        else if ($mode == MQ_READ_MULTIPLE)
        {
            return !empty($limit) ? 
                QueueHandle::dequeueWithLimit($queue, $limit) :
                QueueHandle::dequeueMany($queue);
        }
        else
        {
            throw new \Exception("Read mode is not supported");
        }
    }
}
