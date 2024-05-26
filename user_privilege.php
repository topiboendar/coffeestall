<?php
    if($username = ''){
        $user_id = '';
        $is_login = '';
        $role_id = 3; // 3 Sebagai anonim
        $alias = 'Visitor';
        $nama_user = '';
        $jumlah_item_keranjang = 0;

    } else {
        $sql_queries_user = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql_queries_user);

        if(mysqli_num_rows($result) == 0) die ('Data user tidak ada');

        $data = mysqli_fetch_assoc($result);

        $user_id = $data['id'];
        $is_login = 1;
        $role_id = $data['role_id'];
        $alias = $data['role_id'] == 0 ? 'Admin' : 'Customer';
        $nama_user = $data['fullname'];
        $jumlah_item_keranjang = $data['jumlah_item_keranjang'];
    }

?>