<div class="modal" id="modal-add-{{ $type }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered {{ isset($modalSize) ? $modalSize : null }}" role="document">
        <div class="modal-content">
            <form id="form-add-{{ $type }}" autocomplete="off" role="form" class="needs-validation" action="{{ route("$type.store", ['redirect' => $redirect]) }}" method="POST">
                <input type="hidden" name="redirect" value="{{ $redirect ?? null }}">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar novo(a) {{ __trans($type) }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @include("painel._partials.forms.form-$type")
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary js-btn-submit"> <i class="fas fa-edit"></i> Adicionar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')

    @if ($errors->any())
        <script>
            window.addEventListener('load', () => {
                $("#modal-add-{{ $type }}").modal('show')
            })
        </script>
    @endif

    <script>
        window.addEventListener('load', () => {
            let modal = $('#modal-add-{{ $type }}')

            modal.on("show.bs.modal", function() {
                modal.find('.select2').each(function() {
                    let multiple = $(this).attr('multiple') ? true : false;
                    let close = multiple ? false : true;
                    $(this).select2({
                        dropdownParent: $('#modal-add-{{ $type }} .modal-content'),
                        width: '100%',
                        closeOnSelect: close,
                    })
                })
            })

            modal.on("hidden.bs.modal", function() {
                $("#form-add-{{ $type }}")[0].reset();
                modal.find('input').removeClass('is-invalid');
            })

        })
    </script>
@append
