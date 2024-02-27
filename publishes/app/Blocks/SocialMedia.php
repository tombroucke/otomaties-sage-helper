<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\AcfComposer;
use StoutLogic\AcfBuilder\FieldsBuilder;

// TODO: Replace FunctionalityPluginNamespace with your namespace
use FunctionalityPluginNamespace\Facades\SocialMedia as SocialMediaFacade;

class SocialMedia extends Block
{
    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'custom';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'share';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => ['left', 'center', 'right'],
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => false,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param AcfComposer $composer
     */
    public function __construct(AcfComposer $composer)
    {
        $this->name = __('Social Media', 'sage');
        $this->slug = 'social-media';
        $this->description = __('A simple Social Media block.', 'sage');
        parent::__construct($composer);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'channels' => SocialMediaFacade::channels()
                ->map(function ($channel, $key) {
                    $channel['icon'] = str_replace('facebook', 'facebook-f', $channel['icon']);
                    return $channel;
                })
                ->sortBy(function ($channel) {
                    return $channel['label'];
                })
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $socialMedia = new FieldsBuilder('social_media');
        return $socialMedia->build();
    }
}
