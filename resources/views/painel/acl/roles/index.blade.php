@extends("layouts.painel")

@section('title', 'Funções')

@section('content')
    <div class="d-flex justify-content-between">

        <div class="page-button-box">
            <button type="button" data-bs-target="#modal-add-roles" data-bs-toggle="modal" class="btn btn-outline-primary">
                <i class="fas fa-plus"></i>
                Adicionar Função
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if (!empty($roles))
                <div class="table-responsive">
                    <table class="table table-normal table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Nome</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $_role)
                                <tr>
                                    <th>{{ $_role->name }}</th>
                                    <th>
                                        <a href="{{ route('roles.show', $_role->id) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i> </a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="table-empty_rows">
                    <img src="{{ asset('images/svg/empty.svg') }}" width="10%">
                    <h6>Nenhuma Função encontrada</h6>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center">
            <ul class="pagination pagination-rounded mb-sm-0">
                {!! $roles->links() !!}
            </ul>
        </div>
    </div>

    @include('painel._partials.modals.modal-add', ['redirect' => 'roles.index', 'type' => 'roles'])

@stop
