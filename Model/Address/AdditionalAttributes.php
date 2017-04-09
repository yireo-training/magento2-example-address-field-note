<?php
namespace Yireo\ExampleAddressFieldNote\Model\Address;

use Magento\Framework\Api\AbstractSimpleObject;

// @todo: Create an interface for this class

/**
 * Class ExtensionAttributes
 *
 * @package Yireo\ExampleAddressFieldNote\Model\Address
 */
class AdditionalAttributes extends AbstractSimpleObject implements \Magento\Customer\Api\Data\AddressExtensionInterface
{
    /**
     * @param string $note
     * @return void
     */
    public function setNote($note)
    {
        $this->setData('note', $note);
    }

    /**
     * @return mixed|null
     */
    public function getNote()
    {
        return $this->_get('note');
    }
}