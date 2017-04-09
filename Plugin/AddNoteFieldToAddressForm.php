<?php
namespace Yireo\ExampleAddressFieldNote\Plugin;

use Magento\Customer\Block\Address\Edit as Subject;
use Yireo\ExampleAddressFieldNote\Block\Address\Edit\Field\Note as NoteBlock;

/**
 * Class AddNoteFieldToAddressForm
 *
 * @package Yireo\ExampleAddressFieldNote\Plugin
 */
class AddNoteFieldToAddressForm
{
    /**
     * @param Subject $subject
     * @param string $html
     *
     * @return string
     */
    public function afterToHtml(Subject $subject, $html)
    {
        $noteBlock = $this->getChildBlock(NoteBlock::class, $subject);
        $noteBlock->setAddress($subject->getAddress());
        $html = $this->appendBlockBeforeFieldsetEnd($html, $noteBlock->toHtml());

        return $html;
    }

    /**
     * @param string $html
     * @param string $childHtml
     *
     * @return string
     */
    private function appendBlockBeforeFieldsetEnd($html, $childHtml)
    {
        $pregMatch = '/\<\/fieldset\>/';
        $pregReplace = $childHtml . '\0';
        $html = preg_replace($pregMatch, $pregReplace, $html, 1);

        return $html;
    }

    /**
     * @param $parentBlock
     *
     * @return mixed
     */
    private function getChildBlock($blockClass, $parentBlock)
    {
        return $parentBlock->getLayout()->createBlock($blockClass, basename($blockClass));
    }
}