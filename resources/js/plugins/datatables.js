/* global DataTable */

/**
 * Initialize all elements with .yajra-datatable.
 *
 * Each table needs:
 *   data-ajax-url:       URL to fetch from (Yajra server-side endpoint)
 *   data-columns:        JSON array of {data, name, orderable, searchable}
 *   data-order-col:      default order column index (optional)
 *   data-order-dir:      default order direction (optional)
 */
export function initServerDataTables(root = document) {
    if (!window.jQuery || !window.jQuery.fn.dataTable) {
        return;
    }
    const $ = window.jQuery;

    $(root).find('table.yajra-datatable:not(.dt-init)').each(function () {
        const $el = $(this);
        const ajaxUrl = $el.data('ajax-url');
        const columns = $el.data('columns') || [];
        const orderCol = $el.data('order-col') ?? 0;
        const orderDir = $el.data('order-dir') || 'desc';
        const lang = document.documentElement.getAttribute('lang') || 'en';

        const dictKm = {
            sProcessing: 'កំពុង​ដំណើរការ...',
            sLengthMenu: 'បង្ហាញ _MENU_ កំណត់ត្រា',
            sZeroRecords: 'មិន​មាន​កំណត់ត្រា​ត្រូវ​នឹង​ការ​ស្វែងរក',
            sInfo: 'បង្ហាញ _START_ ដល់ _END_ នៃ _TOTAL_ កំណត់ត្រា',
            sInfoEmpty: 'បង្ហាញ 0 ដល់ 0 នៃ 0 កំណត់ត្រា',
            sInfoFiltered: '(បាន​ត្រង​ចេញ​ពី _MAX_ កំណត់ត្រា​ទាំងអស់)',
            sSearch: 'ស្វែងរក៖',
            sEmptyTable: 'មិន​មាន​ទិន្នន័យ',
            oPaginate: {
                sFirst: '«',
                sPrevious: '‹',
                sNext: '›',
                sLast: '»',
            },
        };

        $el.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: ajaxUrl,
                data: (params) => {
                    const csrf = document.head.querySelector('meta[name="csrf-token"]');
                    if (csrf) params._token = csrf.content;
                    return params;
                },
            },
            columns: columns,
            order: [[orderCol, orderDir]],
            pagingType: 'full_numbers',
            dom:
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            language: lang === 'km' ? dictKm : undefined,
            drawCallback() {
                // Bootstrap 5 pagination styling
                $('.dataTables_paginate > .pagination').addClass('pagination-sm');
            },
        });

        $el.addClass('dt-init');
    });
}

window.initServerDataTables = initServerDataTables;
