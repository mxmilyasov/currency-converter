<?php

namespace Mxmilyasov\Converter\Controller;

class SettingsController extends BaseController
{

    public function anyIndex(): string
    {
        return $this->view->render('include/settings.html.twig');
    }
}
