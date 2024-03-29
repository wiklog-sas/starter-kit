<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputNumber extends Component
{
    public $property;

    public $label;

    public $placeholder;

    public $old;

    public $step;

    public $required;

    public $max;

    public $min;

    public $classDiv;

    public $classLabel;

    public $classInput;

    public $entity;

    public $disabled;

    public $readonly;

    public $pivot;

    public $itemPivot;

    public $decimal;

    public $currency;

    public $itemProperty;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $property,
        $label,
        $placeholder = null,
        $old = null,
        $step = 1,
        $required = false,
        $max = null,
        $min = null,
        $classDiv = null,
        $classLabel = null,
        $classInput = null,
        $entity = null,
        $disabled = false,
        $readonly = false,
        $pivot = false,
        $itemPivot = null,
        $decimal = false,
        $currency = false,
        $itemProperty = null
    ) {
        $this->property = $property;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->old = $old;
        $this->step = $step;
        $this->required = $required;
        $this->max = $max;
        $this->min = $min;
        $this->classDiv = $classDiv;
        $this->classLabel = $classLabel;
        $this->classInput = $classInput;
        $this->entity = $entity;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->pivot = $pivot;
        $this->itemPivot = $itemPivot;
        $this->decimal = $decimal;
        $this->currency = $currency;
        $this->itemProperty = $itemProperty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-number');
    }
}
