@php
  $required  = isset($required) ? ($required === 'true' ? true : false) : false;
  $readonly  = isset($readonly) ? ($readonly === 'true' ? true : false) : false;
  $disabled  = isset($disabled) ? ($disabled === 'true' ? true : false) : false;
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3' }}" id="div_{{ $property }}">

  <input type="file" name="{{ $property }}" id="{{ $property }}" class="{{ $classInput ?? 'form-control form-control-sm' }} @error($property) is-invalid @enderror"
    placeholder="{{ $placeholder ?? $label }}"
    value="{{ old($property, $entity != null ? $entity->$property : ($old ?? '')) }}"
    {!! $required ? 'required="required"' : '' !!}
    {!! $readonly ? 'readonly="readonly"' : '' !!}
    {!! $disabled == 'true' ? 'disabled' : '' !!}
  />
  <label for="{{ $property }}" class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">
    {{ $label }}
  </label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
