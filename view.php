<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>View Foto</title>
</head>
<body>
    <ul class="nav bg-success mb-0">
        <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="album.php">Album</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="foto.php">Foto</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
    </ul>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <form action="tambah_komentar.php" method="post">
                    <?php
                        include "koneksi.php";
                        $fotoid=$_GET['fotoid'];
                        $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                    <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
                    <img src="gambar/<?=$data['lokasifile']?>" class="img-fluid">
                </form>
                <table>
                    <tr>
                        <td>
                            <a href="like.php?fotoid=<?=$data['fotoid']?>" class="btn btn-primary">
                                <?php
                                    $isLiked = true;  
                                    if ($isLiked) {
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                            </svg>';
                                    } else {
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                            </svg>';
                                    }
                                ?>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?=$data['judulfoto']?></h5>
                        <p class="card-text"><?=$data['deskripsifoto']?></p>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <form action="tambah_komentar.php" method="post">
        <?php
            include "koneksi.php";
            $fotoid=$_GET['fotoid'];
            $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
            while($data=mysqli_fetch_array($sql)){
        ?>
        <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
        <table class="table">
            <tr>
                <td>Komentar</td>
                <td><input type="text" name="isikomentar" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Tambah" class="btn btn-primary">
                </td>
            </tr>
        </table>
        <?php
            }
        ?>
    </form>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Tanggal</th>
            <th>Aksi</th> 
        </tr>
        <?php
            include "koneksi.php";
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid");
            while ($data = mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?=$data['namalengkap']?></td>
            <td><?=$data['isikomentar']?></td>
            <td><?=$data['tanggalkomentar']?></td>
            <td>
                <?php
                    // Periksa apakah ID pengguna sesuai dengan ID pengguna yang membuat komentar
                    if($data['userid'] == $userid){
                ?>
                <form action="hapus_komentar.php" method="post">
                    <input type="hidden" name="komentarid" value="<?=$data['komentarid']?>">
                    <button type="submit" class="btn btn-danger">Hapus</button> 
                </form>
                <?php } ?>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>
