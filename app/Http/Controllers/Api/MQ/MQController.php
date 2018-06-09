<?php

namespace App\Http\Controllers\Api\MQ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\MessageQueue\QueueHandle;
use Illuminate\Http\JsonResponse;

/**
 * @brief Provides middleware for managing the queue
 */
class MQController extends Controller
{
    /**
     * @method post
     * @route /mq/enqueue/{queue}
     * @brief Used to show form for category creation
     * 
     * @param string $queue
     * @param Illuminate\Http\Request $request Request container
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function enqueue(string $queue, Request $request)
    {
        try
        {
            QueueHandle::enqueue($request->input('payload', null), $queue);
            return $this->response(true);
        }
        catch (\Exception $ex)
        {
            return $this->exception($ex);
        }
    }

    /**
     * @method post
     * @route /mq/enqueue/{queue}/many
     * @brief Used to show form for category creation
     * 
     * @param string $queue
     * @param Illuminate\Http\Request $request Request container
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function enqueueMany(string $queue, Request $request)
    {
        try
        {
            QueueHandle::enqueueMany($request->input('payload', []), $queue);
            return $this->response(true);
        }
        catch (\Exception $ex)
        {
            return $this->exception($ex);
        }
    }

    /**
     * @method get
     * @route /mq/dequeue/{queue}
     * @brief Used to show form for category creation
     * 
     * @param string $queue
     * @param Illuminate\Http\Request $request Request container
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function dequeue(string $queue, Request $request)
    {
        try
        {
            $data = QueueHandle::dequeue($queue);
            return $this->response($data);
        }
        catch (\Exception $ex)
        {
            return $this->exception($ex);
        }
    }

    /**
     * @method get
     * @route /mq/dequeue/{queue}/many
     * @brief Used to show form for category creation
     * 
     * @param string $queue
     * @param Illuminate\Http\Request $request Request container
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function dequeueMany(string $queue, Request $request)
    {
        try
        {
            $data = QueueHandle::dequeueMany($queue);
            return $this->response($data);
        }
        catch (\Exception $ex)
        {
            return $this->exception($ex);
        }
    }

    /**
     * @method get
     * @route /mq/dequeue/{queue}/limit/{limit}
     * @brief Used to show form for category creation
     * 
     * @param string $queue
     * @param int $limit
     * @param Illuminate\Http\Request $request Request container
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function dequeueWithLimit(string $queue, int $limit, Request $request)
    {
        try
        {
            $data = QueueHandle::dequeueWithLimit($queue, $limit);
            return $this->response($data);
        }
        catch (\Exception $ex)
        {
            return $this->exception($ex);
        }
    }

    protected function exception(\Exception $ex)
    {
        return new JsonResponse([
            "code" => $ex->getCode(),
            "message" => $ex->getMessage() 
        ], 500, [
            "Content-Type" => "application/json"
        ]);
    }

    protected function response($data)
    {
        return new JsonResponse($data, 200, ["Content-Type" => "application/json"]);
    }
}
