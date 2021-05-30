<?php

namespace Mxmilyasov\Converter\Controller;

use Mxmilyasov\Converter\Model\Settings;
use Mxmilyasov\Converter\Repository\SettingsRepository;

class SettingsController extends BaseController
{

    public function anyIndex(): string
    {
        /** @var SettingsRepository $settingsRepo */
        $settingsRepo = $this->em->getRepository(Settings::class);

        $currencies = $settingsRepo->getAllCurrencyCode();
        $historyListSize = $settingsRepo->getHistoryListSize();
        $selectedCurrencies = $settingsRepo->getSelectedCurrencies();

        return $this->view->render(
            'include/settings.html.twig',
            [
                'currencies' => $currencies,
                'historyListSize' => $historyListSize,
                'selectedCurrencies' => $selectedCurrencies,
            ]
        );
    }

    public function anySetCurrency(): void
    {
        /** @var SettingsRepository $settingsRepo */
        $settingsRepo = $this->em->getRepository(Settings::class);

        $selectedCurrencies = $_POST['selectedCurrencies'] ?? null;

        if (isset($selectedCurrencies)) {
            $settingsRepo->updateSettings($selectedCurrencies, 'selectedCurrencies');
        }
    }

    public function anySetHistorySize(): void
    {
        /** @var SettingsRepository $settingsRepo */
        $settingsRepo = $this->em->getRepository(Settings::class);

        $historyListSize = $_POST['historyListSize'] ?? null;

        if (isset($historyListSize)) {
            $settingsRepo->updateSettings($historyListSize, 'historyListSize');
        }
    }
}
