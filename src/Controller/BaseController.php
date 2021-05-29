<?php

namespace Mxmilyasov\Converter\Controller;

use JetBrains\PhpStorm\Pure;
use Mxmilyasov\Converter\Utils\View;

class BaseController
{
    protected View $view;

    #[Pure] public function __construct()
    {
        $this->view = new View();
    }
}
