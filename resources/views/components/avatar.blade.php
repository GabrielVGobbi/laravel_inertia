<!-- xs sm md lg xl -->
@php
$name = !empty($name) ? title_case($name) : auth()->user()->name;
$name = substr(mb_strtoupper($name, 'UTF-8'), 0, 2);
$size = $size ?? 'sm';
$class = $class ?? 'avatar-' . $size;
$tx = $size == 'lg' ? 'tx-20' : '';
@endphp

@if (!empty($avatar))
    <img src="{{ asset('storage/' . $avatar) }}" alt="" class="rounded-circle avatar-{{ $size ?? 'lg' }}" width={{ $width ?? '' }}>
@else
    <div class="{{ $class }} font-weight-bold d-inline-block">
        <span class="avatar-title rounded-circle bg-soft-purple {{ $tx }}">
            {{ $name }}
        </span>
    </div>
@endif
