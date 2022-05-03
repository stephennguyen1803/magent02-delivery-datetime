<?php
declare(strict_types=1);

namespace Dungna\DeliveryDateTime\Plugin\LayoutProcessor;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class AfterProcess
{
    /**
     * @param LayoutProcessor $subject
     * @param array $result
     * @param array $jsLayout
     * @return array
     */
    public function AfterProcess(LayoutProcessor $subject, array $result, array $jsLayout): array
    {
        $deliveryDate = 'delivery_date';
        $customField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'tooltip' => [
                    'description' => 'this is what the field is for',
                ],
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $deliveryDate,
            'label' => 'Custom Attribute',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => '' // value field is used to set a default value of the attribute
        ];

        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$deliveryDate] = $customField;
        return $result;

    }
}
