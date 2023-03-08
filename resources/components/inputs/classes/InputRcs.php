<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputRcs extends Component
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

    public $classDivInput;

    public $entity;

    public $disabled;

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
        $classDivInput = null,
        $entity = null,
        $disabled = false
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
        $this->classDivInput = $classDivInput;
        $this->entity = $entity;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-rcs');
    }
}
