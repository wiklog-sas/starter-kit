<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputAdresseHere extends Component
{
    public $entity;

    public $gps;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $entity = null,
        $gps = 'true',
    ) {
        $this->entity = $entity;
        $this->gps = $gps;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-adresse-here');
    }
}
