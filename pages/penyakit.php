<?php include '../includes/header2.php'; ?>
<?php include '../config/database.php'; ?>



<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Master Data Penyakit</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPenyakitModal">
        <i class="bi bi-plus-lg me-1"></i> Tambah Penyakit
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="penyakitTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode ICD</th>
                        <th>Nama Penyakit</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM Penyakit ORDER BY nama";
                        $result = $conn->query($query);
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>ICD-{$row['id_penyakit']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['kategori']}</td>
                                <td>" . substr($row['deskripsi'], 0, 30) . "...</td>
                                <td>
                                    <button class='btn btn-sm btn-warning edit-penyakit' data-id='{$row['id_penyakit']}'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>
                                    <button class='btn btn-sm btn-danger hapus-penyakit' data-id='{$row['id_penyakit']}'>
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

<!-- Add Disease Modal -->
<div class="modal fade" id="tambahPenyakitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penyakit Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_penyakit.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Penyakit</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" class="form-control" name="kategori" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
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

<!-- Edit Disease Modal -->
<div class="modal fade" id="editPenyakitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_penyakit.php" method="POST">
                <input type="hidden" name="id_penyakit" id="edit_id_penyakit">
                <div class="modal-body">
                    <!-- Will be filled by AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
// Pastikan jQuery sudah terload
if (typeof jQuery == 'undefined') {
    console.error('jQuery is not loaded');
} else {
    $(document).ready(function() {
        // Edit button click with event delegation
        $(document).on('click', '.edit-penyakit', function() {
            var id = $(this).data('id');
            console.log('Edit penyakit ID:', id);
            
            $.ajax({
                url: '../proses/get_penyakit.php',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    console.log('Response:', response);
                    $('#editPenyakitModal .modal-body').html(response);
                    $('#edit_id_penyakit').val(id);
                    $('#editPenyakitModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Gagal memuat data penyakit');
                }
            });
        });
        
        // Delete button click with confirmation
        $(document).on('click', '.hapus-penyakit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('Delete penyakit ID:', id);
            
            if(confirm('Apakah Anda yakin ingin menghapus penyakit ini?')) {
                window.location.href = '../proses/crud_penyakit.php?hapus=' + id;
            }
        });
    });
}
</script>

<?php include '../includes/footer.php'; ?>