<?php

namespace Mxmilyasov\Converter;

class App
{

    public static function run()
    {
        $dispatcher = new \Phroute\Phroute\Dispatcher(self::getData());

        try {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestUri = $_SERVER['REQUEST_URI'];

            $response = $dispatcher->dispatch($requestMethod, parse_url($requestUri, PHP_URL_PATH));
        } catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $exception) {
            $response = "Not found. {$exception->getMessage()}.";
        } catch (\Phroute\Phroute\Exception\HttpMethodNotAllowedException $exception) {
            $response = "Not allowed. {$exception->getMessage()}.";
        } catch (\Exception $exception) {
            $response = $exception->getMessage();
        }

        echo $response;
    }

    public static function getData(): \Phroute\Phroute\RouteDataArray
    {
        $router = new \Phroute\Phroute\RouteCollector();
        $router->controller('/', 'Mxmilyasov\\Converter\\Controller\\ConvertController');
        $router->controller('/settings', 'Mxmilyasov\\Converter\\Controller\\SettingsController');
        $router->controller('/history', 'Mxmilyasov\\Converter\\Controller\\HistoryController');

        return $router->getData();
    }
}
