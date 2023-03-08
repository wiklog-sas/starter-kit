@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
  $readonly = isset($readonly) ? ($readonly === "true" ? true : false) : false;
  $disabled = isset($disabled) ? ($disabled === "true" ? true : false) : false;
  $checked = isset($checked) ? ($checked === "true" ? true : false) : false;
  $customValue = isset($customValue) ? ($customValue === "true" ? true : false) : false;
@endphp

<div class="{{ $classDiv ?? 'form-check form-switch mb-3'}} @error($property) is-invalid @enderror">
  <input type="checkbox"
         name="{{ $property }}"
         id="{{ $property }}"
         class="{{ $classInput ?? 'form-check-input'}} @error($property) is-invalid @enderror"
         value="{{ $customValue ? (old($property, $entity != null ? $entity->$property : ($old ?? ''))) : 1 }}"
         {!! $required ? 'required="required"' : '' !!}
         {!! $readonly ? 'readonly="readonly"' : '' !!}
         {!! $disabled ? 'disabled' : '' !!}
         {!! $checked ? 'checked' : '' !!}
  />
  <label for="{{ $property }}"
         id="label_{{ $property }}"
         name="label_{{ $property }}"
         class="{{ $classLabel ?? 'form-check-label' }}
         {{ $required ? 'required' : '' }}"
  >
    {!! $label !!}
  </label>
  {{ $slot }}
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
