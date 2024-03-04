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

    <title>Halaman Album</title>
    <style>
        .card {
            height: 400px; 
        }
    </style>
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
        <?php
            include "koneksi.php";
            // Ubah query untuk mengambil semua foto
            $sql = mysqli_query($conn, "SELECT * FROM foto");
            while($data = mysqli_fetch_array($sql)){
        ?>
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="gambar/<?=$data['lokasifile']?>" class="card-img-top" alt="<?=$data['judulfoto']?>">
                <div class="card-body">
                    <h5 class="card-title"><?=$data['judulfoto']?></h5>
                    <p class="card-text"><?=$data['deskripsifoto']?></p>
                    <a href="view.php?fotoid=<?=$data['fotoid']?>" class="btn btn-primary">View Foto</a>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>

</body>
</html>
