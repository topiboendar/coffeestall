<?php
// echo '<pre>';
// var_dump($_POST, $_FILES);
// var_dump($_SESSION);
// echo '</pre>';

if (isset($_POST['btn_simpan'])) {
    $nama_prod = $_POST["nama_produk"];
    $deskripsi_prod = $_POST["deskripsi_produk"];
    $harga_satuan = $_POST["harga_satuan"];
    $jumlah_prod = $_POST["jumlah_produk"];
    $gambar_prod = $_FILES["gambar_produk"]["name"];

    $sql_query = "INSERT INTO 
                        tbl_produk (nama_produk, deskripsi_produk, harga_satuan, jumlah_produk, gambar_produk) 
                        VALUES ('$nama_prod', '$deskripsi_prod', '$harga_satuan', '$jumlah_prod', '$gambar_prod')";

    if (mysqli_query($conn, $sql_query)) {
        echo "
            <div class='modal fade' id='inputDataSuccess' tabindex='-1' aria-labelledby='inputDataSuccessLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='inputDataSuccessLabel'>Notifikasi</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>
                        <div class='modal-body'>
                            <p>Produk berhasi ditambahkan<p>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-primary' data-dismiss='modal'>Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src='vendor/jquery/dist/jquery.min.js'></script>
            <script src='vendor/popper.js/dist/umd/popper.min.js'></script>
            <script src='assets/js/bootstrap.min.js'></script>
            <script>
                $('#inputDataSuccess').modal('show');
            </script>
            ";
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }

    $tujuan_awal = $_FILES["gambar_produk"]["tmp_name"];
    $tujuan_akhir = "uploads/$gambar_prod";
    move_uploaded_file($tujuan_awal, $tujuan_akhir);
};


?>

<section id="product_container" class="product p-3">
    <div class="d-none" id="id_user"><?= $user_id ?></div>
    <h3 class="font-weight-bold text-capitalize text-center py-4">daftar produk</h3>
    <div id="product_row" class="product-row">
        <!-- card item is here -->
        <?php
        $sql_queries_show = "SELECT a.*,
            (SELECT 1 FROM tbl_keranjang WHERE product_id = a.id LIMIT 1) sudah_dikeranjang 
            FROM tbl_produk a ORDER BY a.created_at DESC";
        $result = mysqli_query($conn, $sql_queries_show);

        if (!$result) {
            echo "Query tidak berhasil di jalankan ($sql_queries_show) dari database:" . mysqli_error($conn);
        } else if (mysqli_num_rows($result) == 0) {

            echo $role_id != 0 ?
                "<div class='alert alert-warning border' role='alert'>
                        Belum ada produk yang ditambahkan, silahkan hubungi admin.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>

                    </div>" :
                "
                    <div class='alert alert-warning border' role='alert'>
                        Belum ada produk yang bisa ditampilkan, silahkan tambahkan produk.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>

                    </div>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $prod_id = $row['id'];
                $priceTag = 'Rp ' . number_format($row['harga_satuan'], 0, ',', '.');
                $sudah_dikeranjang = $row['sudah_dikeranjang'];

                if ($row['sudah_dikeranjang']) {
                    $custom = 'secondary';
                    $caption = 'Keluarkan dari Keranjang';
                } else {
                    $custom = 'outline-success';
                    $caption = '+ Keranjang';
                }

                $btn_tambah_keranjang = "<button class='btn btn-$custom w-100 btn_keranjang' id='btn_keranjang__$prod_id'>$caption</button>";

                $btn_tambah_item_keranjang = $is_login ? $btn_tambah_keranjang : "<a class='btn btn-outline-success w-100 btn_keranjang' href='?login'>+ Keranjang</a>";

                echo "
                        <div class='card list-product' id='prod_item'>
                            <img class='card-img-top' id='img_product' src='uploads/$row[gambar_produk]' alt='$row[nama_produk]'>
                            <div class='card-body text-center mt-auto'>
                                <h5 id='name_product' class='card-title'>$row[nama_produk]</h5>
                                <p id='flavour_prod' class='card-text'>Qty: $row[jumlah_produk]</p>
                                <p id='price_tag' class='font-weight-bold'>$priceTag</p>
                            </div>
                            <div class='card-footer border-0 bg-white'>
                                $btn_tambah_item_keranjang
                            </div>
                        </div>
                    ";
            }
        }

        // mysqli_close($conn);
        ?>
    </div>

    <?php $role_id == 0 ? include 'create-product.php' : ''; ?>

</section>

<!-- script tambah keranjang ada di index.php -->