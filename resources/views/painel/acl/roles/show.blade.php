@extends("layouts.painel")

@section('title', 'Editar Função')

@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            <div class="align-self-center">
                <h5>Funções do {{ $role->name ?? '' }}</h5>
            </div>
            <div class="d-flex">
                <a href="javascript:void(0)" data-rel="all" class="js-select"> Selecionar tudo </a>
                <div class="text-center mx-3"> <i class="fas fa-chevron-right"></i> </div>
                <a href="javascript:void(0)" data-rel="empty" class="tx-light js-select"> Limpar tudo </a>
            </div>
        </div>
        <div class="card-body">
            <form id="form-update-role" role="form" autocomplete="off" action="{{ route('roles.update', $role->id) }}" method="POST">
                @method('PUT')
                @include('painel._partials.forms.form-roles')

                <x-button permission="updated-roles" class="btn-primary js-btn-submit">
                    <i class="fas fa-save"></i>
                    Salvar
                </x-button>
                <x-button href="{{ route('roles.destroy', $role->id) }}" permission="destroy-roles" class="btn-outline-danger js-btn-delete">
                    <i class="fas fa-trash"></i>
                    Excluir Função
                </x-button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.js-select').forEach(item => {
            item.addEventListener('click', selected);
        });

        function selected(e) {
            const t = e.target.getAttribute('data-rel')
            document.querySelectorAll('.checkbok-roles').forEach(item => {
                t == 'all' ? item.checked = true : item.checked = false;
            });
        }
    </script>
@append
