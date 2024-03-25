@props([
    'property' => null,
    'entity' => null,
    'label' => null,
    'values' => null,
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
    class="selectpicker {{ $classInput ?? 'form-control form-control-sp' }} @error($property) is-invalid @enderror" data-live-search="{{ $dataLiveSearch ?? 'true' }}"
    data-live-search-normalize="true" data-width="{{ $width ?? '100%' }}" title="{{ $title ?? $label }}" {{ $multiple ? 'multiple' : '' }} {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }}>
    {{-- @if ($required)
      <option value="{{ $defaultFirstItemValue ?? '' }}" disabled="disabled" selected="selected">{{ $defaultFirstItemLabel??$label }}</option>
    @endif --}}
    @foreach ($values as $value)
      <option value="{{ $value->$itemValue }}" id="{{ 'opt_' . ($multiple ? str_replace(['[', ']'], '', $property) : $property) . '_' . $value->$itemValue }}"
        data-liaison="{{ $liaison != null ? $value->$liaison : '' }}" class="" @if ($dataAttributes !== null) data-attribute="{{ $value->$dataAttributes }}" @endif
        @if ($multiple) {{ in_array($value->$itemValue, $olds) ? 'selected' : '' }}>{{ $value->$itemLabel }}
        @else
          {{ $old == $value->$itemValue ? 'selected' : '' }}>{{ $value->$itemLabel }} @endif
        </option>
    @endforeach
    @isset($slot)
      {!! $slot !!}
    @endisset
  </select>

  @if (!$required && !$multiple)
    <span class="remove-icon">
      <i class="fa-solid fa-times" id="remove_{{ $property }}"></i>
    </span>
  @endif

  <label for="{{ $multiple ? str_replace(['[', ']'], '', $property) : $property }}"
    class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">{{ $label }}</label>

  <x-inputs.input-error-property />
</div>

@if (!$required && !$multiple)
  <script>
    const remove_{{ $property }} = document.getElementById("remove_{{ $property }}");

    remove_{{ $property }}.addEventListener("click", () => {
      let select = $('#{{ $property }}');
      // select.val('');
      // select.selectpicker('render');
      // @see https://github.com/snapappointments/bootstrap-select/issues/2738#issuecomment-1240736229
      select.selectpicker('destroy'); // temporary patch!
      select.selectpicker(); // temporary patch!
    });
  </script>
@endif
