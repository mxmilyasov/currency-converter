<?php

namespace Mxmilyasov\Converter\Utils;

use Twig\{Environment, Error\LoaderError, Error\RuntimeError, Error\SyntaxError, Loader\FilesystemLoader};

class View
{
    public function render($template, $variables = [])
    {
        $loader = new FilesystemLoader(APP_ROOT . '/template/');

        $twig = new Environment($loader, [
            'cache' => APP_ROOT . '/cache',
            'auto_reload' => true
        ]);

        $twig->addGlobal('requestUri', $_SERVER['REQUEST_URI']);

//        $twig->addFunction(new TwigFunction('asset', function ($asset) {
//            // implement whatever logic you need to determine the asset path
//
//            return sprintf( '/public/assets/%s', ltrim($asset, '/'));
//        }));

        try {
            $tmpl = $twig->load($template);
            return $tmpl->render($variables);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            echo "Render template error. {$e->getMessage()}.";
        }
    }
}
