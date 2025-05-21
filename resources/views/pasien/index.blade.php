@extends('layouts.app2')

@section('title','Pasien')
    
@section('content')
    
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
                                    <label for="filter-nama" class="form-label">Nama Pasien</label>
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
                                    <label for="filter-nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="filter-nomor_telepon" placeholder="Cari ...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="filter-id_rumah_sakit" class="form-label">Rumah Sakit</label>
                                    <select name="filter-id_rumah_sakit" id="filter-id_rumah_sakit" class="form-select">
                                        <option value="">- Pilih -</option>
                                        @foreach ($allRumahSakit as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
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

    <div class="row mb-4">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPasienModal">
                <i class="bi bi-plus"></i> Tambah Data
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
                                <th>Nomor Telepon</th>
                                <th>Rumah Sakit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pasien-table-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Pasien Modal -->
    <div class="modal fade" id="createPasienModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createPasienForm">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon">
                        </div>
                        <div class="mb-3">
                            <label for="id_rumah_sakit" class="form-label">Rumah Sakit</label>
                            <select name="id_rumah_sakit" id="id_rumah_sakit" class="form-select">
                                <option value="">- Pilih -</option>
                                @foreach ($allRumahSakit as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="savePasienBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Pasien Modal -->
    <div class="modal fade" id="viewPasienModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8" id="view-nama"></dd>

                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8" id="view-alamat"></dd>

                        <dt class="col-sm-4">Nomor Telepon</dt>
                        <dd class="col-sm-8" id="view-nomor-telepon"></dd>
                        
                        <dt class="col-sm-4">Rumah Sakit</dt>
                        <dd class="col-sm-8" id="view-rumah_sakit_nama"></dd>

                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Pasien Modal -->
    <div class="modal fade" id="editPasienModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPasienForm">
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
                            <label for="edit-nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="edit-nomor_telepon" name="nomor_telepon">
                        </div>
                        <div class="mb-3">
                            <label for="edit-id_rumah_sakit" class="form-label">Rumah Sakit</label>
                            <select name="id_rumah_sakit" id="edit-id_rumah_sakit" class="form-select">
                                <option value="">- Pilih -</option>
                                @foreach ($allRumahSakit as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="updatePasienBtn">Perbarui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deletePasienModal" tabindex="-1">
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
            let createModal = new bootstrap.Modal(document.getElementById('createPasienModal'));
            let viewModal = new bootstrap.Modal(document.getElementById('viewPasienModal'));
            let editModal = new bootstrap.Modal(document.getElementById('editPasienModal'));
            let deleteModal = new bootstrap.Modal(document.getElementById('deletePasienModal'));

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
                $('#filter-id_rumah_sakit').val('');
                getData();
            });
        
            function getData() {
                let nama = $('#filter-nama').val().toLowerCase();
                let alamat = $('#filter-alamat').val().toLowerCase();
                let nomor_telepon = $('#filter-nomor_telepon').val().toLowerCase();
                let id_rumah_sakit = $('#filter-id_rumah_sakit').val();
                
                $.ajax({
                    type: 'GET',
                    url: "{{ route('pasien.index') }}",
                    data: {
                        nama: nama,
                        alamat: alamat,
                        nomor_telepon: nomor_telepon,
                        id_rumah_sakit: id_rumah_sakit,
                        ajax: true
                    },
                    success: function(response) {
                        $('#pasien-table-body').empty();
                        
                        if (response.data.length === 0) {
                            $('#pasien-table-body').append('<tr><td colspan="5" class="text-center">Tidak ada data yang ditemukan</td></tr>');
                            return;
                        }
                        
                        $.each(response.data, function(index, rumahSakit) {
                            let row = `<tr id="pasien-row-${rumahSakit.id}">
                                <td>${rumahSakit.id}</td>
                                <td>${rumahSakit.nama}</td>
                                <td>${rumahSakit.alamat}</td>
                                <td>${rumahSakit.nomor_telepon}</td>
                                <td>${rumahSakit.rumah_sakit_nama}</td>
                                <td>
                                    <button class="btn btn-sm btn-info view-pasien" data-id="${rumahSakit.id}">Lihat</button>
                                    <button class="btn btn-sm btn-warning edit-pasien" data-id="${rumahSakit.id}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-pasien" data-id="${rumahSakit.id}">Hapus</button>
                                </td>
                            </tr>`;
                            
                            $('#pasien-table-body').append(row);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            }

            $('#savePasienBtn').click(function() {
                let formData = {
                    nama: $('#nama').val(),
                    alamat: $('#alamat').val(),
                    nomor_telepon: $('#nomor_telepon').val(),
                    id_rumah_sakit: $('#id_rumah_sakit').val()
                };

                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('pasien.store') }}",
                    data: formData,
                    success: function(response) {
                        createModal.hide();
                        showSuccessMessage(response.message);

                        let newRow = `<tr id="pasien-row-${response.data.id}">
                        <td>${response.data.id}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.nomor_telepon}</td>
                        <td>${response.data.rumah_sakit_nama}</td>
                        <td>
                            <button class="btn btn-sm btn-info view-pasien" data-id="${response.data.id}">Lihat</button>
                            <button class="btn btn-sm btn-warning edit-pasien" data-id="${response.data.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-pasien" data-id="${response.data.id}">Hapus</button>
                        </td>
                    </tr>`;

                        $('#pasien-table-body').append(newRow);

                        $('#createPasienForm')[0].reset();
                    },
                    error: function(error) {
                        console.log(error.responseJSON);
                        alert('Terjadi kesalahan saat menyimpan data');
                    }
                });
            });

            $(document).on('click', '.view-pasien', function() {
                let pasienId = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: `/pasien/${pasienId}`,
                    success: function(response) {
                        let data = response.data;
                        $('#view-id').text(data.id);
                        $('#view-nama').text(data.nama);
                        $('#view-alamat').text(data.alamat);
                        $('#view-nomor-telepon').text(data.nomor_telepon);
                        $('#view-rumah_sakit_nama').text(data.rumah_sakit_nama);

                        viewModal.show();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });

            $(document).on('click', '.edit-pasien', function() {
                let pasienId = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: `/pasien/${pasienId}`,
                    success: function(response) {
                        let data = response.data;
                        $('#edit-id').val(data.id);
                        $('#edit-nama').val(data.nama);
                        $('#edit-alamat').val(data.alamat);
                        $('#edit-nomor_telepon').val(data.nomor_telepon);
                        $('#edit-id_rumah_sakit').val(data.id_rumah_sakit);

                        editModal.show();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });

            $('#updatePasienBtn').click(function() {
                let pasienId = $('#edit-id').val();
                let formData = {
                    nama: $('#edit-nama').val(),
                    alamat: $('#edit-alamat').val(),
                    nomor_telepon: $('#edit-nomor_telepon').val(),
                    id_rumah_sakit: $('#edit-id_rumah_sakit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: `/pasien/${pasienId}`,
                    data: formData,
                    success: function(response) {
                        editModal.hide();
                        showSuccessMessage(response.message);

                        let updatedRow = `
                        <td>${response.data.id}</td>
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.nomor_telepon}</td>
                        <td>${response.data.rumah_sakit_nama}</td>
                        <td>
                            <button class="btn btn-sm btn-info view-pasien" data-id="${response.data.id}">Lihat</button>
                            <button class="btn btn-sm btn-warning edit-pasien" data-id="${response.data.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-pasien" data-id="${response.data.id}">Hapus</button>
                        </td>
                    `;

                        $(`#pasien-row-${pasienId}`).html(updatedRow);
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat memperbarui data');
                    }
                });
            });

            $(document).on('click', '.delete-pasien', function() {
                let pasienId = $(this).data('id');
                $('#delete-id').val(pasienId);
                deleteModal.show();
            });

            $('#confirmDeleteBtn').click(function() {
                let pasienId = $('#delete-id').val();

                $.ajax({
                    type: 'DELETE',
                    url: `/pasien/${pasienId}`,
                    success: function(response) {
                        deleteModal.hide();
                        showSuccessMessage(response.message);

                        $(`#pasien-row-${pasienId}`).remove();
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
