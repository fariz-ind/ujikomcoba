<!DOCTYPE html>
<html lang="en">
<head class="bg-success">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['userid'])){
    ?>
            <ul class="nav bg-success">
                <li class="nav-item"><a class="nav-link text-white" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
            </ul>
    <?php
        }else{
    ?>   
    <p class="bg-success text-white p-3 mb-0">Haii <b><?=$_SESSION['namalengkap']?></b></p>
        <ul class="nav bg-success">
        <ul class="nav">
    <li class="nav-item"><a class="nav-link text-white btn btn-success" href="index.php">Home</a></li>
    <li class="nav-item"><a class="nav-link text-white btn btn-success" href="album.php">Album</a></li>
    <li class="nav-item"><a class="nav-link text-white btn btn-success" href="foto.php">Foto</a></li>
    <li class="nav-item"><a class="nav-link text-white btn btn-success" href="logout.php">Logout</a></li>
</ul>

        </ul>
    <?php
        }
    ?>
    
   <table class="table table-success table-striped">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Uploader</th>
            <th>Jumlah Like</th>
        </tr>
        <?php
            include "koneksi.php";
            $sql=mysqli_query($conn,"select * from foto,user where foto.userid=user.userid");
            while($data=mysqli_fetch_array($sql)){
        ?>
            <tr>
                <td><?=$data['fotoid']?></td>
                <td><?=$data['judulfoto']?></td>
                <td><?=$data['deskripsifoto']?></td>
                <td>
                    <img src="gambar/<?=$data['lokasifile']?>" width="200px">
                </td>
                <td><?=$data['namalengkap']?></td>
                <td>
                    <?php
                        $fotoid=$data['fotoid'];
                        $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
                        echo mysqli_num_rows($sql2);
                    ?>
                </td>

            </tr>
        <?php
            }
        ?>
    </table>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
