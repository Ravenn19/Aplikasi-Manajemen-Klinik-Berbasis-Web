<?php
include '../config/database.php';

if(isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $query = "SELECT * FROM dokter WHERE id_dokter = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        ?>
        
        <div class="mb-3">
            <label class="form-label">Nama Dokter</label>
            <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Spesialisasi</label>
            <input type="text" class="form-control" name="spesialisasi" value="<?= htmlspecialchars($data['spesialisasi']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">No. Izin Praktek</label>
            <input type="text" class="form-control" name="no_izin_praktek" value="<?= htmlspecialchars($data['no_izin_praktek']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="no_telp" value="<?= htmlspecialchars($data['no_telp']) ?>" required>
        </div>
        
        <?php
    } else {
        echo "<div class='alert alert-danger'>Data dokter tidak ditemukan</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID dokter tidak valid</div>";
}
?>