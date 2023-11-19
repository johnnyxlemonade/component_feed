<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;

/**
 * @TraitString
 * @\Lemonade\Feed\Data\Money\TraitString
 */
trait TraitString
{

    /**
     * @param string|null $id
     * @param string|null $code
     * @param string|null $text
     * @param string|null $vat
     * @param string|null $vatId
     */
    public function __construct(
        protected readonly ?string $id = null,
        protected readonly ?string $code = null,
        protected readonly ?string $text = null,
        protected readonly ?string $vat = null,
        protected readonly ?string $vatId = null
    )
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {

        return ($this->id ?? "");
    }

    /**
     * @return string
     */
    public function getCode(): string
    {

        return ($this->code ?? "");
    }

    /**
     * @return string
     */
    public function getText(): string
    {

        return ($this->text ?? "");
    }

    /**
     * @return string
     */
    public function getVat(): string
    {

        return ($this->vat ?? "");
    }

    /**
     * @return string
     */
    public function getVatId(): string
    {

        return ($this->vatId ?? "");
    }

}