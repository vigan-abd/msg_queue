<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Domain\Enum\UserRoleEnum;
use App\Helper\RabbitMQ\RabbitMQAdapter;
use App\Helper\RabbitMQ\RabbitMQExchangeEnum;
use App\Service\Order\OrderService;

class HomeController extends Controller
{
    /**
     * @method get
     * @route /
     * @brief Default app route
     * @param Illuminate\Http\Request $request Request container
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $method = strtoupper($request->method());
        return response("{$method} is not allowed in path /", 400)
            ->header('Content-Type', 'text/plain');
    }
}
