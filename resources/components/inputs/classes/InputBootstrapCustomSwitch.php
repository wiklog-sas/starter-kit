<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputBootstrapCustomSwitch extends Component
{
    public $property;

    public $label;

    public $old;

    public $required;

    public $classDiv;

    public $classLabel;

    public $classInput;

    public $readonly;

    public $disabled;

    public $checked;

    public $entity;

    public $customValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($property, $label, $old = null, $required = false, $classDiv = null, $classLabel = null, $classInput = null, $readonly = false, $disabled = false, $checked = false, $entity = null, $customValue = false)
    {
        $this->property = $property;
        $this->label = $label;
        $this->old = $old;
        $this->required = $required;
        $this->classDiv = $classDiv;
        $this->classLabel = $classLabel;
        $this->classInput = $classInput;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->checked = $checked;
        $this->entity = $entity;
        $this->customValue = $customValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-bootstrap-custom-switch');
    }
}
