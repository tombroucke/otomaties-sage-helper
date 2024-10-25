<?php

namespace App\Blocks\Concerns;

trait VerticalAlign
{
    public function verticalAlignClass()
    {
        $class = '';
        if (! is_object($this->block) || ! $this->block->align_content) {
            return $class;
        }
        switch ($this->block->align_content) {
            case 'center':
                $class = 'align-items-center';
                break;
            case 'top':
                $class = 'align-items-start';
                break;
            case 'bottom':
                $class = 'align-items-end';
                break;
        }

        return $class;
    }
}
