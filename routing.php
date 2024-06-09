<?php

// session_destroy();
// exit();


$page_destination = "pages/$parameter.php";
if(!isset($parameter)) die('Routing yang dituju tidak ada atau file tidak ada');


if($parameter === '' || $parameter === '?home'){
    include "pages/home.php";

    echo $role_id == '0' ? '<button type="button" class="btn btn-success rounded-pill shadow fab-product font-weight-bolder display-3 px-3 py-2" data-toggle="modal" data-target="#btnAddProduct">Tambah Produk</button>' : '';

} elseif(!file_exists($page_destination)){
    include "pages/404Page.php";
} else {
    include($page_destination);
}

?>