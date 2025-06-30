<?php
namespace Yelarys\Framework\Http;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $collector) {
            $routes = include BASE_PATH . '/routes/web.php';
            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }
        });

        $httpMethod = $request->getMethod();
        $path = $request->getPath();

        $routeInfo = $dispatcher->dispatch($httpMethod, $path);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return new Response("404 Not Found", 404);

            case Dispatcher::METHOD_NOT_ALLOWED:
                return new Response("405 Method Not Allowed", 405);

            case Dispatcher::FOUND:
                [$controllerClass, $controllerMethod] = $routeInfo[1];
                $vars = $routeInfo[2];

                $controller = new $controllerClass();
                return call_user_func_array([$controller, $controllerMethod], $vars);
        }

        return new Response("500 Internal Server Error", 500);
    }
}
