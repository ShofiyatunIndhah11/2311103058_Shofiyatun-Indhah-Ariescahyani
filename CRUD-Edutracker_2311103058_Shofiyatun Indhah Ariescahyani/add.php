<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $mata_kuliah = $_POST['mata_kuliah'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $jenis = $_POST['jenis'];
    $status = $_POST['status'];

    $query = "INSERT INTO daftartugas (mata_kuliah, deskripsi, deadline, jenis, status) 
              VALUES ('$mata_kuliah', '$deskripsi', '$deadline', '$jenis', '$status')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
