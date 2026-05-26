<?php

class Router {
    private $routes = [];

    public function add($method, $route, $handler) {
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route);
        $routeRegex = '#^' . $routeRegex . '$#';

        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => $route,
            'regex' => $routeRegex,
            'handler' => $handler
        ];
    }

    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';

        $path = parse_url($requestUri, PHP_URL_PATH);

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = dirname($scriptName);
        $basePath = str_replace('\\', '/', $basePath);

        if ($basePath !== '/' && $basePath !== '\\' && strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        if (empty($path)) {
            $path = '/';
        }
        if ($path !== '/' && rtrim($path, '/') !== $path) {
            $path = rtrim($path, '/');
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['regex'], $path, $matches)) {
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                $this->executeHandler($route['handler'], $params);
                return;
            }
        }
        http_response_code(404);
        require_once dirname(__DIR__) . '/views/layout/header.php';
        echo "<div class='container text-center my-5'><h1 class='display-1 text-danger'>404</h1><p class='lead'>La página que buscas no existe.</p><a href='" . BASE_URL . "/dashboard' class='btn btn-primary'>Volver al inicio</a></div>";
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    private function executeHandler($handler, $params) {
        list($controllerClass, $method) = explode('@', $handler);
        
        $controllerFile = dirname(__DIR__) . '/controllers/' . $controllerClass . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], [$params]);
                    return;
                }
            }
        }
        
        http_response_code(500);
        echo "Error 500: Controlador o método no encontrado (" . htmlspecialchars($handler) . ")";
    }
}
