<?php
namespace Yireo\ExampleAddressFieldNote\Processor;

use Magento\Checkout\Model\Layout\AbstractTotalsProcessor;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

/**
 * Class CommentAddressField
 *
 * @package Yireo\ExampleAddressFieldNote\Plugin
 */
class NoteAddressField extends AbstractTotalsProcessor implements LayoutProcessorInterface
{
    /**
     * @var string
     */
    protected $extensionAttributeCode = 'note';

    /**
     * @param array $jsLayout
     *
     * @return array
     */
    public function process($jsLayout)
    {
        $customField = $this->getExtensionAttributeFieldAsArray();
        $newJsLayout = [
            'components' => [
                'checkout' => [
                    'children' => [
                        'steps' => [
                            'children' => [
                                'shipping-step' => [
                                    'children' => [
                                        'shippingAddress' => [
                                            'children' => [
                                                'shipping-address-fieldset' => [
                                                    'children' => [
                                                        $this->extensionAttributeCode => $customField
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $jsLayout = array_merge_recursive($jsLayout, $newJsLayout); // @todo: of array_replace_recursive?

        return $jsLayout;
    }

    /**
     * @return array
     */
    protected function getExtensionAttributeFieldAsArray()
    {
        $extensionAttributeField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $this->extensionAttributeCode,
            'label' => 'Note',
            'provider' => 'checkoutProvider',
            'sortOrder' => 99,
            'validation' => [
                'required-entry' => false
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];

        return $extensionAttributeField;
    }
}
