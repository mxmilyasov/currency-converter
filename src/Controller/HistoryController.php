<?php

namespace Mxmilyasov\Converter\Controller;

class HistoryController extends BaseController
{

    public function anyIndex(): string
    {
        return $this->view->render('include/history.html.twig');
    }
}
