<?php
include '../config/database.php';

// CREATE - Tambah Data Dokter
if(isset($_POST['tambah'])) {
    try {
        $nama = htmlspecialchars($_POST['nama']);
        $spesialisasi = htmlspecialchars($_POST['spesialisasi']);
        $no_izin_praktek = htmlspecialchars($_POST['no_izin_praktek']);
        $no_telp = htmlspecialchars($_POST['no_telp']);
        
        $stmt = $conn->prepare("INSERT INTO dokter (nama, spesialisasi, no_izin_praktek, no_telp) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $spesialisasi, $no_izin_praktek, $no_telp);
        
        if($stmt->execute()) {
            header("Location: ../pages/dokter.php?success=tambah&id=".$conn->insert_id);
            exit();
        } else {
            throw new Exception("Gagal menambahkan data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/dokter.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// UPDATE - Edit Data Dokter
if(isset($_POST['edit'])) {
    try {
        $id = intval($_POST['id_dokter']);
        $nama = htmlspecialchars($_POST['nama']);
        $spesialisasi = htmlspecialchars($_POST['spesialisasi']);
        $no_izin_praktek = htmlspecialchars($_POST['no_izin_praktek']);
        $no_telp = htmlspecialchars($_POST['no_telp']);

        $stmt = $conn->prepare("UPDATE dokter SET 
                              nama = ?,
                              spesialisasi = ?,
                              no_izin_praktek = ?,
                              no_telp = ?
                              WHERE id_dokter = ?");
        $stmt->bind_param("ssssi", $nama, $spesialisasi, $no_izin_praktek, $no_telp, $id);
        
        if($stmt->execute()) {
            header("Location: ../pages/dokter.php?success=edit&id=".$id);
            exit();
        } else {
            throw new Exception("Gagal memperbarui data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/dokter.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// DELETE - Hapus Data Dokter
if(isset($_GET['hapus'])) {
    try {
        $id = intval($_GET['hapus']);
        
        // Check if doctor has prescriptions
        $check = $conn->prepare("SELECT COUNT(*) FROM resep_obat WHERE id_dokter = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();
        
        if($count > 0) {
            throw new Exception("Dokter tidak dapat dihapus karena memiliki resep terkait");
        }
        
        $stmt = $conn->prepare("DELETE FROM dokter WHERE id_dokter = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            header("Location: ../pages/dokter.php?success=hapus");
            exit();
        } else {
            throw new Exception("Gagal menghapus data: ".$stmt->error);
        }
    } catch (Exception $e) {
        header("Location: ../pages/dokter.php?error=".urlencode($e->getMessage()));
        exit();
    }
}

// Jika tidak ada aksi yang valid
header("Location: ../pages/dokter.php");
exit();
?>