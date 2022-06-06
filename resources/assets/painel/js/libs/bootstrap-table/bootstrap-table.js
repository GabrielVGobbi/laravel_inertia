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