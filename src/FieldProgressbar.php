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

    /**
     * remove label in detail field
     *
     * @return $this
     */
    public function hideLabel()
    {
        return $this->withMeta(['hideLabel' => true]);
    }

    /**
     * add subtitle together to value in progress bar
     *
     * @return $this
     */
    public function subtitleInDetail(string $subtitle)
    {
        return $this->withMeta(['subtitle' => $subtitle]);
    }
}
