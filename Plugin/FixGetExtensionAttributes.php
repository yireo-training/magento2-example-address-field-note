<?php
namespace Yireo\ExampleAddressFieldNote\Plugin;

use Yireo\ExampleAddressFieldNote\Model\Address\AdditionalAttributes as AdditionalAttributes;
use Yireo\ExampleAddressFieldNote\Model\Address\AdditionalAttributesFactory as AdditionalAttributesFactory;
use Magento\Customer\Api\Data\AddressInterface as Subject;
use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Class FixGetExtensionAttributes
 *
 * @package Yireo\ExampleAddressFieldNote\Plugin
 */
class FixGetExtensionAttributes implements ExtensibleDataInterface
{
    /**
     * @var AdditionalAttributesFactory
     */
    protected $extensionAttributeFactory;

    /**
     * FixGetExtensionAttributes constructor.
     *
     * @param AdditionalAttributesFactory $extensionAttributeFactory
     */
    public function __construct(AdditionalAttributesFactory $extensionAttributeFactory)
    {
        $this->extensionAttributeFactory = $extensionAttributeFactory;
    }

    /**
     * @param Subject $subject
     * @param AdditionalAttributes|null $extensionAttributes
     *
     * @return AdditionalAttributes
     */
    public function afterGetExtensionAttributes(
        Subject $subject,
        AdditionalAttributes $extensionAttributes = null
    )
    {
        if ($extensionAttributes !== null) {
            return $extensionAttributes;
        }

        $extensionAttributes = $this->extensionAttributeFactory->create();

        return $extensionAttributes;
    }
}