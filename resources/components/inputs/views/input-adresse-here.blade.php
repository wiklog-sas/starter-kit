@aware(['adresse' => $entity])

<div class="form-floating mb-3" id="div_libelle">
  <input type="text" name="adresse" id="adresse" class="form-control " placeholder="Adresse" list="adresses" onkeyup="majListe(this.value, {{ $gps }})" autocomplete="no">
  <ul id="adresses" class="d-none list-unstyled border">
  </ul>
  <label for="libelle" class=" ">
    Adresse (saisir 5 caractères minimum)
  </label>
</div>
<input type="hidden" name="adresse_id" value="{{ $adresse?->id }}">
<x-inputs.input-text property="ligne1" :entity="$adresse" label="Adresse ligne 1" required="true" maxlength="150" class="bg-light" />
<x-inputs.input-text property="ligne2" :entity="$adresse" label="Adresse ligne 2" required="false" maxlength="150" class="bg-light" />
<x-inputs.input-text property="code_postal" :entity="$adresse" label="Code Postal" required="true" maxlength="5" class="bg-light" />
<x-inputs.input-text property="ville" :entity="$adresse" label="Ville" required="true" maxlength="75" class="bg-light" />

@include('commun.js.maps.here')
