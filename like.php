<?php
include "koneksi.php";
session_start();

if(!isset($_SESSION['userid'])){
    header("location:index.php");
} else {
    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

    if(mysqli_num_rows($sql) == 1){
        mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
        header("location:index.php");
    } else {
        $tanggallike = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO likefoto VALUES('', '$fotoid', '$userid', '$tanggallike')");
        header("location:index.php");
    }
}
?>
