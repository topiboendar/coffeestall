<?php
    if($email == ''){
        $user_id = '';
        $is_login = '';
        $role_id = 3; // 3 Sebagai anonim
        $alias = 'Visitor';
        $nama_user = '';
        $jumlah_item_keranjang = 0;

    } else {
        $sql_queries_user = "SELECT *,
                            (SELECT 0) jumlah_item_keranjang
                            FROM tbl_pengguna WHERE email='$email'";
        
        $result_data_login = mysqli_query($conn, $sql_queries_user) or die(mysqli_error($conn));

        if(mysqli_num_rows($result_data_login) == 0) die ('Data email tidak ada');

        $data = mysqli_fetch_assoc($result_data_login);

        $user_id = $data['id'];
        $is_login = 1;
        $role_id = $data['role_id'];
        $alias = $data['role_id'] == 0 ? 'Admin' : 'Customer';
        $nama_user = $data['nama_lengkap'];
        $jumlah_item_keranjang = $data['jumlah_item_keranjang'];
    }

?>