@props([
    'level_menu_1' => 'home',
    'label' => '',
    'link' => '#',
])

@if ($slot->isEmpty())
  <li class="sidebar-list-item">
    <a class="sidebar-link text-muted {{ session('level_menu_1', 'home') == $level_menu_1 ? 'active' : '' }}" href="{{ $link }}">
      <span class="sidebar-link-title">{{ $label }}</span>
    </a>
  </li>
@else
  <li class="sidebar-list-item">
    <a class="sidebar-link text-muted {{ session('level_menu_1', 'home') == $level_menu_1 ? 'active' : '' }}" href="#" data-bs-target="#{{ $level_menu_1 }}" role="button"
      aria-expanded="{{ session('level_menu_1', 'home') == $level_menu_1 ? 'true' : 'false' }}" data-bs-toggle="collapse">
      <span class="sidebar-link-title">{{ $label }} </span>
    </a>
    <ul class="sidebar-menu list-unstyled collapse {{ session('level_menu_1', 'home') == $level_menu_1 ? 'show' : '' }}" id="{{ $level_menu_1 }}">
      {{ $slot }}
    </ul>
  </li>
@endif
