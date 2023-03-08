@php
  $required = isset($required) ? ($required === "true" ? true : false) : false;
  $disabled  = isset($disabled) ? ($disabled === 'true' ? true : false) : false;
  $readonly  = isset($readonly) ? ($readonly === 'true' ? true : false) : false;
@endphp

<div class="{{ $classDiv ?? 'form-floating mb-3'}}" id="div_{{ $property }}">

  @if (!empty($classDivInput))
    <div class="{{ $classDivInput }}">
  @endif
  <input type="text"
         name="{{ $property }}"
         id="{{ $property }}"
         class="{{ $classInput ?? 'form-control'}} @error($property) is-invalid @enderror"
         placeholder="{{ $placeholder??$label }}"
         value="{{ str_replace(' ', '', old($property, $entity != null ? $entity->$property : ($old ?? ''))) }}"
         {!! $required ? 'required="required"' : '' !!}
         {!! $maxlength != null ? 'maxlength="' . $maxlength . '"' : '' !!}
         {!! $minlength != null ? 'minlength="' . $minlength . '"' : '' !!}
         onblur="ajouterSeparateurTelephone('{{ $property }}')"
         onfocus="retirerSeparateurTelephone('{{ $property }}')"
         {!! $disabled == 'true' ? 'disabled' : '' !!}
         {!! $readonly == 'true' ? 'readonly' : '' !!}
  />
  <label for="{{ $property }}" class="{{ $classLabel ?? '' }} {{ $required ? 'required' : '' }}">{{ $label }}</label>
  @error($property)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
  @if (!empty($classDivInput))
    </div>
  @endif
</div>

<script>
  function ajouterSeparateurTelephone(item){
    let telephoneItem = document.getElementById(item);
    let telephoneValue = telephoneItem.value.replace(/(.{2})(?=.)/g,"$1 ");
    telephoneItem.value = telephoneValue;
  }

  function retirerSeparateurTelephone(item){
    let telephoneItem = document.getElementById(item);
    let telephoneValue = telephoneItem.value.replace(/ /g, "");
    telephoneItem.value = telephoneValue;
  }
</script>
