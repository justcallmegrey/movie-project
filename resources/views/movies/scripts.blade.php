<script type="text/javascript">
    $(document).ready(function () {
        let activeTable = null;

        activeTable = $('#table-movies').DataTable({
            processing: true,
            serverSide: true,
            dom: 'C<"clear">lfrtip<"bottom">',
            searching : true,
            scrollX : true,
            scrollCollapse : true,
            dom: "lrtip",
            ajax: {
                url: "{{ route('movie.datatable') }}",
                data: function (d) {
                    d.keyword = $('#keyword').val();
                    d.name = $('[name="name"]').val();
                    d.slug = $('[name="slug"]').val();
                    d.sort = $('#sort').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', orderable: false },
                { data: 'title', name: 'title'},
                { data: 'genre', name: 'genre' },
                { data: 'is_rented', name: 'is_rented' },
                { data: 'released_date', name: 'released_date' },
                // { data: 'action', name: 'action', searchable: false, orderable: false },
            ],
        });

        $(document).on('click', '#btn-add', function (e) {
            $('#modal-add').modal('show');
        });

        $(document).on('click', '#btn-submit-create', function (e) {
            const formData = new FormData($('#form-add')[0]);

            $.ajax({
                url: "{{ route('movie.store') }}",
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#modal-add').modal('hide');
                    $('#table-movies').DataTable().ajax.reload();
                    alert('DATA BERHASIL DISIMPAN');
                },
                error: (data) => {
                    const res = data?.responseJSON;
                    alert('DATA GAGAL DISIMPAN');
                },
            });
        });

    });
</script>