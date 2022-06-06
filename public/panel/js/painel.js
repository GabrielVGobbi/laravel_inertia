(function () {

    "use strict";

    /**
     * Easy selector helper function
     */
    window.select = (el, all = false) => {
        if (el) {
            el = el.trim()
            if (all) {
                return [...document.querySelectorAll(el)]
            } else {
                return document.querySelector(el)
            }
        }
    }

    /**
   * Easy event listener function
   */
    window.on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    window.preload = () => {
        let preload = `<div class="text-center" id="preloader-content">`;
        preload += `    <div class="spinner-border text-primary m-1 align-self-center" role="status">`;
        preload += `        <span class="sr-only"></span>`;
        preload += `    </div>`;
        preload += `</div>`;
        return preload;
    }

    window.axiosErr = (err) => {
        toastr.error(err);
    }

    /**
    * Form Submit Function
    */
    on('click', '.js-btn-submit', function (e) {
        let isValid = true;
        let form = this.closest("form");
        let text = this.getAttribute("data-text") ?? 'Salvando...';
        let textBack = this.innerHTML;

        this.innerHTML = `<i class='fa fa-spinner fa-spin'></i> ${text}`;
        this.disabled = true;

        form.elements.forEach(function (value) {
            value.classList.remove('is-invalid')
            if (value.value === '' && value.hasAttribute('required')) {
                value.classList.add('is-invalid')
                isValid = false;
            }
            value.addEventListener('keyup', (e) => {
                if (e.value != '') {
                    value.classList.remove('is-invalid')
                }
            });
        });

        if (isValid) {
            form.submit()
        } else {
            this.innerHTML = textBack;
            this.disabled = false;
        }

    }, true)

    /**
   * Btn DELETE Confirm
   */
    on('click', '.js-btn-delete', function (e) {

        const token = document.querySelector('meta[name="csrf-token"]').content;
        const action = this.getAttribute('data-href');
        const type = this.getAttribute('data-type') ?? 'delete';
        const text = this.getAttribute('data-text') ?? 'Deletar';

        let htmlModal = `
        <div class="modal fade effect-scale" id="modal-confirm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mg-b-0 modal-text-body"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal-cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="form-delete" role="form" class="needs-validation" action="${action}" method="POST">
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" id="modal-confirm" data-btn-text="Deletando" class="btn btn-danger
                                    btn-submit modal-btn-danger">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', htmlModal);

        const modal = $("#modal-confirm")

        modal.find('.modal-title').html(`${text}`);
        modal.find('.btn-danger').html(`<i class="fas fa-exclamation-circle"></i> ${text}`);
        modal.find('.modal-text-body').html(`Tem certeza que deseja ${text}?`);
        modal.modal('show');

        modal.on('hidden.bs.modal', function () {
            modal.remove();
        })

    }, true)


    const initSelect2 = () => {

        $('.select2').each(function () {
            let multiple = $(this).attr('multiple') ? true : false;
            let close = multiple ? false : true;
            $(this).select2({
                width: '100%',
                closeOnSelect: close,
            })
        })

        $('select').on('select2:open', (event) => {
            if (!event.target.multiple) {
                document.querySelector('.select2-search__field').focus();
            }
        });

        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
            $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        });

        // steal focus during close - only capture once and stop propogation
        $('select.select2').on('select2:closing', function (e) {
            $(e.target).data("select2").$selection.one('focus focusin', function (e) {
                e.stopPropagation();
            });
        });
    }

    initSelect2();

})();

"use strict";

window.initTable = () => {
    var table = $('#table-api');
    var dataTable = table.attr('data-table');
    var order = table.attr('order');
    var filter = {};

    $('#preloader-content').remove();

    $('.div-table-api').append(preload());

    $.each($('.search-input'), function () {
        if ($(this).attr('name') != undefined) {
            let id = $(this).attr('id')
            let value = JSON.parse(localStorage.getItem(id));
            filter[$(this).attr('name')] = value ?? $(this).val();
        }
    });

    if (table.length > 0) {
        var paginate = table.attr('data-paginate') != undefined ? false : true;
        var eExport = table.attr('data-export') != undefined ? false : true;
        var showColumns = table.attr('data-collums') != undefined ? false : true;
        var click = table.attr('data-click');

        table.bootstrapTable();

        table.bootstrapTable('refreshOptions', {
            locale: 'pt-BR',
            method: 'get',
            url: `${base_url}/panel/tables/${dataTable}`,
            dataType: 'json',
            classes: 'table table-hover table-striped',
            pageList: "[10, 25, 50, 100]",
            cookie: true,
            cache: true,
            search: true,
            showExport: eExport,
            showColumns: showColumns,
            idField: 'id',
            toolbar: '#toolbar',
            buttonsClass: 'dark',
            showColumnsToggleAll: true,
            pageSize: 20,
            cookieIdTable: dataTable,
            queryParamsType: 'all',
            striped: true,
            pagination: paginate,
            sidePagination: "server",
            pageNumber: 1,
            queryParams: function (p) {
                return {
                    sort: p.sortName ?? order,
                    order: p.sortOrder,
                    search: p.searchText,
                    page: p.pageNumber,
                    pageSize: paginate ? p.pageSize : 'all',
                    filter: filter ?? {}
                };
            },
            responseHandler: function (res) {
                return {
                    total: res.meta ? res.meta.total : null,
                    rows: res.data
                };
            },
            onClickCell: function (field, value, row, $element) {
                if (click == 'false') {
                    return;
                }
                if (field != 'statusButton') {
                    window.location.href = `${i_url}/${row.id}`
                }
            },
            onLoadSuccess: function () {
                $('#preloader-content').remove();
                $('.table-responsive').removeClass('d-none');
            },
        });
    }
}

initTable();