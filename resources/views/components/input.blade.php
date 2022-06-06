<input type="{{ $type ?? 'text' }}"
    class="form-control @error("$value??''") is-invalid @enderror {{ $class ?? '' }}"
    @if(isset($name))
    name="{{ $name ?? '' }}"
    @endif
    {{ isset($required) ? 'required' : '' }}
    @if(isset($id))
    id="{{ $id ?? '' }}"
    @endif
    value="{{ $value ?? '' }}"
    autocomplete="off" placeholder="{{ $placeholder ?? '' }}">
