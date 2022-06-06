@csrf
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="input--name">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="input--name" value="{{ $permission->name ?? old('name') }}" autocomplete="off" required>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="input--groups">{{ __('Group') }}</label>
            <input type="text" name="groups" class="form-control @error('groups') is-invalid @enderror" id="input--groups" value="{{ $permission->groups ?? old('groups') }}" autocomplete="off"
                placeholder="Usuário" required>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="input--description">{{ __('Description') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="input--description" value="{{ $permission->description ?? old('description') }}"
                autocomplete="off" required>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="input--slug">{{ __('Slug') }}</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="input--slug" value="{{ $permission->slug ?? old('slug') }}"
                autocomplete="off">
        </div>
    </div>

    <div class="col-12 col-md-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="true" id="crud" name="crud" checked>
            <label class="form-check-label" for="crud">
                Adicionar Crud
            </label>
        </div>
    </div>
</div>
