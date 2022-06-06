{{-- /**
    * Classe
    * Rota
    * Permissão
    */ --}}

@php
$permission = $permission ?? false;
$hasPermission = $permission
    ? auth()
        ->user()
        ->hasRole('dev')
    : (auth()
        ->user()
        ->can($permission)
        ? true
        : false);

@endphp

@if ($hasPermission)
    <button
        class="btn {{ $class ?? '' }}"
        {{ isset($href) ? "data-href=$href" : '' }}
        type="button"
        @if (isset($tooltip)) data-bs-tooltip='tooltip' data-bs-placement='top' title='{{ $tooltip }}' @endif
        @if (isset($modal)) data-bs-toggle="modal" data-bs-target="{{ $modal }}" @endif>
        {{ $slot }}
    </button>
@endif
