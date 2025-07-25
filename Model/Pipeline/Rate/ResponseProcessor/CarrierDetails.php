<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Netresearch\ShippingCore\Model\Pipeline\Rate\ResponseProcessor;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Netresearch\ShippingCore\Api\Pipeline\RateResponseProcessorInterface;

class CarrierDetails implements RateResponseProcessorInterface
{
    /**
     * Override carrier details.
     *
     * @param Method[] $methods List of rate methods
     * @param RateRequest|null $request The rate request
     *
     * @return Method[]
     */
    public function processMethods(array $methods, ?RateRequest $request = null): array
    {
        $carrierCode = $request->getData('carrier_code');
        $carrierTitle = $request->getData('carrier_title');

        if (!$carrierCode && !$carrierTitle) {
            return $methods;
        }

        foreach ($methods as $method) {
            if ($carrierCode) {
                $method->setData('carrier', $carrierCode);
            }

            if ($carrierTitle) {
                $method->setData('carrier_title', $carrierTitle);
            }
        }

        return $methods;
    }
}
