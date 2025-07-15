<?php
include '../config/database.php';

header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID penyakit tidak valid'
    ]);
    exit;
}

$id = $_POST['id'];
$query = "SELECT * FROM Penyakit WHERE id_penyakit = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Kembalikan form HTML untuk edit
    $html = '
    <div class="mb-3">
        <label class="form-label">Nama Penyakit</label>
        <input type="text" class="form-control" name="nama" value="'.htmlspecialchars($row['nama']).'" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input type="text" class="form-control" name="kategori" value="'.htmlspecialchars($row['kategori']).'" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="3">'.htmlspecialchars($row['deskripsi']).'</textarea>
    </div>';
    
    echo $html;
} else {
    echo '<div class="alert alert-danger">Data penyakit tidak ditemukan</div>';
}

$stmt->close();
$conn->close();
?>