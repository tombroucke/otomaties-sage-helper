<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Block extends Component
{
    /**
     * The ACF block
     *
     * @var mixed
     */
    public $acfBlock;

    /**
     * Option background for this block
     *
     * @var string|boolean
     */
    public $background;

    /**
     * Create a new component instance.
     *
     * @param mixed $block
     * @param string\boolean $background
     */
    public function __construct($block, $background = false)
    {
        $this->acfBlock = $block;
        $this->background = $background;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.block');
    }

    /**
     * Check if container needs to be closed & reopened
     *
     * @return boolean
     */
    public function extendsOutsideContainer() : bool
    {
        $alignmentsOutsideContainer = ['full', 'wide'];
        return in_array($this->acfBlock->block->align, $alignmentsOutsideContainer);
    }

    /**
     * Check if container should be wide
     *
     * @return boolean
     */
    public function wide() : bool
    {
        return 'wide' == $this->acfBlock->block->align;
    }

    /**
     * Container class
     *
     * @return string
     */
    public function containerClass() : string
    {
        return 'container';
    }

    /**
     * Get default block attributes: class & optional ID
     *
     * @return array
     */
    public function defaultAttributes() : array
    {
        $attributes = [
            'class' => "block {$this->acfBlock->classes}"
        ];

        if (isset($this->acfBlock->block->anchor)) {
            $attributes['id'] = $this->acfBlock->block->anchor;
        }
        return $attributes;
    }
}
