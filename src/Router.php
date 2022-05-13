<?php
namespace App;

class Router
{
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    private array $handlers;
    private $not_found_handler = '404: Not Found, Shit out of luck';

    private function addHandler(string $method, string $path, $handler) : void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function get(string $path, $handler) : void
    {
       $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler) : void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler($handler) : void
    {
        $this->not_found_handler = $handler;
    }

    public function run()
    {
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $request_path = $request_uri['path'];

        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;

        foreach($this->handlers as $handler)
        {
            if($handler['path'] === $request_path && $method === $handler['method'])
            {
                $callback = $handler['handler'];
            }
        }

        if(is_string($callback))
        {
            $parts = explode('::', $callback);

            if(is_array($parts))
            {
                $class_name = array_shift($parts);
                $handler = new $class_name;

                $method = array_shift($parts);
                $callback = [$handler, $method];
            }
        }

        if(!$callback)
        {
            header("HTTP/1.1 404 Not Found", true, 404);
            if(!empty($this->not_found_handler))
            {
                $callback = $this->not_found_handler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}
