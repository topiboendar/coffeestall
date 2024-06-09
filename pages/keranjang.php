<section class="row col-md-11 col-lg-10 flex-column mx-auto">
    <h3 class="font-weight-bold text-capitalize text-center py-4">Keranjang</h3>
    <div>
        <?php
            $query_list_produk = "SELECT 
            a.id as id_keranjang,
            b.nama_produk,
            b.harga_satuan,
            a.qty
            FROM tbl_keranjang a 
            JOIN tbl_produk b ON a.product_id=b.id
            WHERE a.user_id = $user_id";
            $query_db = mysqli_query($conn, $query_list_produk) or die(mysqli_error($conn));

            $tr = '';
            $no_product = 0;
            
            while($row = mysqli_fetch_assoc($query_db)){
                $no_product++;
                $id_keranjang = $row['id_keranjang'];
                $jumlah = $row['harga_satuan'] * $row['qty'];
                $input_qty = "<input type='number' class='form-control qty' value='$row[qty]' id='qty__$id_keranjang' name='qty__$id_keranjang' style='max-width: 100px;'>";
                
                $tr .= "
                    <tr>
                        <td>$no_product</td>
                        <td>$row[nama_produk]</td>
                        <td id='harga__$id_keranjang'>$row[harga_satuan]</td>
                        <td>$input_qty</td>
                        <td class='text-right' id='jumlah__$id_keranjang'>$jumlah</td>
                    </tr>
                ";
            }

            echo "
                <form method='post' action='?checkout'>
                    <table class='table table-striped'>
                        <thead style='background: linear-gradient(0.80turn, #FFA62E, #EA4D2C);' class='text-white'>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th class='text-right'>Total Harga</th>
                        </thead>
                        $tr
                        <tr style='background: linear-gradient(0.80turn, #FFA62E, #EA4D2C);' class='text-white'>
                            <th class='font-weight-bolder' scope='row' colspan='4'>Total</th>
                            <td class='font-weight-bolder text-right' id='total_yang_dibayar'>0</td>
                        </tr>
                    </table>
                    <input type='text' class='d-none' name='total_hidden' id='hidden_input_total'>
                    <button class='btn btn-success w-100 mb-4 shadow'>Checkout</button>
                </form>
            ";

        ?>
    </div>
</section>
<!-- script ada di index.php -->