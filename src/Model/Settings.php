<?php

namespace Mxmilyasov\Converter\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mxmilyasov\Converter\Repository\SettingsRepository")
 * @ORM\Table(name="settings")
 */
class Settings
{

    public const HISTORY_LIST_SHOW_DEFAULT = 5;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected string $selectedCurrencies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected string $historyListSize;

    /**
     * @param string $selectedCurrencies
     */
    public function setSelectedCurrencies(string $selectedCurrencies): void
    {
        $this->selectedCurrencies = $selectedCurrencies;
    }

    /**
     * @param string $historyListSize
     */
    public function setHistoryListSize(string $historyListSize): void
    {
        $this->historyListSize = $historyListSize;
    }
}
