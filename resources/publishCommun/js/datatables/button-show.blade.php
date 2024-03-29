@can($path . '-retrieve')
  `
  <a href="{{ url($path) }}/` + row.{{ $id ?? 'id' }} + `" class="btn btn-outline-info btn-inline btn-fit" data-bs-toggle="tooltip" title="Voir">
    <i class="fa-regular fa-eye fa-fw"></i>
  </a>&nbsp;
  `
@else
  `
  <a href="#" class="btn btn-outline-dark btn-inline btn-fit disabled" data-bs-toggle="tooltip" title="Modifier">
    <i class="fa-regular fa-pen-to-square fa-fw"></i>
  </a>&nbsp;
  `
@endcan
