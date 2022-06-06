@extends('layouts.painel')

@section('title', __('Permissions'))

@section('content')
    <div class="row">
        <div class="d-flex justify-content-between">
            <div class="page-button-box">
                <button type="button" data-bs-target="#modal-add-permissions" data-bs-toggle="modal" class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i>
                    Adicionar Permissão
                </button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="div-table-api">
                        <div class="table-responsive d-none">
                            <table data-toggle="table" id="table-api" data-table="permissions">
                                <thead class="thead-light">
                                    <tr>
                                        <th data-field="id" data-width="10%" data-width-unit="%" data-sortable="true" data-visible="false">#</th>
                                        <th data-field="name" data-sortable="true">Nome</th>
                                        <th data-field="description">Descrição</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('painel._partials.modals.modal-add', ['redirect' => 'permissions.index', 'type' => 'permissions'])

@endsection

@section('scripts')@append
