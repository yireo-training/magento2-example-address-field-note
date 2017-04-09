<?php
namespace Yireo\ExampleAddressFieldNote\Plugin;

use Magento\Customer\Api\AddressRepositoryInterface as Subject;
use Magento\Customer\Api\Data\AddressInterface as Entity;

/**
 * Class AddNoteFieldToAddressEntity
 *
 * @package Yireo\ExampleAddressFieldNote\Plugin
 */
class AddNoteFieldToAddressEntity
{
    public function __construct(
        \Magento\Framework\App\RequestInterface $httpRequest,
        \Magento\Framework\Logger\Monolog $logger
    )
    {
        $this->httpRequest = $httpRequest;
        $this->logger = $logger;
    }

    /**
     * @param Subject $subject
     * @param Entity $entity
     *
     * @return Entity
     */
    public function afterGetById(Subject $subject, Entity $entity)
    {
        $extensionAttributes = $entity->getExtensionAttributes();
        if ($extensionAttributes === null) {
            return $entity;
        }

        $note = $this->getNoteByEntityId($entity);
        $extensionAttributes->setNote($note);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    /**
     * @param Subject $subject
     * @param Entity $entity
     *
     * @return [Entity]
     */
    public function beforeSave(Subject $subject, Entity $entity)
    {
        $extensionAttributes = $entity->getExtensionAttributes();
        if ($extensionAttributes === null) {
            return [$entity];
        }

        // @todo: Really dirty hack, because Magento\Customer\Controller\Address\FormPost does not support Extension Attributes
        $note = $this->httpRequest->getParam('note');
        $entity->setCustomAttribute('internal_note', $note);

        return [$entity];
    }

    /**
     * @param Entity $entity
     *
     * @return string
     */
    private function getNoteByEntityId(Entity $entity)
    {
        return $entity->getCustomAttribute('internal_note')->getValue();
    }
}