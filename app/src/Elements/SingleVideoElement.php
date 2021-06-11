<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use Embed\Adapters\Adapter;
use Embed\Embed;
use SilverStripe\Forms\TextField;

/**
 * Video element block.
 */
class SingleVideoElement extends BaseElement
{
    private static $table_name = 'SingleVideoElement';

    private static $singular_name = 'Single Video Element';

    private static $plural_name = 'Single Video Elements';

    private static $description = 'Full width video element';

    private static $icon = 'font-icon-block-media';

    private static $db = [
        'VideoEmbedURL' => 'Text',
        'EmbedHTML' => 'Text',
    ];

    private static $has_one = [
    ];

    private static $owns = [
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('EmbedHTML');

        $fields->addFieldToTab('Root.Main', TextField::create('VideoEmbedURL', 'Video Embed URL')
            ->setDescription('eg. https://www.youtube.com/watch?v=xxxxxxx or https://player.vimeo.com/video/xxxxxxx <br/> Adding URL here will auto-generate the below Embed HTML'));

        $fields->addFieldToTab('Root.Main', TextField::create('EmbedHTML', 'Embed HTML')
            ->setDescription('This will be auto-generated from the above URL'));

        return $fields;
    }

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Video');
    }

    /**
     * @inheritDoc
     */
    public function onBeforeWrite()
    {
        $changes = $this->getChangedFields();

        // if the VideoEmbedURL has changed then update the embedHTML
        if (isset($changes['VideoEmbedURL']) && $changes['VideoEmbedURL']['after']) {
            $this->updateEmbedHTML();
        }

        parent::onBeforeWrite();
    }

    /**
     * Create embed object from this elements VideoEmbedURL used for extracting data
     *
     * @return void
     */
    public function updateEmbedHTML()
    {
        if ($this->VideoEmbedURL) {
            $info = Embed::create($this->VideoEmbedURL);
            $this->setFromEmbed($info);
        }
    }

    /**
     * Set db fields based on embed meta-data
     *
     * @param Adapter $info
     */
    public function setFromEmbed(Adapter $info)
    {
        // $this->Title = $info->getTitle();
        // $this->SourceURL = $info->getUrl();
        // $this->Width = $info->getWidth();
        // $this->Height = $info->getHeight();
        // $this->ThumbURL = $info->getImage();
        // $this->Description = $info->getDescription() ? $info->getDescription() : $info->getTitle();
        // $this->Type = $info->getType();

        // get code returns full html tags
        // for example if youtube url supplied, it will return <iframe ..
        // or if supplied img url it will return <img ...
        $embed = $info->getCode();
        $this->EmbedHTML = $embed ? $embed : '';
    }
}
