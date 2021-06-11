<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * One image block, with full width layout option.
 */
class SingleImageElement extends BaseElement
{
    private static $table_name = 'SingleImageElement';

    private static $singular_name = 'Single Image Element';

    private static $plural_name = 'Single Image Elements';

    private static $description = 'One image. Full width or on desktop.';

    private static $icon = 'font-icon-block-file';

    private static $db = [
        'DisplayPageFullWidth' => 'Boolean',
    ];

    private static $has_one = [
        'Image' => File::class,
    ];

    private static $owns = [
        'Image',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', $uploadField = UploadField::create('Image'));
        $uploadField->setAllowedFileCategories('image');
        $uploadField->setAllowedMaxFileNumber(1);
        $fields->addFieldToTab('Root.Main', CheckboxField::create('DisplayPageFullWidth', 'Display Page Full Width?'));

        return $fields;
    }

    /**
     * @inheritDoc
     */
    public function getSummary()
    {
        if ($this->Image()->exists()) {
            return DBField::create_field('HTMLText', $this->Image()->Title)->Summary(20);
        }
        return '';
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

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Single Image');
    }
}
