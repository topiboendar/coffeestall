<?php
    $servername = "localhost";
    $username = "root";
    $password = "admin123";
    $db_name = "coffeestall";

    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if(!$conn){
        die("Koneksi Gagal :".mysqli_connect_error());
    }

    // echo "Koneksi Sukses";  
?>