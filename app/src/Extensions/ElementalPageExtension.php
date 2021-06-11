<?php

namespace Skeletor\Extensions;

use DNADesign\Elemental\Extensions\ElementalPageExtension as CoreElementalPageExtension;
use DNADesign\Elemental\Forms\ElementalAreaField;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;

/**
 * An extension that adds additional functionality to {@link ElementalPageExtension}.
 */
class ElementalPageExtension extends CoreElementalPageExtension
{
    private static $has_one = [
        'SidebarElementalArea' => ElementalArea::class
    ];

    private static $owns = [
        'SidebarElementalArea'
    ];

    private static $cascade_duplicates = [
        'SidebarElementalArea'
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields): void
    {
        parent::updateCMSFields($fields);

        /** @var ElementalAreaField $sidebar */
        $sidebar = $fields->dataFieldByName('SidebarElementalArea');
        if ($sidebar) {
            $config = $this->owner->config();

            $fields->removeByName('Sidebar');
            $fields->insertAfter('Main', Tab::create('Sidebar', 'Sidebar'));
            $fields->addFieldToTab('Root.Sidebar', $sidebar);

            if (is_array($config->get('allowed_elements_sidebar'))) {
                $availableClasses = $config->get('allowed_elements_sidebar');
            } else {
                $availableClasses = ClassInfo::subclassesFor(BaseElement::class);
            }

            $disallowedElements = (array)$config->get('disallowed_elements_sidebar');

            $list = [];
            foreach ($availableClasses as $availableClass) {
                /** @var BaseElement $inst */
                $inst = singleton($availableClass);

                if (!in_array($availableClass, $disallowedElements) && $inst->canCreate()) {
                    if ($inst->hasMethod('canCreateElement') && !$inst->canCreateElement()) {
                        continue;
                    }

                    $list[$availableClass] = $inst->getType();
                }
            }

            $sidebar->setTypes($list);
        }
    }
}
