<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputSepa extends Component
{
    public $entity;

    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $entity = null,
        $required = 'true',
    ) {
        $this->entity = $entity;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-sepa');
    }
}
