<?php
namespace App;

class Router
{
    //Valid methods
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    private array $handlers;
    private $not_found_handler = '404: Not Found';

    //add handler function to the url
    private function addHandler(string $method, string $path, $handler) : void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    //get request
    public function get(string $path, $handler) : void
    {
       $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    //post request
    public function post(string $path, $handler) : void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    //display generic error
    public function addNotFoundHandler($handler) : void
    {
        $this->not_found_handler = $handler;
    }

    //Run the handlers on url
    public function run()
    {
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $request_path = $request_uri['path'];

        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;

        //Loop trough handlers, if valid set the handler to callback
        foreach($this->handlers as $handler)
        {
            if($handler['path'] === $request_path && $method === $handler['method'])
            {
                $callback = $handler['handler'];
            }
        }

        //if valid create new instance and set callback to valid method inside that class
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

        //call a method from a valid url to handle user request
        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}
