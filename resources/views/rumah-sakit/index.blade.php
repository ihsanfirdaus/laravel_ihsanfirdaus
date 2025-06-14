@extends('layouts.app2')

@section('title','Rumah Sakit')
    
@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRumahSakitModal">
                <i class="bi bi-plus"></i> Tambah Data
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-filter"></i> Filter</h5>
                </div>
                <div class="card-body">
                    <form id="filterForm">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="filter-nama" class="form-label">Nama Rumah Sakit</label>
                                    <input type="text" class="form-control" id="filter-nama" placeholder="Cari ...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="filter-alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="filter-alamat" placeholder="Cari ...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="filter-email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="filter-email" placeholder="Cari ...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="filter-nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="filter-nomor_telepon" placeholder="Cari ...">
                                </div>
                            </div>
                        </div>
                        <div class="text-start">
                            <button type="button" class="btn btn-secondary" id="resetFilterBtn">Reset</button>
                            <button type="button" class="btn btn-primary" id="applyFilterBtn">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
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
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8" id="view-nama"></dd>

                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8" id="view-alamat"></dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8" id="view-email"></dd>

                        <dt class="col-sm-4">Nomor Telepon</dt>
                        <dd class="col-sm-8" id="view-nomor_telepon"></dd>

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
                            <label for="edit-nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="edit-nomor_telepon" name="nomor_telepon">
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
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
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
            let createModal = new bootstrap.Modal(document.getElementById('createRumahSakitModal'));
            let viewModal = new bootstrap.Modal(document.getElementById('viewRumahSakitModal'));
            let editModal = new bootstrap.Modal(document.getElementById('editRumahSakitModal'));
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteRumahSakitModal'));

            function showSuccessMessage(message) {
                $('#success-message').text(message);
                $('#success-alert').fadeIn().delay(3000).fadeOut();
            }

            getData();

            $('#applyFilterBtn').click(function() {
                getData();
            });
            
            $('#resetFilterBtn').click(function() {
                $('#filter-nama').val('');
                $('#filter-alamat').val('');
                $('#filter-email').val('');
                $('#filter-nomor_telepon').val('');
                getData();
            });
        
            function getData() {
                let nama = $('#filter-nama').val().toLowerCase();
                let alamat = $('#filter-alamat').val().toLowerCase();
                let email = $('#filter-email').val().toLowerCase();
                let nomor_telepon = $('#filter-nomor_telepon').val().toLowerCase();
                
                $.ajax({
                    type: 'GET',
                    url: "{{ route('rumah-sakit.index') }}",
                    data: {
                        nama: nama,
                        alamat: alamat,
                        email: email,
                        nomor_telepon: nomor_telepon,
                        ajax: true
                    },
                    success: function(response) {
                        $('#rumah-sakit-table-body').empty();
                        
                        if (response.data.length === 0) {
                            $('#rumah-sakit-table-body').append('<tr><td colspan="5" class="text-center">Tidak ada data yang ditemukan</td></tr>');
                            return;
                        }
                        
                        $.each(response.data, function(index, rumahSakit) {
                            let row = `<tr id="rumah-sakit-row-${rumahSakit.id}">
                                <td>${rumahSakit.id}</td>
                                <td>${rumahSakit.nama}</td>
                                <td>${rumahSakit.alamat}</td>
                                <td>${rumahSakit.email}</td>
                                <td>${rumahSakit.nomor_telepon}</td>
                                <td>
                                    <button class="btn btn-sm btn-info view-rumah-sakit" data-id="${rumahSakit.id}">Lihat</button>
                                    <button class="btn btn-sm btn-warning edit-rumah-sakit" data-id="${rumahSakit.id}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-rumah-sakit" data-id="${rumahSakit.id}">Hapus</button>
                                </td>
                            </tr>`;
                            
                            $('#rumah-sakit-table-body').append(row);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
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
                        $('#view-nomor_telepon').text(data.nomor_telepon);

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

            $('#confirmDeleteBtn').click(function() {
                let rumahSakitId = $('#delete-id').val();

                $.ajax({
                    type: 'DELETE',
                    url: `/rumah-sakit/${rumahSakitId}`,
                    success: function(response) {
                        deleteModal.hide();
                        showSuccessMessage(response.message);

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
