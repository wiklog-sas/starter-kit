<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputTextArea extends Component
{
    public $property;

    public $label;

    public $placeholder;

    public $old;

    public $required;

    public $classDiv;

    public $classLabel;

    public $classInput;

    public $rows;

    public $entity;

    public $readonly;

    public $disabled;

    public $pivot;

    public $itemPivot;

    public $itemProperty;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $property,
        $label,
        $placeholder = '',
        $old = null,
        $required = false,
        $classDiv = null,
        $classLabel = null,
        $classInput = null,
        $rows = 110,
        $entity = null,
        $readonly = false,
        $disabled = false,
        $pivot = false,
        $itemPivot = null,
        $itemProperty = null
    ) {
        $this->property = $property;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->old = $old;
        $this->required = $required;
        $this->classDiv = $classDiv;
        $this->classLabel = $classLabel;
        $this->classInput = $classInput;
        $this->rows = $rows;
        $this->entity = $entity;
        $this->pivot = $pivot;
        $this->itemPivot = $itemPivot;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->itemProperty = $itemProperty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-textarea');
    }
}
