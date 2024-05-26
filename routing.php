<?php

session_start();
// session_destroy();
// exit();


$page_destination = "pages/$parameter.php";
if(!isset($parameter)) die('Routing yang dituju tidak ada atau file tidak ada');

if($parameter === '' || $parameter === '?home'){
    include "pages/home.php";
    
    // pengecekan privilige sesuai dengan role_id

    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';

    $username = '';
    if(isset($_SESSION['lshop_username'])){
        $username = $_SESSION['lshop_username'];
    }

    echo "Username yang aktif: $username";

    include 'user_privilege.php';

    if($role_id == '0'){
        echo '<button type="button" class="btn btn-success rounded-pill shadow fab-product font-weight-bolder px-3 py-2" data-toggle="modal" data-target="#btnAddProduct">Tambah Produk</button>';
    }

} elseif(!file_exists($page_destination)){
    include "pages/404Page.php";
} else {
    include($page_destination);
}

?>