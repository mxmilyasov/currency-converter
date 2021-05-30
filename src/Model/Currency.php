<?php

namespace Mxmilyasov\Converter\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mxmilyasov\Converter\Repository\CurrencyRepository")
 * @ORM\Table(name="currencies")
 */
class Currency
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     */
    protected string $code;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected string $name;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected ?string $symbol;

    /**
     * @param string $code
     * @param string $name
     * @param string|null $symbol
     */
    public function __construct(string $code, string $name, ?string $symbol)
    {
        $this->code = $code;
        $this->name = $name;
        $this->symbol = $symbol;
    }
}
