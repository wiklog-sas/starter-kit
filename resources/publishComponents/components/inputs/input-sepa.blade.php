@aware([
    'entity' => $entity,
    'required' => $required,
])

<x-inputs.input-iban property="iban" :entity="$entity" label="IBAN" required="{{ $required }}" maxlength="34" minlength="14" />
<x-inputs.input-text property="bic" :entity="$entity" label="BIC" required="{{ $required }}" maxlength="11" />
<x-inputs.input-bootstrap-datepicker property="date_signature" :entity="$entity" label="Date de signature du mandat" required="{{ $required }}" />
<x-inputs.input-text property="numero_mandat" :entity="$entity" label="Référence du mandat de domiciliation / RUM" required="{{ $required }}" maxlength="75" minlength="5" />
