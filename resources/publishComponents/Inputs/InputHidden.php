<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputHidden extends Component
{
    public $property;

    public $label;

    public $placeholder;

    public $old;

    public $required;

    public $maxlength;

    public $minlength;

    public $classDiv;

    public $classLabel;

    public $classInput;

    public $readonly;

    public $disabled;

    public $entity;

    public $pivot;

    public $itemPivot;

    public $autofocus;

    public $itemProperty;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $property,
        $old = null,
        $required = false,
        $entity = null,
        $pivot = false,
        $itemPivot = null,
        $itemProperty = null
    ) {
        $this->property = $property;
        $this->old = $old;
        $this->required = $required;
        $this->entity = $entity;
        $this->pivot = $pivot;
        $this->itemPivot = $itemPivot;
        $this->itemProperty = $itemProperty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-hidden');
    }
}
