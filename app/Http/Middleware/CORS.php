<?php
namespace App\Http\Middleware;
use Closure;

class CORS 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $headers = [
            "Access-Control-Allow-Origin" => "*",
            'Access-Control-Allow-Methods' => '*',
            'Access-Control-Allow-Headers' => '*'
        ];
        
        if ($request->getMethod() == "OPTIONS") 
        {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return \Response::make('OK', 200, $headers);
        }

        $response = $next($request);
        if(method_exists($response, "header"))
        {
            foreach ($headers as $key => $value)
                $response->header($key, $value);
        }
        else
        {
            foreach ($headers as $key => $value)
                header("{$key}:{$value}");
        }

        return $response;
    }
}