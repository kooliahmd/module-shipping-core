<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Netresearch\ShippingCore\Setup\Module;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validator\ValidateException;

class DataInstaller
{
    public const ATTRIBUTE_CODE_HS_CODE = 'nrshipping_hs_code';
    public const ATTRIBUTE_CODE_EXPORT_DESCRIPTION = 'nrshipping_export_description';

    /**
     *
     * @param EavSetup $eavSetup
     * @throws LocalizedException
     * @throws LocalizedException|ValidateException
     */
    public static function addExportDescriptionAttribute(EavSetup $eavSetup): void
    {
        $eavSetup->addAttribute(
            Product::ENTITY,
            self::ATTRIBUTE_CODE_EXPORT_DESCRIPTION,
            [
                'group' => '',
                'type' => 'varchar',
                'label' => 'Item Export Description',
                'frontend_class' => 'validate-length maximum-length-50',
                'input' => 'text',
                'required' => false,
                'sort_order' => 52,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'visible' => true,
                'apply_to' => implode(',', [Type::TYPE_SIMPLE, Type::TYPE_BUNDLE, Configurable::TYPE_CODE]),
            ]
        );
    }

    /**
     * @param EavSetup $eavSetup
     * @throws LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public static function addHsCodeAttribute(EavSetup $eavSetup): void
    {
        $eavSetup->addAttribute(
            Product::ENTITY,
            self::ATTRIBUTE_CODE_HS_CODE,
            [
                'type' => 'varchar',
                'label' => 'HS Code',
                'frontend_class' => 'validate-digits validate-length maximum-length-11',
                'input' => 'text',
                'required' => false,
                'sort_order' => 60,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'visible' => true,
                'apply_to' => implode(',', [Type::TYPE_SIMPLE, Type::TYPE_BUNDLE, Configurable::TYPE_CODE]),
            ]
        );
    }
}
