<?php

namespace Mxmilyasov\Converter\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mxmilyasov\Converter\Repository\ConverterResultRepository")
 * @ORM\Table(name="converter_results")
 */
class ConverterResult
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected string $fromCurrency;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected string $toCurrency;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=6)
     */
    protected string $rate;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    protected string $convertResult;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    protected string $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    protected \DateTime $createdAt;

    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     * @param string $rate
     * @param string $convertResult
     * @param string $amount
     */
    public function __construct(
        string $fromCurrency,
        string $toCurrency,
        string $amount,
        string $rate,
        string $convertResult,
    ) {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->amount = $amount;
        $this->rate = $rate;
        $this->convertResult = $convertResult;
        $this->createdAt = new \DateTime('now');
    }
}
