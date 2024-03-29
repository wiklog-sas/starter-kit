<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{ __('Menu') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <ul class="list-unstyled">

      {{-- Accueil --}}
      <x-menu-item level_menu_1="home" label="{{ __('Accueil') }}" link="{{ route('accueil') }}" />

      {{-- Livre --}}
      {{-- <x-menu-item level_menu_1="livre" label="{{ __('Livre') }}" link="{{ route('livre.index') }}" /> --}}

        {{-- Associations
        <x-menu-item level_menu_1="associations" label="{{ __('Associations') }}">
          <x-menu-subitem level_menu_2="association" label="{{ Auth::user()->isA(\App\Models\Commun\Role::ROLE_RESPONSABLE_ASSO) ? 'Mes associations' : 'Associations' }}"
            link="{{ route('association.index') }}" />
          <x-menu-subitem level_menu_2="dossier_subvention"
            label="{{ Auth::user()->isA(\App\Models\Commun\Role::ROLE_RESPONSABLE_ASSO) ? 'Mes dossiers de subventions' : 'Dossiers de subvention' }}"
            link="{{ route('dossier-subvention.index') }}" />
        </x-menu-item> --}}
    </ul>
  </div>
</div>
