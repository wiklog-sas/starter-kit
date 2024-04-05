@php
  $required  = isset($required) ? bool_val($required) : false;
  $readonly  = isset($readonly) ? bool_val($readonly) : false;
  $disabled  = isset($disabled) ? bool_val($disabled) : false;
  $multiple  = isset($multiple) ? bool_val($multiple) : false;
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3' }}" id="div_{{ $property }}">

  <input type="file" name="{{ $property }}{{ $multiple ? '[]' : ''}}" id="{{ $property }}" class="{{ $classInput ?? 'form-control form-control-sm' }} @error($property) is-invalid @enderror"
    placeholder="{{ $placeholder ?? $label }}"
    value="{{ old($property, $entity != null ? $entity->$property : ($old ?? '')) }}"
    {!! $required ? 'required="required"' : '' !!}
    {!! $readonly ? 'readonly="readonly"' : '' !!}
    {!! $disabled == 'true' ? 'disabled' : '' !!}
    {!! $multiple ? 'multiple="multiple"' : '' !!}
  />
  <label for="{{ $property }}" class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">
    {{ $label }}
  </label>
  @if ($multiple)
    @error($property.'.*')
      @foreach($errors->get('documents.*') as $document_errors)
        @foreach ($document_errors as $message)
          <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong><br />
          </span>
        @endforeach
      @endforeach
    @enderror
  @else
    <x-inputs.input-error-property />
  @endif
</div>
