<?php
namespace Yireo\ExampleAddressFieldNote\Block\Address\Edit\Field;

use Magento\Framework\View\Element\Template;

/**
 * Class Note
 *
 * @package Yireo\ExampleAddressFieldNote\Block\Address\Edit\Field
 */
class Note extends Template
{
    /**
     * @var string
     */
    protected $_template = 'address/edit/field/note.phtml';

    /**
     * @var \Magento\Customer\Api\Data\AddressInterface
     */
    protected $_address;

    /**
     * @return string
     */
    public function getNoteValue()
    {
        /** @var \Magento\Customer\Model\Data\Address $address */
        $address = $this->getAddress();
        $noteValue = $address->getCustomAttribute('internal_note');

        if (!$noteValue instanceof \Magento\Framework\Api\AttributeInterface) {
            return '';
        }

        return $noteValue->getValue();
    }

    /**
     * Return the associated address.
     *
     * @return \Magento\Customer\Api\Data\AddressInterface
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * Set the associated address.
     *
     * @param \Magento\Customer\Api\Data\AddressInterface $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }
}