@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3'}}">
  <input type="password"
         name="{{ $property }}"
         id="{{ $property }}"
         class="{{ $classInput ?? 'form-control'}} @error($property) is-invalid @enderror"
         placeholder="{{ $placeholder ?? $label }}"
         value="{{ old($property, $old ?? null) }}"
         {!! $required ? 'required="required"' : '' !!}
         {!! $maxlength != null ? 'maxlength="' . $maxlength . '"' : '' !!}
         {!! $minlength != null ? 'minlength="' . $minlength . '"' : '' !!}
  />
  <label for="{{ $property }}" class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">{{ $label }}</label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
