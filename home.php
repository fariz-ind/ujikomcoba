<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

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
</body>
</html>