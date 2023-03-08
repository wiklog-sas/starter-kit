<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputRadio extends Component
{
    public $property;

    public $label;

    public $value;

    public $old;

    public $checked;

    public $required;

    public $disabled;

    public $classDiv;

    public $classLabel;

    public $classInput;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($property, $label, $value, $old = null, $checked = false, $required = false, $disabled = false, $classDiv = '', $classLabel = '', $classInput = '')
    {
        $this->property = $property;
        $this->label = $label;
        $this->value = $value;
        $this->old = $old;
        $this->checked = $checked;
        $this->required = $required;
        $this->disabled = $disabled;
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
        return view('components.inputs.input-radio');
    }
}
