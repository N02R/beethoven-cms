<?php

class Router
{
    private array $routes = [];

    /* =========================
     | REGISTER GET ROUTE
     ========================= */
    public function get(string $uri, string $action)
    {
        $this->routes['GET'][$this->format($uri)] = $action;
    }

    /* =========================
     | REGISTER POST ROUTE
     ========================= */
    public function post(string $uri, string $action)
    {
        $this->routes['POST'][$this->format($uri)] = $action;
    }

    /* =========================
     | MAIN RESOLVER
     ========================= */
    public function resolve(Request $request)
    {
        $method = $request->method();
        $uri    = $this->format($request->uri());

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        return $this->runAction($action);
    }

    /* =========================
     | RUN CONTROLLER ACTION
     ========================= */
    private function runAction(string $action)
    {
        [$controller, $method] = explode('@', $action);

        if (!class_exists($controller)) {
            throw new Exception("Controller not found: " . $controller);
        }

        $controller = new $controller();

        if (!method_exists($controller, $method)) {
            throw new Exception("Method not found: " . $method);
        }

        return call_user_func([$controller, $method]);
    }

    /* =========================
     | FORMAT URI CLEANLY
     ========================= */
    private function format(string $uri): string
    {
        // remove query string + normalize path
        $uri = parse_url($uri, PHP_URL_PATH);

        // remove trailing slash
        $uri = rtrim($uri, '/');

        // ensure root is "/"
        return $uri === '' ? '/' : $uri;
    }
}