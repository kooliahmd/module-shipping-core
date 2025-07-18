<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Netresearch\ShippingCore\Model\ShippingSettings\Data\Selection;

use Netresearch\ShippingCore\Api\Data\ShippingSettings\ShippingOption\Selection\SelectionInterface;

class Selection implements SelectionInterface
{
    /**
     * @var string
     */
    private $shippingOptionCode;

    /**
     * @var string
     */
    private $inputCode;

    /**
     * @var string
     */
    private $inputValue;

    public function __construct(
        ?string $shippingOptionCode = null,
        ?string $inputCode = null,
        ?string $inputValue = null
    ) {
        $this->shippingOptionCode = $shippingOptionCode;
        $this->inputCode = $inputCode;
        $this->inputValue = $inputValue;
    }

    /**
     * @return string
     */
    public function getShippingOptionCode(): string
    {
        return $this->shippingOptionCode;
    }

    /**
     * @param string $shippingOptionCode
     *
     * @return SelectionInterface
     */
    public function setShippingOptionCode(string $shippingOptionCode): SelectionInterface
    {
        $this->shippingOptionCode = $shippingOptionCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getInputCode(): string
    {
        return $this->inputCode;
    }

    /**
     * @param string $inputCode
     *
     * @return SelectionInterface
     */
    public function setInputCode(string $inputCode): SelectionInterface
    {
        $this->inputCode = $inputCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getInputValue(): string
    {
        return $this->inputValue;
    }

    /**
     * @param string $inputValue
     *
     * @return SelectionInterface
     */
    public function setInputValue(string $inputValue): SelectionInterface
    {
        $this->inputValue = $inputValue;
        return $this;
    }
}
