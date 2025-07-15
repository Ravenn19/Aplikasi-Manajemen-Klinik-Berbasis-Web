<?php
include '../config/database.php';

// Create
if(isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'] ?? '';
    
    $query = "INSERT INTO Penyakit (nama, kategori, deskripsi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nama, $kategori, $deskripsi);
    
    if($stmt->execute()) {
        header("Location: ../pages/penyakit.php?success=tambah");
    } else {
        header("Location: ../pages/penyakit.php?error=".$stmt->error);
    }
    exit;
}

// Update
if(isset($_POST['edit'])) {
    $id = $_POST['id_penyakit'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'] ?? '';
    
    $query = "UPDATE Penyakit SET nama=?, kategori=?, deskripsi=? WHERE id_penyakit=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $nama, $kategori, $deskripsi, $id);
    
    if($stmt->execute()) {
        header("Location: ../pages/penyakit.php?success=edit");
    } else {
        header("Location: ../pages/penyakit.php?error=".$stmt->error);
    }
    exit;
}

// Delete
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    
    // Cek apakah penyakit digunakan di kunjungan
    $check = $conn->query("SELECT COUNT(*) FROM Kunjungan WHERE id_penyakit = $id")->fetch_row()[0];
    
    if($check > 0) {
        header("Location: ../pages/penyakit.php?error=Data tidak bisa dihapus karena sudah digunakan di data kunjungan");
    } else {
        $query = "DELETE FROM Penyakit WHERE id_penyakit = $id";
        if($conn->query($query)) {
            header("Location: ../pages/penyakit.php?success=hapus");
        } else {
            header("Location: ../pages/penyakit.php?error=".$conn->error);
        }
    }
    exit;
}
?>