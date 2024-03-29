@props([
    'level_menu_2' => 'home',
    'label' => '',
    'link' => '#',
])

<li class="sidebar-list-item">
  <a class="sidebar-link text-muted {{ session('level_menu_2', 'home') == $level_menu_2 ? 'active' : '' }}" href="{{ $link }}">
    {{ $label }}
  </a>
</li>
