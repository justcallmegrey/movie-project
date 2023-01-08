<script type="text/javascript">
    $(document).ready(function () {
        let activeTable = null;

        activeTable = $('#table-members').DataTable({
            processing: true,
            serverSide: true,
            dom: 'C<"clear">lfrtip<"bottom">',
            searching : true,
            scrollX : true,
            scrollCollapse : true,
            dom: "lrtip",
            ajax: {
                url: "{{ route('member.datatable') }}",
                data: function (d) {
                    d.keyword = $('#keyword').val();
                    d.name = $('[name="name"]').val();
                    d.slug = $('[name="slug"]').val();
                    d.sort = $('#sort').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', orderable: false },
                { data: 'name', name: 'name'},
                { data: 'age', name: 'age' },
                { data: 'address', name: 'address' },
                { data: 'telephone', name: 'telephone' },
                { data: 'identity_number', name: 'identity_number' },
                { data: 'date_of_joined', name: 'date_of_joined' },
                { data: 'is_active', name: 'is_active' },
                { data: 'action', name: 'action', searchable: false, orderable: false },
            ],
        });

        $(document).on('click', '#btn-add', function (e) {
            $('#modal-add').modal('show');
        });

        $(document).on('click', '#btn-submit-create', function (e) {
            const form = $('#form-add').serialize();

            $.ajax({
                url: "{{ route('member.store') }}",
                type: 'POST',
                dataType: 'JSON',
                data: form,
                success: (response) => {
                    $('#modal-add').modal('hide');
                    $('#table-members').DataTable().ajax.reload();
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
                    $('#form-edit').find('input[name="member-id"]').val(response.data.id);
                    $('#form-edit').find('input[name="name"]').val(response.data.name);
                    $('#form-edit').find('input[name="age"]').val(response.data.age);
                    $('#form-edit').find('input[name="address"]').val(response.data.address);
                    $('#form-edit').find('input[name="telephone"]').val(response.data.telephone);
                    $('#form-edit').find('input[name="identity_number"]').val(response.data.identity_number);
                    $('#form-edit').find('input[name="date_of_joined"]').val(response.data.date_of_joined);
                    $('#form-edit').find('input[name="status"]').val(response.data.status);
                    $('#modal-edit').modal('show');
                }
            });
        });

        $(document).on('click', '#btn-submit-update', function (e) {
            e.preventDefault();

            const memberId = $('#form-edit').find('input[name="member-id"]').val();
            const formData = $('#form-edit').serialize();

            $.ajax({
                url: "{{ route('member.update', '') }}" + "/" + memberId,
                type: 'PUT',
                dataType: 'JSON',
                data: formData,
                success: (response) => {
                    $('#modal-edit').modal('hide');
                    $('#table-members').DataTable().ajax.reload();
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
                    $('#table-members').DataTable().ajax.reload();
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