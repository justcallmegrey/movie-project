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
                { data: 'action', name: 'action', searchable: false, orderable: false },
            ],
        });

        $(document).on('click', '#btn-add', function (e) {
            $('#modal-add').modal('show');
        });

        $(document).on('click', '#btn-submit-create', function (e) {
            const form = $('#form-add').serialize();

            $.ajax({
                url: "{{ route('movie.store') }}",
                type: 'POST',
                dataType: 'JSON',
                data: form,
                success: (response) => {
                    $('#modal-add').modal('hide');
                    $('#table-movies').DataTable().ajax.reload();
                    alert('DATA BERHASIL DISIMPAN');
                },
                error: (error) => {
                    const res = error?.responseJSON;
                    alert('DATA GAGAL DISIMPAN');
                },
            });
        });

        $(document).on('click', '.btn-modal-edit', function (e) {
            e.preventDefault();

            const href = $(this).data('href');

            $.ajax({
                url: href,
                type: 'GET',
                dataType: 'JSON',
                success: (response) => {
                    $('#form-edit').find('input[name="movie-id"]').val(response.data.id);
                    $('#form-edit').find('input[name="title"]').val(response.data.title);
                    $('#form-edit').find('input[name="genre"]').val(response.data.genre);
                    $('#form-edit').find('input[name="released_date"]').val(response.data.released_date);
                    $('#modal-edit').modal('show');
                }
            });
        });

        $(document).on('click', '#btn-submit-update', function (e) {
            e.preventDefault();

            const movieId = $('#form-edit').find('input[name="movie-id"]').val();
            const formData = $('#form-edit').serialize();

            $.ajax({
                url: "{{ route('movie.update', '') }}" + "/" + movieId,
                type: 'PUT',
                dataType: 'JSON',
                data: formData,
                success: (response) => {
                    $('#modal-edit').modal('hide');
                    $('#table-movies').DataTable().ajax.reload();
                    alert('DATA BERHASIL DIUBAH');
                },
                error: (error) => {
                    const res = error?.responseJSON;
                    alert('DATA GAGAL DIUBAH');
                }
            });
        });

        $(document).on('click', '.btn-modal-delete', function (e) {
            e.preventDefault();

            const deleteUrl = $(this).attr('data-href');

            $('#btn-submit-delete').attr('data-href', deleteUrl);
            $('#modal-delete').modal('show');
        });

        $(document).on('click', '#btn-submit-delete', function (e) {
            e.preventDefault();

            const deleteUrl = $(this).attr('data-href');

            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data : { _token: "{{ csrf_token() }}" },
                success: (response) => {
                    $('#modal-delete').modal('hide');
                    $('#table-movies').DataTable().ajax.reload();
                    alert('DATA BERHASIL DIHAPUS');
                },
                error: (error) => {
                    const res = error?.responseJSON;
                    alert('DATA GAGAL DIHAPUS');
                }
            });
        });







        



    });
</script>