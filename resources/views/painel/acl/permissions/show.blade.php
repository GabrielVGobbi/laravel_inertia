@extends("layouts.painel")

@section('title', 'Permissão - ' . ucfirst($permission->name))

@section('content')

    <div class="card">
        <h5 class="card-header">Dados</h5>
        <div class="card-body">
            <form id="form-update-permission" permission="form" autocomplete="off" action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @method('PUT')
                @include('painel._partials.forms.form-permissions')

                <div class="card-footer">
                    <x-button permission="updated-permissions" class="btn-primary js-btn-submit">
                        <i class="fas fa-save"></i>
                        Salvar
                    </x-button>
                    <x-button href="{{ route('permissions.destroy', $permission->id) }}" permission="destroy-permissions" class="btn-outline-danger js-btn-delete">
                        <i class="fas fa-trash"></i>
                        Excluir
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@stop
