<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Edit Foto</title>
</head>
<body>

<ul class="nav bg-success mb-0">
    <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="album.php">Album</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="foto.php">Foto</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
</ul>

<?php
    include "koneksi.php";
    $userid = $_SESSION['userid'];
    $fotoid = isset($_GET['fotoid']) ? intval($_GET['fotoid']) : 0;
    $sql = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid' AND userid='$userid'");
    if(mysqli_num_rows($sql) > 0) {
        $data = mysqli_fetch_array($sql);
?>

<form action="update_foto.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="fotoid" value="<?=$data['fotoid']?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card bg-light p-3">
                    <h3 class="text-center mb-4">Ubah Foto</h3>
                    <div class="mb-3">
                        <img src="gambar/<?=$data['lokasifile']?>" width="500px">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judulfoto" value="<?=$data['judulfoto']?>">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsifoto" value="<?=$data['deskripsifoto']?>">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi File</label>
                        <input type="file" class="form-control" id="lokasi" name="lokasifile">
                    </div>
                    <div class="mb-3">
                        <label for="album" class="form-label">Album</label>
                        <select class="form-select" id="album" name="albumid">
                            <?php
                                $sql2=mysqli_query($conn,"SELECT * FROM album");
                                while($data2=mysqli_fetch_array($sql2)){
                            ?>
                                <option value="<?=$data2['albumid']?>" <?php if($data2['albumid']==$data['albumid']){echo 'selected';}?>><?=$data2['namaalbum']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Ubah">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
    } else {
        echo "Foto tidak ditemukan atau Anda tidak memiliki akses ke foto ini.";
    }
?>

</body>
</html>
