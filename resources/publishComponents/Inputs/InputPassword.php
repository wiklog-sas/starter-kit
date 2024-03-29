<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputPassword extends Component
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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($property, $label, $placeholder = null, $old = null, $required = false, $maxlength = null, $minlength = null, $classDiv = null, $classLabel = null, $classInput = null)
    {
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
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-password');
    }
}
