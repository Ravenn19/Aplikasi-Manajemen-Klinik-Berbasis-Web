<?php include '../includes/header2.php'; ?>
<?php include '../config/database.php'; ?>


<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Data Pasien</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
        <i class="bi bi-plus-lg me-1"></i>Tambah Pasien
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" id="searchInput" placeholder="Cari pasien...">
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover" id="pasienTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM Pasien ORDER BY nama ASC";
                    $result = $conn->query($query);
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        $birthDate = new DateTime($row['tgl_lahir']);
                        $today = new DateTime();
                        $age = $today->diff($birthDate)->y;
                        
                        echo "<tr>
                            <td>$no</td>
                            <td>$row[nik]</td>
                            <td>$row[nama]</td>
                            <td>$age tahun</td>
                            <td>$row[gender]</td>
                            <td>" . substr($row['alamat'], 0, 20) . "...</td>
                            <td>$row[no_telp]</td>
                            <td>
                                <button class='btn btn-sm btn-warning edit-pasien' data-id='$row[id_pasien]'>
                                    <i class='bi bi-pencil-square'></i>
                                </button>
                                <button class='btn btn-sm btn-danger hapus-pasien' data-id='$row[id_pasien]'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Pasien Modal -->
<div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPasienModalLabel">Tambah Pasien Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahPasien" action="../proses/crud_pasien.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="laki" value="Laki-laki" checked>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Pasien Modal -->
<div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="editPasienModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasienModalLabel">Edit Data Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditPasien" action="../proses/crud_pasien.php" method="POST">
                <input type="hidden" id="edit_id" name="id_pasien">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="edit_nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit_tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="edit_laki" value="Laki-laki">
                                <label class="form-check-label" for="edit_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="edit_perempuan" value="Perempuan">
                                <label class="form-check-label" for="edit_perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="edit_no_telp" name="no_telp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Pastikan semua ID di modal edit unik -->
<div class="modal fade" id="editPasienModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditPasien" action="../proses/crud_pasien.php" method="POST">
                <input type="hidden" id="edit_id_pasien" name="id_pasien">
                <div class="modal-body">
                    <!-- Konten form edit -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Fungsi untuk memuat ulang event handlers
        function reloadEventHandlers() {
            // Hapus event handler sebelumnya untuk menghindari duplikasi
            $('.edit-pasien').off('click');
            $('.hapus-pasien').off('click');
            
            // Edit button click
            $('.edit-pasien').on('click', function() {
                var id = $(this).data('id');
                console.log('Edit clicked for ID:', id); // Debugging
                
                $.ajax({
                    url: '../proses/get_pasien.php',
                    type: 'POST',
                    data: {id: id},
                    dataType: 'json',
                    success: function(response) {
                        console.log('Response:', response); // Debugging
                        if(response && response.success) {
                            $('#edit_id').val(response.data.id_pasien);
                            $('#edit_nik').val(response.data.nik);
                            $('#edit_nama').val(response.data.nama);
                            $('#edit_tgl_lahir').val(response.data.tgl_lahir);
                            $('input[name="gender"][value="' + response.data.gender + '"]').prop('checked', true);
                            $('#edit_alamat').val(response.data.alamat);
                            $('#edit_no_telp').val(response.data.no_telp);
                            
                            $('#editPasienModal').modal('show');
                        } else {
                            alert('Gagal memuat data: ' + (response.message || 'Response tidak valid'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        alert('Terjadi kesalahan saat memuat data pasien');
                    }
                });
            });
            
            // Delete button click
            $('.hapus-pasien').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log('Delete clicked for ID:', id); // Debugging
                
                if(confirm('Apakah Anda yakin ingin menghapus pasien ini?')) {
                    window.location.href = '../proses/crud_pasien.php?hapus=' + id;
                }
            });
        }
        
        // Panggil pertama kali
        reloadEventHandlers();
        
        // Search functionality
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pasienTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            
            // Reload event handlers setelah pencarian
            reloadEventHandlers();
        });
    });
</script>


<?php include '../includes/footer.php'; ?>