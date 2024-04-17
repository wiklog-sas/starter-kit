@props([
    'property' => null,
    'entity' => null,
    'label' => null,
    'placeholder' => null,
    'values' => [],
    'arrayValues' => [],
    'required' => false,
    'itemValue' => null,
    'itemLabel' => null,
    'multiple' => false,
    'old' => null,
    'olds' => null,
    'disabled' => false,
    'readonly' => false,
    'pivot' => false,
    'itemPivot' => null,
    'liaison' => null,
    'itemProperty' => null,
    'dataAttributes' => null,
])

@php
  $required = bool_val($required);
  $multiple = bool_val($multiple);
  $pivot = bool_val($pivot);
  $disabled = bool_val($disabled);
  $readonly = bool_val($readonly);
  $itemProperty = $itemProperty ?? $property;
  $itemValue = $itemValue ?? 'id';
  $itemLabel = $itemLabel ?? 'libelle';
  if (!isset($old) && !$multiple) {
      $old = old($property, $entity != null
      ? ($itemPivot == null
        ? $entity->$itemProperty
        : ($pivot
          ? $entity->pivot->$itemPivot
          : $entity->$itemPivot))
      : '');
  } else {
      $olds = old(str_replace(['[', ']'], '', $property), $olds ?? []);
  }
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3' }} @error($property) is-invalid @enderror" id="div_{{ $property }}">
  <select name="{{ $property }}" id="{{ $multiple ? str_replace(['[', ']'], '', $property) : $property }}"
    class="form-select {{ $classInput ?? 'form-control form-control-sp' }} @error($property) is-invalid @enderror" 
    data-live-search="{{ $dataLiveSearch ?? 'true' }}"
    data-live-search-normalize="true" 
    data-width="{{ $width ?? '100%' }}" 
    title="{{ $title ?? $label }}" 
    {{ $multiple ? 'multiple' : '' }} 
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }} 
    {{ $readonly ? 'readonly' : '' }}
  >
    @if (! is_null($placeholder))
      <option></option>
    @endif
    @foreach ($values as $value)
      <option 
        value="{{ $value->$itemValue }}" id="{{ 'opt_' . ($multiple ? str_replace(['[', ']'], '', $property) : $property) . '_' . $value->$itemValue }}"
        data-liaison="{{ $liaison != null ? $value->$liaison : '' }}" class="" @if ($dataAttributes !== null) data-attribute="{{ $value->$dataAttributes }}" @endif
        @if ($multiple) {{ in_array($value->$itemValue, $olds) ? 'selected' : '' }}>{{ $value->$itemLabel }}
        @else
          {{ $old == $value->$itemValue ? 'selected' : '' }}>{{ $value->$itemLabel }} @endif
      </option>
    @endforeach
    @foreach ($arrayValues as $value)
      <option 
        value="{{ $value }}" id="{{ 'opt_' . ($multiple ? str_replace(['[', ']'], '', $property) : $property) . '_' . $value }}"
        class=""
        @if ($multiple) {{ in_array($value, $olds) ? 'selected' : '' }}>{{ $value }}
        @else
          {{ $old == $value ? 'selected' : '' }}>{{ $value }} @endif
    </option>
    @endforeach
  </select>
  @if ($label !== null)
    <label for="{{ $multiple ? str_replace(['[', ']'], '', $property) : $property }}"
    class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">{{ $label }}</label>
  @endif
</div>

<x-inputs.input-error-property />

<script type="module">
  document.addEventListener("DOMContentLoaded", (event) => {
    var selecteur = $('#{{ $multiple ? str_replace(['[', ']'], '', $property) : $property }}').select2({
        language: 'fr', 
        theme: 'bootstrap-5', 
        allowClear: true,
        placeholder: '{{ $placeholder ?? $label }}',
    });
    @if ($multiple === false)
      selecteur.data('select2')
      .$selection
          .css('height', '58px')
          .css('display', 'flex')
          .css('align-items', 'flex-end');

    @else
      selecteur.data('select2')
        .$selection
          .css('padding-top', '30px')

    @endif
});
  </script> 
