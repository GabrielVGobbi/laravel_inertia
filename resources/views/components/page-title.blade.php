@php
/* todoFazer: arrumar o layout linha 10  */
$seg = getNameSegment();
@endphp

<div>
    <div class="d-flex">
        <span class="d-none" style="vertical-align: middle;
            margin-right: 0.5rem;
            font-size: 1.2rem;">
            @if (isset($icon)) <i class="fas fa-{{ $icon }}"></i>@endif
        </span>
        <h3> @yield("title", "") </h3>
    </div>
    <ol class="breadcrumb">
        <a href="{{ route('painel') }}" class="breadcrumb-item">
            <li>{{ __(getNameSegment(1)) }}</li>
        </a>
        <li class="breadcrumb-item active">{{ __($seg) }}</li>
    </ol>
</div>
