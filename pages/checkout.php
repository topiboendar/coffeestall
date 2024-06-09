<?php

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

foreach ($_POST as $key => $qty) {
    if($qty>1){
        $arr = explode('__', $key);
        $id_chart = $arr[1] ?? '';
    
        $sql_query_update = "UPDATE tbl_keranjang SET qty='$qty' WHERE id='$id_chart'";
        $query_db = mysqli_query($conn, $sql_query_update) or die(mysqli_error($conn));
    }
}

$total = $_POST['total_hidden'] ?? die('Butuh data total keranjang');

?>

<section class="row col-md-11 col-lg-10 flex-column mx-auto">
    <div class="py-3 text-center">
        <h3 class="font-weight-bold text-capitalize text-center mb-0">Checkout</h3>
        <small>Silahkan anda bayar sesuai dengan Invoice</small>
    </div>
    <div class="card mb-4 text-center">
        <div class="card-header">
            <h4 class='mt-3'>Total bayar</h4>
            <p>Rp. <?= number_format($total, 0) ?></p>
        </div>
        <div class="card-body">
            <ul class="list-unstyled text-left">
                <li>Cara Bayar: Transfer</li>
                <li>No.Rek: 414567445</li>
                <li>BCA: cabang Bandung</li>
                <li>Atas Nama: CoffeeStall Gresik</li>
                <li>Paling lambat tanggal 5 Juni 2024</li>
            </ul>
        </div>
        <div class="card-footer">
            <button class='btn btn-primary w-100' onclick='window.print()'>Cetak Invoice</button>
        </div>
    </div>
</section>
