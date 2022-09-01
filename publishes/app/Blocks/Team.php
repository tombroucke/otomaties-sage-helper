<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Roots\Acorn\Application;
use Otomaties\AcfObjects\Acf;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Team extends Block
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
    public $icon = 'admin-users';

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
        'align' => ['full', 'wide'],
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
    ];

    /**
     * Set title, description & slug, allow for translation
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->name = __('Team', 'sage');
        $this->slug = 'team';
        $this->description = __('Display team members', 'sage');
        parent::__construct($app);
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'members' => Acf::getField('members'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $team = new FieldsBuilder('team');

        $team
            ->addRepeater('members')
                ->addImage('image', [
                    'label' => __('Image', 'sage')
                ])
                ->addText('name', [
                    'label' => __('Name', 'sage'),
                    'required' => true,
                ])
                ->addText('function', [
                    'label' => __('Function', 'sage'),
                    'required' => true,
                ])
                ->addText('phone', [
                    'label' => __('Phone', 'sage')
                ])
                ->addEmail('email', [
                    'label' => __('E-mailaddress', 'sage')
                ])
                ->addTextarea('description', [
                    'label' => __('Description', 'sage')
                ])
            ->endRepeater();

        return $team->build();
    }
}
