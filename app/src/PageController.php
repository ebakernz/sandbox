<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;

class PageController extends ContentController
{
    private static $allowed_actions = [];

    public function init()
    {
        parent::init();
        Requirements::javascript('app/client/dist/index.js');
        Requirements::css('app/client/dist/index.css');
        Requirements::set_force_js_to_bottom(true);
    }

    /**
     * Path to public client assets directory, for use in templates etc
     * This path is exposed via the composer.json
     *
     * @return string
     */
    public function ClientAssetsPath()
    {
        return Controller::join_links(
            '_resources',
            'app',
            'client',
            'assets'
        );
    }

    /**
     * Key for cached version of main menu per page
     * including if any page has been edited or added/deleted
     *
     * @return string
     */
    public function MainMenuCacheKey()
    {
        $fragments = [
            'main_menu_per_page',
            $this->ID,
            SiteTree::get()->max('LastEdited'),
            SiteTree::get()->count()
        ];
        return implode('-_-', $fragments);
    }

    /**
     * Key for cached version of footer
     * updates on global site title change or year change
     *
     * @return string
     */
    public function PageFooterCacheKey()
    {
        $fragments = [
            'footer',
            SiteConfig::current_site_config()->Title,
            DBDatetime::now()->Year()
        ];
        return implode('-_-', $fragments);
    }

    /**
     * Toggle BetterNavigator on a per page basis if it has not been globally disabled.
     *
     * @return bool
     */
    public function showBetterNavigator()
    {
        return SiteConfig::current_site_config()->DisableBetterNavigator ? false : $this->ShowDebugTools;
    }
}
