@extends('layouts.painel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cache</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="form-cache_clear" role="form" class="needs-validation" action="{{ route('clear.cache') }}" method="POST">
                            @csrf
                            @method('put')
                            <button class="btn btn-outline-primary btn-submit">Limpar Cache</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">Maintenance Mode</div>

                    @if (!$maintenance)
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle='modal' data-bs-target='#maintenance-modal'>Maintenance Mode</button>
                        </div>
                    @else
                        <div class="card-body">
                            <form id='form-maintenance-desactive' role='form' class='needs-validation' action='{{ route('maintenance.mode', ['maintenance' => false]) }}' method='POST'>
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-outline-primary js-btn-submit">Desativar Maintenance Mode</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class='modal' id='maintenance-modal' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <form id='form-maintenance' role='form' class='needs-validation' action='{{ route('maintenance.mode') }}' method='POST'>
                    @csrf
                    @method('put')
                    <input type="hidden" name="maintenance_code" value="332bf2d5-2b8e-4635-a10a-01f663888e05">
                    <div class='modal-header'>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class='modal-body'>
                        <h3 class="">Copie o Código</h3>
                        <code class="copy">332bf2d5-2b8e-4635-a10a-01f663888e05</code>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary js-btn-submit'>Colocar em Manutenção</button>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')@append
