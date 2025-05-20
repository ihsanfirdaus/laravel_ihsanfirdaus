@extends('layouts.app2')

@section('title','Rumah Sakit')
    
@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRumahSakitModal">
                Tambah Data
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" id="success-alert" style="display: none;">
                <span id="success-message"></span>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="rumah-sakit-table-body">
                            @foreach ($allRumahSakit as $data)
                                <tr id="rumah-sakit-row-{{ $data->id }}">
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->nomor_telepon }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-rumah-sakit"
                                            data-id="{{ $data->id }}">Lihat</button>
                                        <button class="btn btn-sm btn-warning edit-rumah-sakit"
                                            data-id="{{ $data->id }}">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-rumah-sakit"
                                            data-id="{{ $data->id }}">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Rumah Sakit Modal -->
    <div class="modal fade" id="createRumahSakitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createRumahSakitForm">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" a="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveRumahSakitBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Rumah Sakit Modal -->
    <div class="modal fade" id="viewRumahSakitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9" id="view-nama"></dd>

                        <dt class="col-sm-3">Alamat</dt>
                        <dd class="col-sm-9" id="view-alamat"></dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9" id="view-email"></dd>

                        <dt class="col-sm-3">Nomor Telepon</dt>
                        <dd class="col-sm-9" id="view-nomor-telepon"></dd>

                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Rumah Sakit Modal -->
    <div class="modal fade" id="editRumahSakitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editRumahSakitForm">
                        <input type="hidden" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit-alamat" name="alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="edit-nomor-telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="edit-nomor_telepon" name="nomor-telepon">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="updateRumahSakitBtn">Perbarui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteRumahSakitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                    <input type="hidden" id="delete-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let createModal = new bootstrap.Modal(document.getElementById('createRumahSakitModal'));
            let viewModal = new bootstrap.Modal(document.getElementById('viewRumahSakitModal'));
            let editModal = new bootstrap.Modal(document.getElementById('editRumahSakitModal'));
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteRumahSakitModal'));

            function showSuccessMessage(message) {
                $('#success-message').text(message);
                $('#success-alert').fadeIn().delay(3000).fadeOut();
            }

            $('#saveRumahSakitBtn').click(function() {
                let formData = {
                    nama: $('#nama').val(),
                    alamat: $('#alamat').val(),
                    email: $('#email').val(),
                    nomor_telepon: $('#nomor_telepon').val()
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('rumah-sakit.store') }}",
                    data: formData,
                    success: function(response) {
                        createModal.hide();
                        showSuccessMessage(response.message);

                        let newRow = `<tr id="rumah-sakit-row-${response.data.id}">
                        <td>${response.data.id}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.nomor_telepon}</td>
                        <td>
                            <button class="btn btn-sm btn-info view-rumah-sakit" data-id="${response.data.id}">Lihat</button>
                            <button class="btn btn-sm btn-warning edit-rumah-sakit" data-id="${response.data.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-rumah-sakit" data-id="${response.data.id}">Hapus</button>
                        </td>
                    </tr>`;

                        $('#rumah-sakit-table-body').append(newRow);

                        $('#createRumahSakitForm')[0].reset();
                    },
                    error: function(error) {
                        console.log(error.responseJSON);
                        alert('Terjadi kesalahan saat menyimpan data');
                    }
                });
            });

            $(document).on('click', '.view-rumah-sakit', function() {
                let rumahSakitId = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: `/rumah-sakit/${rumahSakitId}`,
                    success: function(response) {
                        let data = response.data;
                        $('#view-id').text(data.id);
                        $('#view-nama').text(data.nama);
                        $('#view-alamat').text(data.alamat);
                        $('#view-email').text(data.email);
                        $('#view-nomor-telepon').text(data.nomor_telepon);

                        viewModal.show();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });

            $(document).on('click', '.edit-rumah-sakit', function() {
                let rumahSakitId = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: `/rumah-sakit/${rumahSakitId}`,
                    success: function(response) {
                        let data = response.data;
                        $('#edit-id').val(data.id);
                        $('#edit-nama').val(data.nama);
                        $('#edit-alamat').val(data.alamat);
                        $('#edit-email').val(data.email);
                        $('#edit-nomor_telepon').val(data.nomor_telepon);

                        editModal.show();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });

            $('#updateRumahSakitBtn').click(function() {
                let rumahSakitId = $('#edit-id').val();
                let formData = {
                    nama: $('#edit-nama').val(),
                    alamat: $('#edit-alamat').val(),
                    email: $('#edit-email').val(),
                    nomor_telepon: $('#edit-nomor_telepon').val()
                };

                $.ajax({
                    type: 'PUT',
                    url: `/rumah-sakit/${rumahSakitId}`,
                    data: formData,
                    success: function(response) {
                        editModal.hide();
                        showSuccessMessage(response.message);

                        // Update row in table
                        let updatedRow = `
                        <td>${response.data.id}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.nomor_telepon}</td>
                        <td>
                            <button class="btn btn-sm btn-info view-rumah-sakit" data-id="${response.data.id}">Lihat</button>
                            <button class="btn btn-sm btn-warning edit-rumah-sakit" data-id="${response.data.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-rumah-sakit" data-id="${response.data.id}">Hapus</button>
                        </td>
                    `;

                        $(`#rumah-sakit-row-${rumahSakitId}`).html(updatedRow);
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat memperbarui data');
                    }
                });
            });

            $(document).on('click', '.delete-rumah-sakit', function() {
                let rumahSakitId = $(this).data('id');
                $('#delete-id').val(rumahSakitId);
                deleteModal.show();
            });

            // DELETE - Confirm deletion
            $('#confirmDeleteBtn').click(function() {
                let rumahSakitId = $('#delete-id').val();

                $.ajax({
                    type: 'DELETE',
                    url: `/rumah-sakit/${rumahSakitId}`,
                    success: function(response) {
                        deleteModal.hide();
                        showSuccessMessage(response.message);

                        // Remove row from table
                        $(`#rumah-sakit-row-${rumahSakitId}`).remove();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat menghapus data');
                    }
                });
            });
        });
    </script>
@endsection
