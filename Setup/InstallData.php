<?php

namespace Yireo\ExampleAddressFieldNote\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Api\AttributeRepositoryInterface;

/**
 * Class InstallData
 *
 * @package Yireo\ExampleAddressFieldNote\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    /**
     * Constructor
     *
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeRepositoryInterface $attributeRepository
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->addNoteAttribute($setup);
        $setup->endSetup();
    }

    /**
     * @param $setup
     *
     * @return bool
     */
    private function addNoteAttribute($setup)
    {
        if ($this->checkIfAttributeExists('internal_note')) {
            return false;
        }

        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerSetup->addAttribute('customer_address', 'internal_note',  [
            'label' => 'Example Note',
            'type' => 'varchar',
            'input' => 'textarea',
            'visible' => false,
            'required' => false,
            'system' => 0
        ]);

        return true;
    }

    /**
     * @param $attributeCode
     *
     * @return bool
     */
    private function checkIfAttributeExists($attributeCode)
    {
        try {
            return (bool) $this->attributeRepository->get('customer_address', $attributeCode);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return false;
        }
    }
}