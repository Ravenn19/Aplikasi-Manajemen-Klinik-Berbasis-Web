<?php 
include '../includes/header2.php';
include '../config/database.php';

// Handle success/error messages
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;
$resep_id = isset($_GET['id']) ? intval($_GET['id']) : null;
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
    <h2 class="mb-0">Manajemen Resep Obat</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahResepModal">
        <i class="bi bi-plus-lg me-1"></i> Resep Baru
    </button>
</div>

<!-- Search Box -->
<div class="card mb-4">
    <div class="card-body">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" id="searchResep" placeholder="Cari pasien/dokter...">
        </div>
    </div>
</div>

<!-- Main Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="resepTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Resep</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT r.*, p.nama as nama_pasien, d.nama as nama_dokter 
                              FROM resep_obat r
                              JOIN kunjungan k ON r.id_kunjungan = k.id_kunjungan
                              JOIN pasien p ON k.id_pasien = p.id_pasien
                              JOIN dokter d ON r.id_dokter = d.id_dokter
                              ORDER BY r.tgl_resep DESC";
                    $result = $conn->query($query);
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>$no</td>
                            <td>".date('d/m/Y', strtotime($row['tgl_resep']))."</td>
                            <td>$row[nama_pasien]</td>
                            <td>$row[nama_dokter]</td>
                            <td>Rp ".number_format($row['total_harga'], 0, ',', '.')."</td>
                            <td>
                                <button class='btn btn-sm btn-warning edit-resep' data-id='$row[id_resep]'>
                                    <i class='bi bi-pencil-square'></i>
                                </button>
                                <button class='btn btn-sm btn-danger hapus-resep' data-id='$row[id_resep]'>
                                    <i class='bi bi-trash'></i>
                                </button>
                                <a href='detail_resep.php?id=$row[id_resep]' class='btn btn-sm btn-info'>
                                    <i class='bi bi-eye'></i>
                                </a>
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

<!-- Add Prescription Modal -->
<div class="modal fade" id="tambahResepModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Resep Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_resep.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kunjungan</label>
                            <select class="form-select" name="id_kunjungan" required>
                                <option value="">Pilih Kunjungan</option>
                                <?php
                                $kunjungan = $conn->query("SELECT k.id_kunjungan, p.nama, k.tgl_kunjungan 
                                                          FROM kunjungan k
                                                          JOIN pasien p ON k.id_pasien = p.id_pasien
                                                          ORDER BY k.tgl_kunjungan DESC");
                                while($k = $kunjungan->fetch_assoc()) {
                                    echo "<option value='$k[id_kunjungan]'>$k[nama] - ".date('d/m/Y H:i', strtotime($k['tgl_kunjungan']))."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dokter</label>
                            <select class="form-select" name="id_dokter" required>
                                <option value="">Pilih Dokter</option>
                                <?php
                                $dokter = $conn->query("SELECT * FROM dokter ORDER BY nama");
                                while($d = $dokter->fetch_assoc()) {
                                    echo "<option value='$d[id_dokter]'>$d[nama] ($d[spesialisasi])</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Resep</label>
                            <input type="date" class="form-control" name="tgl_resep" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="number" class="form-control" name="total_harga" required>
                        </div>
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

<!-- Edit Prescription Modal -->
<div class="modal fade" id="editResepModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Resep</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../proses/crud_resep.php" method="POST">
                <input type="hidden" name="id_resep" id="edit_id_resep">
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
            echo $success == 'tambah' ? "Data resep berhasil ditambahkan" : 
                 ($success == 'edit' ? "Data resep berhasil diperbarui" : 
                 "Data resep berhasil dihapus"); 
        ?>');
        $('.toast').addClass('text-white bg-success');
        toast.show();
        
        // Scroll to the newly added/edited row
        <?php if($resep_id): ?>
            setTimeout(() => {
                $('tr[data-id="<?= $resep_id ?>"]').get(0).scrollIntoView({
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
    $("#searchResep").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#resepTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Edit button click
    $('.edit-resep').click(function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '../proses/get_resep.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                $('#editResepModal .modal-body').html(response);
                $('#edit_id_resep').val(id);
                $('#editResepModal').modal('show');
            },
            error: function(xhr) {
                $('.toast-body').text('Error: ' + xhr.statusText);
                $('.toast').addClass('text-white bg-danger');
                toast.show();
            }
        });
    });
    
    // Delete button click
    $('.hapus-resep').click(function() {
        if(confirm('Apakah Anda yakin ingin menghapus data resep ini?')) {
            var id = $(this).data('id');
            window.location.href = '../proses/crud_resep.php?hapus=' + id;
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>