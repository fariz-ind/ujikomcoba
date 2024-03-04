<?php
    include "koneksi.php";
    session_start();

    // Pastikan komentarid telah diterima melalui metode POST atau GET
    if(isset($_POST['komentarid'])) {
        $komentarid = $_POST['komentarid'];

        // Lakukan query untuk menghapus komentar berdasarkan komentarid
        $sql = mysqli_query($conn, "DELETE FROM komentarfoto WHERE komentarid='$komentarid'");
        
        // Setelah menghapus, arahkan kembali ke halaman sebelumnya atau halaman yang sesuai
        // Misalnya, arahkan kembali ke halaman yang menampilkan komentar foto
        header("location:halaman_sebelumnya.php");
    } else {
        // Jika komentarid tidak diterima, mungkin ada kesalahan
        echo "Komentar ID tidak ditemukan.";
    }
?>
