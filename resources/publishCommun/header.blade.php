<header class="header">
  <nav class="navbar navbar-expand-lg fixed-top px-4 py-2 bg-white shadow">
    <a class="" data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasScrolling">
      <i class="fas fa-align-left me-3"></i>
      <span class="d-none d-sm-inline h5">{{ __('Menu') }}</span>
    </a>
    <span class="d-flex-block m-auto h6">
      Titre Laravel Template
    </span>
    <ul class="d-flex align-items-center list-unstyled mb-0">

      <li class="nav-item dropdown ms-auto">
        <a class="nav-link pe-0" id="userInfo" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar">{{ Auth::user()?->initials }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userInfo">
          <div class="dropdown-header text-gray-700">
            <h6 class="text-uppercase font-weight-bold">{{ Auth::user()?->identity }}</h6><small>{{ Auth::user()?->inline_roles }}</small>
          </div>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="
              event.preventDefault();
              Swal.fire({
                title: '{{ __('Would you like to disconnect?') }}',
                text: '',
                icon: 'warning'
              }).then((result) => {
                if (result.value) {
                  document.getElementById('logout-form').submit();
                }else {
                  return false
                }
              });
            ">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
</header>
