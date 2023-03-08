@props([
  'property',
  'label',
  'placeholder',
  'old',
  'required' => false,
  'maxlength',
  'minlength',
  'classDiv',
  'classLabel',
  'classInput',
  'readonly' => false,
  'disabled' => false,
  'entity',
  'pivot' => false,
  'itemPivot',
  'autofocus' => false,
  'itemProperty'
])

<div class="{{ $classDiv ?? 'form-floating mb-3' }}" id="div_{{ $property }}">

  <input type="text" name="{{ $property }}" id="{{ $property }}" {{ $attributes->merge(['class' => 'form-control' . ($errors->has($property) ? ' is-invalid' : '')]) }}
    placeholder="{{ $placeholder ?? $label }}"
    value="{{ old($property, $entity != null 
      ? 
        ($itemPivot == null 
          ? ($itemProperty == null 
            ? $entity->$property 
            : $entity->$itemProperty)
          : ($pivot 
            ? $entity->pivot->$itemPivot 
            : $entity->$itemPivot)
        ) 
      : ($old ?? '')) }}"
    {{ bool_val($required) ? 'required="required"' : '' }}
    {{ $maxlength != null ? 'maxlength=' . $maxlength : '' }}
    {{ $minlength != null ? 'minlength=' . $minlength : '' }}
    {{ bool_val($readonly) ? 'readonly="readonly"' : '' }}
    {{ bool_val($disabled) ? 'disabled' : '' }}
    {{ bool_val($autofocus) ? 'autofocus' : '' }}
  />
  <label for="{{ $property }}" class="{{ $classLabel ?? '' }} {{ bool_val($required) ? 'required' : '' }}">
    {{ $label }}
  </label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

@if (bool_val($autofocus))  
  <script>
    window.onload = function() {
      document.getElementById("{{ $property }}").focus();
    };
  </script>
@endif
