<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Embed code for iFrames or Javascript on a page.
 */
class EmbeddedCodeElement extends BaseElement
{
    private static $icon = 'font-icon-code';

    private static $singular_name = 'Embedded Code Element';

    private static $plural_name = 'Embedded Code Elements';

    private static $description = 'Embed code like iFrames or Javascript on a page.';

    private static $table_name = 'EmbeddedCodeElement';

    private static $db = [
        'Code' => 'HTMLText',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->replaceField(
            'Code',
            TextareaField::create('Code')
                ->setTitle('Embed Code')
        );

        return $fields;
    }

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Embedded Code');
    }

    /**
     * @inheritDoc
     */
    public function getSummary()
    {
        return DBField::create_field('HTMLText', $this->Code)->Summary(20);
    }

    /**
     * @inheritDoc
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
}
