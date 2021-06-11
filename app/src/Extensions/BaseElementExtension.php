<?php

namespace Skeletor\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\ORM\DataExtension;

/**
 * An extension that adds additional functionality to {@link BaseElement}.
 */
class BaseElementExtension extends DataExtension
{
    /**
     * Cache key based on Element ID and Element Last edited
     *
     * @return string
     */
    public function ElementCacheKey()
    {
        $fragments = [
            'elemental_block',
            $this->owner->ID,
            $this->owner->LastEdited
        ];
        return implode('-_-', $fragments);
    }
}
