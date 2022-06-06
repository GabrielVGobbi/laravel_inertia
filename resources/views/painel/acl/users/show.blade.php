@extends("layouts.painel")

@section('title', 'Usuário - ' . ucfirst($user->name))

@section('content')

    <div class="card">
        <h5 class="card-header">Dados</h5>
        <div class="card-body">
            <form id="form-update-user" role="form" class="needs-validation" action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ $user->id ?? old('id') }}">
                <div class="row">

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="input--name">Nome</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="input--name" value="{{ $user->name ?? old('name') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="input--email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="input--email" value="{{ $user->email ?? old('email') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="input--telephone">Telefone</label>
                            <input type="text" name="telephone" class="sp_celphones form-control @error('telephone') is-invalid @enderror" id="input--telephone"
                                value="{{ $user->telephone ?? old('telephone') }}"
                                autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="input--type">Tipo de Usuário</label>
                            <select class="select2 form-control" required multiple id="input--type_usuario" name="roles[]"
                                {{ auth()->user()->hasRole('dev')? '': 'disabled' }}>
                                @foreach ($roles as $role)
                                    <option {{ isset($roles_user) && in_array($role['name'], $roles_user) ? 'selected' : '' }} value="{{ $role['id'] }}">{{ $role['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="buttons mt-3">
                    <x-button href="{{ route('users.update', $user->id) }}" class="btn-primary js-btn-submit" permission='updated-users'>
                        <i class="fas fa-save"></i>
                        Salvar
                    </x-button>
                    <x-button href="{{ route('users.destroy', $user->id) }}" class="btn-outline-danger js-btn-delete" icon="trash" permission='destroy-users'>
                        <i class="fas fa-save"></i>
                        Excluir
                    </x-button>
                </div>

            </form>
        </div>
    </div>
@stop
