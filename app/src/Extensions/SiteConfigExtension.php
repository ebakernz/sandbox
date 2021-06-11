<?php

namespace Skeletor\Extensions;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * An extension that adds additional functionality to {@link SiteConfig}.
 */
class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'EmailRecipients' => 'Text',
        'DisableBetterNavigator' => 'Boolean'
    ];

    private static $has_one = [
        'Logo' => Image::class
    ];

    private static $owns = [
        'Logo'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Main', UploadField::create('Logo', 'Site logo')
            ->setDescription('Default logo for email templates and shared links on social media'));
        $fields->addFieldToTab('Root.Main', HeaderField::create('Email', 'Email settings', 2));
        $fields->addFieldToTab('Root.Main', TextField::create('EmailRecipients', 'Default recipients')
            ->setDescription('Email addresses to send all website emails <strong>to</strong> (comma-separated list)'));
        $fields->addFieldToTab('Root.Main', ReadonlyField::create('EmailFrom_Display', 'Send all emails from', self::EmailFrom())
            ->setDescription('This cannot be edited as it needs to be a validated, environment-specific email address.'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('DisableBetterNavigator')->setDescription('Globally turn off the CMS admin help widget from the front end.'));
    }

    /**
     * Calculate what the sender's email is
     * This must be set in .env to a validated email address
     * Note: SSP provide pre-validated *.sites.silverstripe.com email addresses
     *
     * @return string
     **/
    public static function EmailFrom()
    {
        if ($email = Environment::getEnv('SS_SEND_ALL_EMAILS_FROM')) {
            return $email;
        }
        return 'noreply@plasticstudio.co';
    }

    /**
     * Prepare the email recipient(s)
     * This is managed in the CMS, but comma-separated values need to be exploded
     * to conform with RFC 2822, 3.6.2. SwiftMailer requires compliance.
     *
     * @return array
     **/
    public function EmailRecipients()
    {
        if (isset($this->owner->EmailRecipients) && !is_null($this->owner->EmailRecipients)) {
            return str_getcsv($this->owner->EmailRecipients, ',');
        }
        return [];
    }
}
