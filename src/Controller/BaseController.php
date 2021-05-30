<?php

namespace Mxmilyasov\Converter\Controller;

use Doctrine\ORM\EntityManager;
use Mxmilyasov\Converter\Utils\View;

class BaseController
{
    protected View $view;
    protected EntityManager $em;

    public function __construct()
    {
        $this->view = new View();
        $this->em = $this->getEntityManager();
    }

    private function getEntityManager(): EntityManager
    {
        require APP_ROOT . '/config/bootstrap.php';

        /** @phpstan-ignore-next-line */
        if (!isset($em)) {
            throw new \Exception('Variable $em not set.');
        }

        /** @phpstan-ignore-next-line */
        return $em;
    }
}
