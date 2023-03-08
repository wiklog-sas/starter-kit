@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
  $multiple = isset($multiple) ? ($multiple === "true" ? true : false) : false;
  $pivot    = isset($pivot) ? ($pivot === "true" ? true : false) : false;
  $entity   = isset($entity) ? $entity : null;
  $disabled = isset($disabled) ? bool_val($disabled) : false;
  $readonly = isset($readonly) ? bool_val($readonly) : false;
  $itemPivot = isset($itemPivot) ? $itemPivot : null;
  $liaison = isset($liaison) ? $liaison : null;
  $itemProperty = isset($itemProperty) ? $itemProperty : null;
  $dataAttributes = isset($dataAttributes) ? $dataAttributes : null;
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3'}} @error($property) is-invalid @enderror" id="div_{{ $property }}">
  
  <select name="{{ $property }}"
          id="{{ $multiple ? str_replace(['[', ']'], '', $property) : $property }}"
          class="selectpicker {{ $classInput ?? 'form-control form-control-sp'}} @error($property) is-invalid @enderror"
          data-live-search="{{ $dataLiveSearch ?? 'true' }}"
          data-live-search-normalize="true"
          data-width="{{ $width ?? '100%' }}"
          title="{{ $title ?? $label }}"
          {{ $multiple ? 'multiple' : '' }}
          {{ $required ? 'required' : '' }}
          {{ $disabled ? 'disabled' : '' }}
          {{ $readonly ? 'readonly' : '' }}
  >
    {{-- @if ($required)
      <option value="{{ $defaultFirstItemValue ?? '' }}" disabled="disabled" selected="selected">{{ $defaultFirstItemLabel??$label }}</option>
    @endif --}}
    @php
        $itemValue = $itemValue ?? 'id';
        $itemLabel = $itemLabel ?? 'libelle';
    @endphp
    @foreach ($values as $value)
      <option value="{{ $value->$itemValue }}"
        id="{{ 'opt_' . ($multiple ? str_replace(['[', ']'], '', $property) : $property) . '_' . $value->$itemValue }}"
        data-liaison="{{ $liaison != null ? $value->$liaison : '' }}"
        class=""
        @if ($dataAttributes !== null)
          data-attribute="{{ $value->$dataAttributes }}"
        @endif
        @php
          if(!isset($old) && !$multiple) {
            $old = old($property, $entity != null 
            ? ($itemPivot == null 
              ? ($itemProperty == null 
                ? $entity->$property 
                : $entity->$itemProperty) 
              : ($pivot 
                ? $entity->pivot->$itemPivot 
                : $entity->$itemPivot)) 
            : '');
          } else {
            $olds = old(str_replace(['[', ']'], '', $property), $olds ?? []);
          }
        @endphp
        @if ($multiple)
          {{ in_array($value->$itemValue, $olds) ? 'selected' : '' }}>{{ $value->$itemLabel }}
        @else
          {{ $old == $value->$itemValue ? 'selected' : '' }}>{{ $value->$itemLabel }}
        @endif
      </option>
    @endforeach
    @isset($slot)
      {!! $slot !!}  
    @endisset
  </select>

  @if (!$required && !$multiple)
    <span class="remove-icon">
      <i class="fal fa-light fa-times" id="remove_{{ $property }}"></i>
    </span>
  @endif

  <label for="{{ $multiple ? str_replace(['[', ']'], '', $property) : $property }}" class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">{{ $label }}</label>

  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

@if (!$required && !$multiple)
  <script>
    const remove_{{ $property }} = document.getElementById("remove_{{ $property }}");

    remove_{{ $property }}.addEventListener("click", () => {
      $('#{{ $property }}').val('');
      $('#{{ $property }}').selectpicker('render');
    });
  </script>
@endif