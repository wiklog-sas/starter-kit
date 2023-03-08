@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
@endphp

<div class="custom-control custom-checkbox my-2 {{ $classDiv }}">
  <input type="checkbox"
         class="custom-control-input"
         name="{{ $property }}"
         id="{{ $property }}"
         value="1"
        {{ ($checked || old($property, $old ?? '')) ? 'checked="checked"' : '' }}
  />
  <label for="{{ $property }}" class="custom-control-label {{ $classLabel ?? '' }} {{ $required ?? false ? 'required' : '' }}">{!! $label !!}</label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
