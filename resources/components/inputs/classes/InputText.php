<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputText extends Component
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
        $label,
        $placeholder = null,
        $old = null,
        $required = false,
        $maxlength = null,
        $minlength = null,
        $classDiv = null,
        $classLabel = null,
        $classInput = null,
        $readonly = false,
        $disabled = false,
        $entity = null,
        $pivot = false,
        $itemPivot = null,
        $autofocus = false,
        $itemProperty = null
    ) {
        $this->property = $property;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->old = $old;
        $this->required = $required;
        $this->maxlength = $maxlength;
        $this->minlength = $minlength;
        $this->classDiv = $classDiv;
        $this->classLabel = $classLabel;
        $this->classInput = $classInput;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->entity = $entity;
        $this->pivot = $pivot;
        $this->itemPivot = $itemPivot;
        $this->autofocus = $autofocus;
        $this->itemProperty = $itemProperty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-text');
    }
}
