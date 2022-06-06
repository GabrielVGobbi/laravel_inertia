@csrf
<input type="hidden" id="role_id" value="{{ $role->id ?? '' }}" />

<div class="row">
    <div class='form-group'>
        <label for='name'>Nome</label>
        <input type='text' class='form-control @error(' name') is-invalid @enderror' name='name' id='input--name' value='{{ $role->name ?? old('name') }}' autocomplete='off' placeholder=''
            required {{ isset($role) ? 'readonly' : '' }}>
    </div>
</div>

<div class="row">
    @if (isset($permissionsGroup) && count($permissionsGroup) > 0)
        @foreach ($permissionsGroup as $group => $permissions)
            <div class="col-md-4 my-3">
                <h3 class="mb-2"> {{ $group }} </h3>
                @foreach ($permissions as $permission)
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" name="permissions[]" {{ in_array($permission['name'], $rolePermissions) ? 'checked' : '' }} class="custom-control-input checkbok-roles"
                                id="customCheck{{ $permission['id'] }}" value="{{ $permission['id'] }}">
                            <label class="custom-control-label" for="customCheck{{ $permission['id'] }}">{{ $permission['name'] }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
