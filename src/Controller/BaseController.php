<?php

namespace Mxmilyasov\Converter\Controller;

use Mxmilyasov\Converter\Utils\View;

class BaseController
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
