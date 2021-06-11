<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\FieldType\DBField;


/**
 * A simple page banner to include on a page
 */
class BannerElement extends BaseElement
{
    private static $title = 'Banner Element';

    private static $singular_name = 'Banner Element';

    private static $description = 'Banner to include at the top of a page.';

    private static $icon = 'font-icon-image';

    private static $table_name = 'BannerElement';

    private static $db = [
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content', 'Content'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Banner image')->setFolderName('Banners'));
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
        return _t(__CLASS__ . '.BlockType', 'Banner Element');
    }
}
