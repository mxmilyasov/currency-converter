<?php

namespace Mxmilyasov\Converter\Controller;

class ConvertController extends BaseController
{

    public function anyIndex(): string
    {
        return $this->view->render('include/converter.html.twig');
    }
}
