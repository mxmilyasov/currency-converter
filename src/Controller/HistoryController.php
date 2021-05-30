<?php

namespace Mxmilyasov\Converter\Controller;

use Mxmilyasov\Converter\Model\ConverterResult;
use Mxmilyasov\Converter\Repository\ConverterResultRepository;

class HistoryController extends BaseController
{
    public function getPage(int $current = 1): string
    {
        /** @var ConverterResultRepository $converterResultRepo */
        $converterResultRepo = $this->em->getRepository(ConverterResult::class);

        [$converterResults, $pagination] = $converterResultRepo->getConvertResultList($current);

        return $this->view->render(
            'include/history.html.twig',
            [
                'converterResults' => $converterResults,
                'pagination' => $pagination
            ]
        );
    }
}
