@props(['disabled' => false])

@php
  $required = isset($required) ? bool_val($required) : false;
@endphp

<div class="form-check form-switch pb-3 {{ $classDiv }}">
  <input type="checkbox"
         class="form-check-input"
         name="{{ $property }}"
         id="{{ $property }}"
         value="1"
         role="switch"
         {{ $required ? 'required' : '' }}
         {{ ($checked || old($property, $old ?? '')) ? 'checked="checked"' : '' }}
         {{ $disabled ? 'disabled="disabled"' : '' }}
  />
  <label for="{{ $property }}" class="form-check-label {{ $classLabel ?? '' }} {{ $required ?? false ? 'required' : '' }}">{!! $label !!}</label>
  <x-inputs.input-error-property />
</div>
