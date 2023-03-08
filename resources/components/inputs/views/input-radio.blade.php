@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
  $checked = isset($checked) ? ($checked === "true" ? true : false) : false;
  $disabled = isset($disabled) ? ($disabled === "true" ? true : false) : false;
@endphp

<div class="custom-control custom-radio my-2 {{ $classDiv ?? '' }}">
  <input type="radio"
         {{ $attributes->merge(['class' => 'form-check-input mt-0' . ($errors->has($property) ? ' is-invalid' : '')]) }}
         name="{{ $property }}"
         id="{{ $property . '-' . Str::slug($label) }}"
         value="{{ $value }}"
         {{ $required ? 'required' : '' }}
         {{ $disabled ? 'disabled' : '' }}
         {{ ($checked || old($property, $old ?? '') == $value) ? 'checked=checked' : '' }}
  />
  <label for="{{ $property . '-' . Str::slug($label) }}" class="custom-control-label {{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">{!! $label !!}</label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
