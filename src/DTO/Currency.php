<?php

namespace Mxmilyasov\Converter\DTO;

class Currency
{

    private string $name;

    private string $code;

    private ?string $symbol;

    /**
     * @param string $name
     * @param string $code
     * @param string|null $symbol
     */
    public function __construct(string $name, string $code, ?string $symbol)
    {
        $this->name = $name;
        $this->code = $code;
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function __toString(): string
    {
        return "Currency: $this->name ($this->code, symbol: $this->symbol) ";
    }
}
