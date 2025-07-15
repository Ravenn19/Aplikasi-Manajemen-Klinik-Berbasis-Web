<?php
include '../config/database.php';

// Handle Delete
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    
    // Cek apakah pasien memiliki kunjungan
    $check = $conn->query("SELECT COUNT(*) FROM Kunjungan WHERE id_pasien = $id")->fetch_row()[0];
    
    if ($check > 0) {
        header("Location: ../pages/pasien.php?error=Data tidak bisa dihapus karena pasien memiliki riwayat kunjungan");
        exit;
    }
    
    $query = "DELETE FROM Pasien WHERE id_pasien = $id";
    
    if ($conn->query($query)) {
        header("Location: ../pages/pasien.php?success=Data pasien berhasil dihapus");
    } else {
        header("Location: ../pages/pasien.php?error=Gagal menghapus data pasien");
    }
    exit;
}

// Handle Edit
if (isset($_POST['edit'])) {
    $id = $_POST['id_pasien'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $gender = $_POST['gender'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    
    $query = "UPDATE Pasien SET 
              nik = '$nik', 
              nama = '$nama', 
              tgl_lahir = '$tgl_lahir', 
              gender = '$gender', 
              alamat = '$alamat', 
              no_telp = '$no_telp' 
              WHERE id_pasien = $id";
    
    if ($conn->query($query)) {
        header("Location: ../pages/pasien.php?success=Data pasien berhasil diperbarui");
    } else {
        header("Location: ../pages/pasien.php?error=Gagal memperbarui data pasien");
    }
    exit;
}

// Handle Tambah
if (isset($_POST['tambah'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $gender = $_POST['gender'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    
    $query = "INSERT INTO Pasien (nik, nama, tgl_lahir, gender, alamat, no_telp) 
              VALUES ('$nik', '$nama', '$tgl_lahir', '$gender', '$alamat', '$no_telp')";
    
    if ($conn->query($query)) {
        header("Location: ../pages/pasien.php?success=Data pasien berhasil ditambahkan");
    } else {
        header("Location: ../pages/pasien.php?error=Gagal menambahkan data pasien");
    }
    exit;
}
?>