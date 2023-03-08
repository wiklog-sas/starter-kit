@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
@endphp

<div class="{{ $errors->has($property) ? 'alert alert-danger' : '' }}">
  <label for="{{ $property }}" class="inp {{ $classLabel }} {{ $required ? 'required' : '' }} @error($property) is-invalid @enderror">
    <input type="text"
           name="{{ $property }}"
           id="{{ $property }}"
           value="{{ old($property, $old) }}"
           placeholder="&nbsp;"
           {!! $required ? 'required="required"' : '' !!}
           {!! $maxlength != null ? 'maxlength="' . $maxlength . '"' : '' !!}
           {!! $minlength != null ? 'minlength="' . $minlength . '"' : '' !!}
    />
    <span class="label">{{ $label }}</span>
    <span class="focus-bg"></span>
  </label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
