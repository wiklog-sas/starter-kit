@props([
    'label' => null,
    'icon' => null,
    'link' => '#',
    'nb' => 0,
])
<div class="col-12 col-md-3 mt-3">
  @if (!in_array($link, ['', '#']))
    <a href="{{ $link }}">
  @endif
  <div class="card">
    <div class="card-header">
      <h4>{{ $label }}</h4>
    </div>
    <div class="card-body">
      <div class="card-title">
        <div class="d-flex justify-content-between fs-1 text-primary">
          <div class="ms-3">
            <i class="{{ $icon }} fa-xl"></i>
          </div>
          <div class="me-3">
            ×{{ $nb }}
          </div>
        </div>
      </div>
    </div>
  </div>
  @if (!in_array($link, ['', '#']))
    </a>
  @endif
</div>
