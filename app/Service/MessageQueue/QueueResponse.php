<?php
namespace App\Service\MessageQueue;

/**
 * Queue readonly response
 * 
 * @version 1.0.0
 * @author vigan.abd <vigan.abd@gmail.com>
 */
class QueueResponse implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $queue;

    /**
     * @var mixed
     */
    protected $message;

    /**
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $queue Queue identified
     * @param mixed $message payload
     */
    public function __construct(string $queue, $message) 
    {
        $this->queue = $queue;
        $this->message = $message;
    }

    
    public function jsonSerialize()
    {
        return [
            "queue" => $this->queue,
            "message" => $this->message
        ];
    }   
}