@props([
    'entity',                                                           {{--  :entity="$entity" --}}
    'entityName',                                                       {{--  entityName="entity" --}}
    'listeNomDocuments',                                                {{--  :listeNomDocuments="$liste_nom_documents" --}}
    'label' => 'Téléverser des documents',
    'classDiv' => '',
    'largeurAffichageDocument' => '6',
    'required' => false,
    'disabled' => false,
    'deleteFile' => true,
    'inputFile' => true,
])

<div class="{{ $classDiv }}">
    @if ($inputFile) 
      <x-inputs.input-file property="documents" label="{{ $label }}" multiple="true" required="{{ $required }}" disabled="{{ $disabled }}" />
    @endif

    @if ($entity !== null)
      @foreach ($listeNomDocuments as $nom_document)
          <div class="row mb-1">
          <div class="col-md-{{ $largeurAffichageDocument }}">{{ $nom_document }}</div>
          <div class="col">
              <a href="{{ route($entityName . '.document.telecharger', [$entityName => $entity->id, 'document' => $nom_document]) }}"><i class="fal fa-file-alt btn btn-outline-info btn-inline"></i></a>
              @if ($deleteFile)
                <a href="#" onclick="suppressionDocument('{{ route($entityName . '.document.supprimer', [$entityName => $entity->id, 'document' => $nom_document]) }}')" class="btn btn-outline-danger btn-inline"><i class="fal fa-trash-alt"></i></a> 
              @endif
              <br />
          </div>
          </div>
      @endforeach
    @endif
</div>

<script>
    function suppressionDocument(url) {
      event.preventDefault();
      return (
        Swal.fire({
          title: 'Confirmez-vous la suppression du document ?',
          icon: 'question',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: true,
          confirmButtonText: 'Oui',
          cancelButtonText: 'Non',
        }).then((result) => {
          if (result.value) {
            window.location.href = url;
          } else {
            return false
          }
        })
      );
    }
</script>