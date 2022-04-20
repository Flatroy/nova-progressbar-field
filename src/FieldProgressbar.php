<?php

namespace Flatroy\FieldProgressbar;

use Laravel\Nova\Fields\Field;

class FieldProgressbar extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'field-progressbar';

    /**
     * options to send along
     *
     * @return $this
     */
    public function options(array $options)
    {
        return $this->withMeta(['options' => $options]);
    }
}
