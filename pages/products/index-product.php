<?php
    echo '<pre>';
    // var_dump($_POST, $_FILES);
    // var_dump($_SESSION);
    echo '</pre>';

    if(isset($_POST['btn_simpan'])){
        $nama_prod = $_POST["nama_produk"];
        $deskripsi_prod = $_POST["deskripsi_produk"];
        $harga_satuan = $_POST["harga_satuan"];
        $jumlah_prod = $_POST["jumlah_produk"];
        $gambar_prod = $_FILES["gambar_produk"]["name"];
    
        $sql_query = "INSERT INTO 
                        tbl_produk (nama_produk, deskripsi_produk, harga_satuan, jumlah_produk, gambar_produk) 
                        VALUES ('$nama_prod', '$deskripsi_prod', '$harga_satuan', '$jumlah_prod', '$gambar_prod')";
    
        if(mysqli_query($conn, $sql_query)){
            echo "Data berhasil di inputkan";
        } else {
            echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
        }

        $tujuan_awal = $_FILES["gambar_produk"]["tmp_name"];
        $tujuan_akhir = "uploads/$gambar_prod";
        move_uploaded_file($tujuan_awal, $tujuan_akhir);
        
    };


?>

<section id="product_container" class="product p-3">
    <h3 class="font-weight-bold text-capitalize text-center py-4">list product</h3>
    <div id="product_row" class="product-row">
        <!-- card item is here -->
        <?php
            $sql_queries_show = "SELECT * FROM tbl_produk ORDER BY created_at DESC";
            $result = mysqli_query($conn, $sql_queries_show);
        
            if(!$result){
                echo "Query tidak berhasil di jalankan ($sql_queries_show) dari database:" . mysqli_error();
            } else if(mysqli_num_rows($result) == 0){
                echo "Tidak ada baris yang ditemukan, tidak ada yang perlu di print";
            } else {
                while($row = mysqli_fetch_assoc($result)){

                    $priceTag = 'Rp ' . number_format($row['harga_satuan'], 0, ',', '.');

                    echo "
                        <div class='card' id='prod_item'>
                            <img class='card-img-top' id='img_product' src='uploads/$row[gambar_produk]' alt='$row[nama_produk]'>
                            <div class='card-body text-center mt-auto'>
                                <h5 id='name_product' class='card-title'>$row[nama_produk]</h5>
                                <p id='flavour_prod' class='card-text'>Qty: $row[jumlah_produk]</p>
                                <p id='price_tag' class='font-weight-bold'>$priceTag</p>
                            </div>
                            <div class='card-footer border-0 bg-white'>
                                <button class='btn btn-outline-dark w-100'>+ Keranjang</button>
                            </div>
                        </div>
                    ";
                }
            }
            
            // mysqli_close($conn);
        ?>
    </div>

    <?php echo $role_id == 0 ? include 'create-product.php' : ''; ?>

</section>