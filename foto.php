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
    <title>Foto</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .btn-tambah {
            margin-bottom: 20px;
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

    <form action="tambah_foto.php" method="post" enctype="multipart/form-data" class="mt-4 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card bg-light p-3" style="height: 400px;">
                        <h3 class="text-center mb-4">Tambah Foto</h3>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judulfoto" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsifoto" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi File</label>
                            <input type="file" class="form-control" id="lokasi" name="lokasifile" required>
                        </div>
                        <div class="mb-3">
                            <label for="album" class="form-label">Album</label>
                            <select class="form-select" id="album" name="albumid" required>
                                <?php
                                    include "koneksi.php";
                                    $sql=mysqli_query($conn,"select * from album");
                                    while($data=mysqli_fetch_array($sql)){
                                ?>
                                        <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-success table-striped mt-4">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal Unggah</th>
            <th>Lokasi File</th>
            <th>Album</th>
            <th>Disukai</th>
            <th>Aksi</th>
        </tr>
        <?php
            include "koneksi.php";
            $sql=mysqli_query($conn,"select * from foto,album where foto.albumid=album.albumid");
            while($data=mysqli_fetch_array($sql)){
        ?>
            <tr>
                <td><?=$data['fotoid']?></td>
                <td><?=$data['judulfoto']?></td>
                <td><?=$data['deskripsifoto']?></td>
                <td><?=$data['tanggalunggah']?></td>
                <td>
                    <img src="gambar/<?=$data['lokasifile']?>" width="200px">
                </td>
                <td><?=$data['namaalbum']?></td>
                <td>
                    <?php
                        $fotoid=$data['fotoid'];
                        $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
                        echo mysqli_num_rows($sql2);
                    ?>
                </td>
                <td>
                    <a href="hapus_foto.php?fotoid=<?=$data['fotoid']?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/></svg></a>
                    <a href="edit_foto.php?fotoid=<?=$data['fotoid']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/></svg>
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>

</body>
</html>
