<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Sinlge Image and COntent block with multiple layout options.
 */
class ImageContentElement extends BaseElement
{
    private static $table_name = 'ImageContentElement';

    private static $singular_name = 'Image Content Element';

    private static $plural_name = 'Image Content Elements';

    private static $description = 'Single Image and Content block with multiple layouts';

    private static $icon = 'font-icon-block-banner';

    private static $db = [
        'Content' => 'HTMLText',
        'LayoutOption' => 'Text'
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
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content'));

        $fields->addFieldToTab(
            'Root.Main',
            OptionsetField::create(
                'LayoutOption',
                'Layout options',
                $source = [
                    'content-left-image-right' => 'Content Left | Image Right',
                    'content-right-image-left' => 'Content Right | Image Left',
                    'content-bottom-image-top' => 'Content Bottom | Image Top',
                    'content-top-image-bottom' => 'Content Top | Image Bottom'
                ],
                $value = 'content-left-image-right'
            )->addExtraClass('image-content-alignment-options')
        );

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
        return _t(__CLASS__ . '.BlockType', 'Image Content');
    }
}
