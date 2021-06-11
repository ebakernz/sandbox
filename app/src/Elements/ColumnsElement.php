<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Content columns for use in a page. Two or three column layout.
 */
class ColumnsElement extends BaseElement
{
    private static $table_name = 'ColumnsElement';

    private static $singular_name = 'columns element';

    private static $plural_name = 'columns elements';

    private static $description = 'Two or Three column layout';

    private static $icon = 'font-icon-columns';

    private static $inline_editable = false;

    private static $db = [
        'Column1HTML' => 'HTMLText',
        'Column2HTML' => 'HTMLText',
        'Column3HTML' => 'HTMLText',
        'Display3Columns' => 'Boolean',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', CheckboxField::create('Display3Columns', 'Display 3 Columns?'));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Column1HTML')->setrows(10));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Column2HTML')->setrows(10));
        $fields->addFieldToTab('Root.Main', $column3Html = HtmlEditorField::create('Column3HTML'));

        $column3Html->displayIf('Display3Columns')->isChecked();

        return $fields;
    }

    /**
     * @inheritDoc
     */
    public function getSummary()
    {
        $columns = '';
        if ($this->Display3Columns) {
            $columns = '3 Columns';
        } else {
            $columns = '2 Columns';
        }
        $label = _t(
            ColumnsElement::class . '.PLURALS',
            $columns
        );
        return DBField::create_field('HTMLText', $label)->Summary(20);
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
        return _t(__CLASS__ . '.BlockType', 'Columns');
    }
}
