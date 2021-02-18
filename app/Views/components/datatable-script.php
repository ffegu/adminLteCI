<script>
var tableUser = $('#table-user').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    order: [[1, 'asc']],
    ajax: {
        url: '<?= route_to('admin/schools/ajaxData') ?>',
        method: 'GET'
    },
    columnDefs: [{
        orderable: false,
        targets: [0,3,5]
    }],
    columns: [{
            'data': null
        },
        {
            'data': 'username'
        },
        {
            'data': 'email'
        },
    ]
});

tableUser.on('draw.dt', function() {
    var PageInfo = $('#table-user').DataTable().page.info();
    tableUser.column(0, {
        page: 'current'
    }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
    });
});

$(document).on('click', '.btn-delete', function(e) {
    Swal.fire({
            title: '<?= lang('boilerplate.global.sweet.title') ?>',
            text: "<?= lang('boilerplate.global.sweet.text') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('boilerplate.global.sweet.confirm_delete') ?>'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: `<?= route_to('admin/user/manage') ?>/${$(this).attr('data-id')}`,
                    method: 'DELETE',
                }).done((data, textStatus, jqXHR) => {
                    Toast.fire({
                        icon: 'success',
                        title: jqXHR.statusText,
                    });
                    tableUser.ajax.reload();
                }).fail((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: error.responseJSON.messages.error,
                    });
                })
            }
        })
});

tableUser.on('order.dt search.dt', () => {
    tableUser.column(0, {
        search: 'applied',
        order: 'applied'
    }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
    });
}).draw();
</script>
