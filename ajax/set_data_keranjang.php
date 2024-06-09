<?php

include '../conn.php';

$id_produk = $_GET['id_produk'] ?? die('Butuh data id_produk');
$id_user = $_GET['id_user'] ?? die('Butuh data id_user');
$item_keranjang_hapus = $_GET['item_keranjang_hapus'] ?? '';

if($item_keranjang_hapus == ''){
    $sql_query = "INSERT INTO tbl_keranjang (product_id, user_id) VALUES ($id_produk, $id_user)";
} else if($item_keranjang_hapus == 'hapus'){
    $sql_query = "DELETE FROM tbl_keranjang WHERE product_id=$id_produk AND user_id=$id_user" ;
}

if(mysqli_query($conn, $sql_query)){
    echo "sukses";
}else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}