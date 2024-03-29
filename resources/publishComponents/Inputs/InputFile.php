<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputFile extends Component
{
    public $property;

    public $label;

    public $placeholder;

    public $old;

    public $required;

    public $classDiv;

    public $classLabel;

    public $classInput;

    public $readonly;

    public $disabled;

    public $entity;

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
        $classDiv = null,
        $classLabel = null,
        $classInput = null,
        $readonly = false,
        $disabled = false,
        $entity = null
    ) {
        $this->property = $property;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->old = $old;
        $this->required = $required;
        $this->classDiv = $classDiv;
        $this->classLabel = $classLabel;
        $this->classInput = $classInput;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->entity = $entity;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-file');
    }
}
