<div aria-label="breadcrumb" class="breadcrumb">
  <ol class="breadcrumb w-100 mt-3">
    <li class="breadcrumb-item">
      <a href="{{ route('accueil') }}" class="ms-2"><i class="fa-solid fa-house me-1"></i>{{ __('Accueil') }}</a>
    </li>
    @foreach ($breadcrumb_items as $breadcrumb_item)
      <li class="breadcrumb-item {{ $breadcrumb_item->isActive ? 'active' : '' }}">
        <a href="{{ $breadcrumb_item->lien }}">{{ $breadcrumb_item->libelle }}</a>
      </li>
    @endforeach
  </ol>
</div>
