<?php
include '../config/database.php';

if(isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $query = "SELECT k.*, p.nama as nama_pasien, py.nama as nama_penyakit 
              FROM Kunjungan k
              JOIN Pasien p ON k.id_pasien = p.id_pasien
              JOIN Penyakit py ON k.id_penyakit = py.id_penyakit
              WHERE k.id_kunjungan = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $tgl_kunjungan = date('Y-m-d\TH:i', strtotime($data['tgl_kunjungan']));
        ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pasien</label>
                <select class="form-select" name="id_pasien" required>
                    <option value="<?= $data['id_pasien'] ?>"><?= $data['nama_pasien'] ?></option>
                    <?php
                    $pasien = $conn->query("SELECT * FROM Pasien WHERE id_pasien != ".$data['id_pasien']." ORDER BY nama");
                    while($p = $pasien->fetch_assoc()) {
                        echo "<option value='$p[id_pasien]'>$p[nama] (NIK: $p[nik])</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Penyakit</label>
                <select class="form-select" name="id_penyakit" required>
                    <option value="<?= $data['id_penyakit'] ?>"><?= $data['nama_penyakit'] ?></option>
                    <?php
                    $penyakit = $conn->query("SELECT * FROM Penyakit WHERE id_penyakit != ".$data['id_penyakit']." ORDER BY nama");
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
                <input type="datetime-local" class="form-control" name="tgl_kunjungan" value="<?= $tgl_kunjungan ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="Rawat Jalan" <?= $data['status'] == 'Rawat Jalan' ? 'selected' : '' ?>>Rawat Jalan</option>
                    <option value="Rawat Inap" <?= $data['status'] == 'Rawat Inap' ? 'selected' : '' ?>>Rawat Inap</option>
                    <option value="Sembuh" <?= $data['status'] == 'Sembuh' ? 'selected' : '' ?>>Sembuh</option>
                    <option value="Rujuk" <?= $data['status'] == 'Rujuk' ? 'selected' : '' ?>>Rujuk</option>
                </select>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Gejala</label>
            <textarea class="form-control" name="gejala" rows="3" required><?= htmlspecialchars($data['gejala']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tindakan</label>
            <textarea class="form-control" name="tindakan" rows="3" required><?= htmlspecialchars($data['tindakan']) ?></textarea>
        </div>
        
        <?php
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID tidak valid</div>";
}
?>