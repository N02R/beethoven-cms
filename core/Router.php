<?php

class Router
{
    private array $routes = [];

    public function get(string $uri, string $action)
    {
        $this->routes['GET'][$this->format($uri)] = $action;
    }

    public function post(string $uri, string $action)
    {
        $this->routes['POST'][$this->format($uri)] = $action;
    }

    public function resolve(Request $request)
    {
        $method = $request->method();
        $uri = $this->format($request->uri());

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        return $this->runAction($action);
    }

    private function runAction(string $action)
    {
        [$controller, $method] = explode('@', $action);

        if (!class_exists($controller)) {
            throw new Exception("Controller not found: $controller");
        }

        $controller = new $controller();

        if (!method_exists($controller, $method)) {
            throw new Exception("Method not found: $method");
        }

        return call_user_func([$controller, $method]);
    }

    private function format(string $uri): string
    {
        $uri = rtrim($uri, '/');
        return $uri === '' ? '/' : $uri;
    }
}