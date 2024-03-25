<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputSelectPicker extends Component
{
    public $property;

    public $label;

    public $values;

    public $itemValue;

    public $itemLabel;

    public $title;

    public $dataLiveSearch;

    public $old;

    public $olds;

    public $required;

    public $defaultFirstItemLabel;

    public $defaultFirstItemValue;

    public $classDiv;

    public $classLabel;

    public $classInput;

    public $multiple;

    public $entity;

    public $width;

    public $pivot;

    public $itemPivot;

    public $disabled;

    public $readonly;

    public $liaison;

    public $itemProperty;

    public $dataAttributes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $property,
        $label,
        $values,
        $itemValue = 'id',
        $itemLabel = 'libelle',
        $title = null,
        $dataLiveSearch = true,
        $old = null,
        $olds = null,
        $required = false,
        $defaultFirstItemLabel = null,
        $defaultFirstItemValue = -1,
        $classDiv = null,
        $classLabel = null,
        $classInput = null,
        $multiple = false,
        $entity = false,
        $width = '100%',
        $pivot = false,
        $itemPivot = null,
        $disabled = false,
        $readonly = false,
        $liaison = null,
        $itemProperty = null,
        $dataAttributes = null
    ) {
        $this->property = $property;
        $this->label = $label;
        $this->values = $values;
        $this->itemValue = $itemValue;
        $this->itemLabel = $itemLabel;
        $this->title = $title;
        $this->dataLiveSearch = $dataLiveSearch;
        $this->old = $old;
        $this->olds = $olds;
        $this->defaultFirstItemLabel = $defaultFirstItemLabel;
        $this->defaultFirstItemValue = $defaultFirstItemValue;
        $this->required = $required;
        $this->classDiv = $classDiv;
        $this->classLabel = $classLabel;
        $this->classInput = $classInput;
        $this->multiple = $multiple;
        $this->entity = $entity;
        $this->width = $width;
        $this->pivot = $pivot;
        $this->itemPivot = $itemPivot;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->liaison = $liaison;
        $this->itemProperty = $itemProperty;
        $this->dataAttributes = $dataAttributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.input-selectpicker');
    }
}
