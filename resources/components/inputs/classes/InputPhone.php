<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputPhone extends Component
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

    public $readonly;

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
        $disabled = false,
        $readonly = false
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
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-phone');
    }
}
