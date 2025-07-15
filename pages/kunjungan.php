<?php 
include '../includes/header2.php';
include '../config/database.php';

// Handle success/error messages
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;
$kunjungan_id = isset($_GET['id']) ? intval($_GET['id']) : null;
?>

<!-- Notification Toast -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notifikasi</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Kunjungan Pasien</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKunjunganModal">
        <i class="bi bi-plus-lg me-1"></i> Kunjungan Baru
    </button>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" id="searchKunjungan" placeholder="Cari pasien/tanggal...">
        </div>
    </div>
</div>

<!-- Main Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="kunjunganTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Penyakit</th>
                        <th>Gejala</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT k.*, p.nama as nama_pasien, py.nama as nama_penyakit 
                              FROM Kunjungan k
                              JOIN Pasien p ON k.id_pasien = p.id_pasien
                              JOIN Penyakit py ON k.id_penyakit = py.id_penyakit
                              ORDER BY k.tgl_kunjungan DESC";
                    $result = $conn->query($query);
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>$no</td>
                            <td>".date('d/m/Y H:i', strtotime($row['tgl_kunjungan']))."</td>
                            <td>$row[nama_pasien]</td>
                            <td>$row[nama_penyakit]</td>
                            <td>".substr($row['gejala'], 0, 20)."...</td>
                            <td><span class='badge bg-".getStatusColor($row['status'])."'>$row[status]</span></td>
                            <td>
                                <button class='btn btn-sm btn-warning edit-kunjungan' data-id='$row[id_kunjungan]'>
                                    <i class='bi bi-pencil-square'></i>
                                </button>
                                <button class='btn btn-sm btn-danger hapus-kunjungan' data-id='$row[id_kunjungan]'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </td>
                        </tr>";
                        $no++;
                    }
                    
                    function getStatusColor($status) {
                        switch($status) {
                            case 'Rawat Inap': return 'danger';
                            case 'Sembuh': return 'success';
                            case 'Rujuk': return 'warning';
                            default: return 'primary';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Visit Modal -->
<div class="modal fade" id="tambahKunjunganModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kunjungan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_kunjungan.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pasien</label>
                            <select class="form-select" name="id_pasien" required>
                                <option value="">Pilih Pasien</option>
                                <?php
                                $pasien = $conn->query("SELECT * FROM Pasien ORDER BY nama");
                                while($p = $pasien->fetch_assoc()) {
                                    echo "<option value='$p[id_pasien]'>$p[nama] (NIK: $p[nik])</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penyakit</label>
                            <select class="form-select" name="id_penyakit" required>
                                <option value="">Pilih Penyakit</option>
                                <?php
                                $penyakit = $conn->query("SELECT * FROM Penyakit ORDER BY nama");
                                while($py = $penyakit->fetch_assoc()) {
                                    echo "<option value='$py[id_penyakit]'>$py[nama] ($py[kategori])</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Kunjungan</label>
                            <input type="datetime-local" class="form-control" name="tgl_kunjungan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="Rawat Jalan">Rawat Jalan</option>
                                <option value="Rawat Inap">Rawat Inap</option>
                                <option value="Sembuh">Sembuh</option>
                                <option value="Rujuk">Rujuk</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Gejala</label>
                        <textarea class="form-control" name="gejala" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tindakan</label>
                        <textarea class="form-control" name="tindakan" rows="3" required></textarea>
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

<!-- Edit Visit Modal -->
<div class="modal fade" id="editKunjunganModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_kunjungan.php" method="POST">
                <input type="hidden" name="id_kunjungan" id="edit_id_kunjungan">
                <div class="modal-body">
                    <!-- Content will be loaded via AJAX -->
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
$(document).ready(function() {
    // Initialize toast
    const toast = new bootstrap.Toast(document.getElementById('liveToast'));
    
    // Show notification if exists
    <?php if($success): ?>
        $('.toast-body').text('<?php 
            echo $success == 'tambah' ? "Data kunjungan berhasil ditambahkan" : 
                 ($success == 'edit' ? "Data kunjungan berhasil diperbarui" : 
                 "Data kunjungan berhasil dihapus"); 
        ?>');
        $('.toast').addClass('text-white bg-success');
        toast.show();
        
        // Scroll to the newly added/edited row
        <?php if($kunjungan_id): ?>
            setTimeout(() => {
                $('tr[data-id="<?= $kunjungan_id ?>"]').get(0).scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 500);
        <?php endif; ?>
    <?php elseif($error): ?>
        $('.toast-body').text('<?= htmlspecialchars($error) ?>');
        $('.toast').addClass('text-white bg-danger');
        toast.show();
    <?php endif; ?>

    // Search functionality
    $("#searchKunjungan").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#kunjunganTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Edit button click
    $('.edit-kunjungan').click(function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '../proses/get_kunjungan.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                $('#editKunjunganModal .modal-body').html(response);
                $('#edit_id_kunjungan').val(id);
                $('#editKunjunganModal').modal('show');
            },
            error: function(xhr) {
                $('.toast-body').text('Error: ' + xhr.statusText);
                $('.toast').addClass('text-white bg-danger');
                toast.show();
            }
        });
    });
    
    // Delete button click
    $('.hapus-kunjungan').click(function() {
        if(confirm('Apakah Anda yakin ingin menghapus data kunjungan ini?')) {
            var id = $(this).data('id');
            window.location.href = '../proses/crud_kunjungan.php?hapus=' + id;
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>