@props([
  'property',
  'label',
  'placeholder',
  'old',
  'required' => false,
  'max',
  'min',
  'classDiv',
  'classLabel',
  'classInput',
  'readonly' => false,
  'disabled' => false,
  'entity',
  'pivot' => false,
  'itemPivot',
  'autofocus' => false,
  'decimal' => false,
  'currency' => false,
  'itemProperty',
])

@php
  $old = old($property, $entity != null 
    ? ($itemPivot == null 
      ? ($itemProperty == null 
        ? $entity->$property 
        : $entity->$itemProperty) 
      : ($pivot 
        ? $entity->pivot->$itemPivot 
        : $entity->$itemPivot)) 
    : ($old ?? ''));
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3'}}">
  <input type="{{ (bool_val($decimal) || bool_val($currency)) ? 'text' : 'number' }}"
         name="{{ $property }}"
         id="{{ $property }}"
         class="{{ $classInput ?? 'form-control text-end'}} @error($property) is-invalid @enderror"
         placeholder="{{ $placeholder ?? $label }}"
         @if (bool_val($decimal) || bool_val($currency))
          value="{{ supprimer_decoration($old) }}"
         @else
          value="{{ $old }}"
         @endif
         step="{{ $step ?? 1}}"
         {!! bool_val($required) ? 'required' : '' !!}
         {!! $max != null ? 'max="' . $max . '"' : '' !!}
         {!! $min != null ? 'min="' . $min . '"' : '' !!}
         {!! bool_val($disabled) ? 'disabled' : '' !!}
         {!! bool_val($readonly) ? 'readonly' : '' !!}
        @if (bool_val($decimal) || bool_val($currency))
          onblur="ajouterDecoration('{{ $property }}', {{ bool_val($currency) }})"
          onfocus="retirerDecoration('{{ $property }}')"
        @endif
  />
  <label for="{{ $property }}" class="{{ $classLabel ?? '' }} {{ bool_val($required) ? 'required' : '' }}">{!! $label !!}</label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

@if (bool_val($decimal) || bool_val($currency))
  <script>
    function ajouterDecoration(item, isCurrency) {
      let input = document.getElementById(item);
      let options = isCurrency 
      ? 
        {
          style: 'currency',
          currency: 'EUR'
        }
      : 
        {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        };
      let value = input.value.replace(/,/g, '.');
      value = Number(value.replace(/[^0-9.-]+/g, ''));
      value = new Intl.NumberFormat('fr-FR', options).format(value);
      input.value = value;
    }

    function retirerDecoration(item) {
      let input = document.getElementById(item);
      let value = input.value.replace(/,/g, '.');
      value = Number(value.replace(/[^0-9.-]+/g, ''));
      input.value = value;
      input.select();
    }

    document.addEventListener("DOMContentLoaded", function() {
      ajouterDecoration('{{ $property }}', {{ bool_val($currency) }});
    });
  </script>
@endif