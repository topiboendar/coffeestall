<?php
session_start();
// session_destroy();
// exit;

include "conn.php";

// routing path 
$parameter = '';

if (isset($_GET)) {
    foreach ($_GET as $key => $value) {
        $parameter = $key;
    }
}

# ==================
# HANDLE SESSION
# ==================   

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

// session dummy
// $_SESSION['coffeestall_email'] = 'asd@mail.com';


$email = '';
if (isset($_SESSION['coffeestall_email'])) {
    $email = $_SESSION['coffeestall_email'];
}

include 'user_privilege.php';

// echo "Email yang aktif: $email<hr>
//         <br>Nama user: $nama_user
//         <br>Id role: $role_id
//         <br>is_login: $is_login
//         <br>alias: $alias


// ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Stall</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/simple-pagination/simplePagination.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <?php echo $parameter === 'login' ? '<link rel="stylesheet" href="assets/css/login.css">' : ''; ?>
</head>

<body>
    <?php if ($parameter !== 'login') include 'pages/layouts/header.php'; ?>
    <?php include 'routing.php' ?>
    <?php if ($parameter !== 'login') include 'pages/layouts/footer.php'; ?>
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <?php
    if ($parameter !== 'login') {
        echo "<script src='vendor/simple-pagination/jquery.simplePagination.js'></script>
                <script src='customPagination.js'></script>";
    }
    ?>
    <script>
        let jumlah_item_keranjang = parseInt($('#jumlah_item_keranjang').text());
        const user_id = $('#id_user').text();

        $('.btn_keranjang').click(function() {
            const prod_id = $(this).prop('id');
            const split_str_to_arr = prod_id.split('__');
            const get_prod_id = split_str_to_arr[1];

            let url_ajax = '';

            const caption = $(this).text();

            if (caption == '+ Keranjang') {
                jumlah_item_keranjang++;
                $(this).text('Keluarkan dari Keranjang');
                $(this).removeClass('btn-outline-success');
                $(this).addClass('btn-secondary');
                url_ajax = `ajax/set_data_keranjang.php?id_user=${user_id}&id_produk=${get_prod_id}`;
                console.log(url_ajax);

            } else {
                jumlah_item_keranjang--;
                $(this).text('+ Keranjang')
                $(this).removeClass('btn-secondary');
                $(this).addClass('btn-outline-success');

                url_ajax = `ajax/set_data_keranjang.php?id_user=${user_id}&id_produk=${get_prod_id}&item_keranjang_hapus=hapus`;
                console.log(url_ajax);

            }

            $.ajax({
                url: url_ajax,
                success: function(hasil) {
                    if (hasil.trim() != 'sukses') {
                        alert.hasil();
                    }
                }
            });

            $('#jumlah_item_keranjang').text(jumlah_item_keranjang);
        })

        // keranjang

        $('.qty').change(function() {
            const qty_id = $(this).prop('id');
            const split_str_to_arr = qty_id.split('__');
            const get_qty_id = split_str_to_arr[1];

            const harga_satuan = parseInt($('#harga__' + get_qty_id).text());
            const qty_products = $('#qty__' + get_qty_id).val();

            if (qty_products <= 0) {
                $('#qty__' + get_qty_id).val(1);
                return;
            }

            const jumlah_total = harga_satuan * qty_products;
            const total_bayar =

                $('#jumlah__' + get_qty_id).text(jumlah_total);

            let total_yang_dibayar = 0;

            $.each($('.qty'), function(index, value) {
                const qty_id = value.id;
                const split_str_to_arr = qty_id.split('__');
                const get_qty_id = split_str_to_arr[1];

                const total_harga_beli = parseInt($('#harga__' + get_qty_id).text());
                const jumlah_item_beli = $('#' + qty_id).val();

                total_yang_dibayar += jumlah_item_beli * total_harga_beli;

                // console.log(jumlah_item_beli, total_harga_beli, total_yang_dibayar);

                $("#total_yang_dibayar").text(total_yang_dibayar);
                console.log($("#hidden_input_total").val(total_yang_dibayar));
            })

        });

        // login.php

        if (window.location.search.includes('login')) {
            if (!$('#login_page').hasClass('d-none')) {

                $('#login_form').validate({
                    ignore: [],

                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: 'required'

                    },

                    messages: {
                        email: {
                            required: 'Email harus diisi',
                            email: 'Format email tidak valid'
                        },
                        password: 'Password harus diisi'

                    },

                    //element error berupa div
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        // Menyisipkan class invalid-feedback di element error
                        error.addClass("invalid-feedback");

                        if (element.prop("type") === "checkbox") {
                            error.insertAfter(element.parent("label"));
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    //menyisipkan class is-invalid pada element form yang valuenya error
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    //menyisipkan class is-valid pada element form yang valuenya sudah benar
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass("is-invalid");
                    }
                });

            }

        }

        $('#btn_daftar').on('click', function(event) {
            console.log('register form diproses')
            $('#register_form').validate({
                ignore: [],

                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    fullname: {
                        required: true,
                        minlength: 4
                    },
                    phone: {
                        required: true,
                        minlength: 10
                    }

                },

                messages: {
                    email: {
                        required: 'Email harus diisi',
                        email: 'Format email tidak valid'
                    },
                    password: {
                        required: 'Password harus diisi',
                        minlength: 'Password setidaknya harus 5 karakter.'
                    },
                    fullname: {
                        required: 'Nama Lengkap harus diisi',
                        minlength: 'Nama lengkap setidaknya harus 5 karakter.'
                    },
                    phone: {
                        required: 'Nomer Handphone harus diisi',
                        minlength: 'Pastikan nomer yang didaftarkan dapat dihubungi.'
                    }
                },

                //element error berupa div
                errorElement: "div",
                errorPlacement: function(error, element) {
                    // Menyisipkan class invalid-feedback di element error
                    error.addClass("invalid-feedback");

                    error.insertAfter(element);

                },
                //menyisipkan class is-invalid pada element form yang valuenya error
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                //menyisipkan class is-valid pada element form yang valuenya sudah benar
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            })
        })

        $('#btnAddNewProduct').on("click", function(event) {
            $('#addNewProduct').validate({
                ignore: [],

                rules: {
                    nama_produk: {
                        required: true,
                        minlength: 12
                    },
                    harga_satuan: {
                        required: true,
                        number: true,
                        minlength: 5
                    },
                    jumlah_produk: {
                        required: true,
                        number: true
                    },
                    gambar_produk: {
                        required: true,
                        accept: "image/*"
                    }
                },

                messages: {
                    nama_produk: {
                        required: 'Nama Produk harus diisi',
                        minlength: "Nama produk setidaknya 12 karakter, contoh 'Kopi Robusta' "
                    },
                    harga_satuan: {
                        required: 'Harga Produk harus diisi',
                        number: 'Gunakan angka untuk harga produk',
                        minlength: 'Harga Produk setidaknya 5 karakter',
                        min: 'Minimal harga satuan produk yang dijual adalah 20000'
                    },
                    jumlah_produk: {
                        required: 'Jumlah Produk harus diisi untuk mengetahui ketersediaan produk',
                        number: 'Gunakan angka untuk jumlah produk'
                    },
                    gambar_produk: {
                        required: 'Unggah file Gambar Produk untuk mengetahui produk yang dijual',
                        accept: 'Format gambar harus .jpg, .jpeg, dan .png'
                    },



                },
                //element error berupa div
                errorElement: "div",
                errorPlacement: function(error, element) {
                    // Menyisipkan class invalid-feedback di element error
                    error.addClass("invalid-feedback");

                    error.insertAfter(element);

                },
                //menyisipkan class is-invalid pada element form yang valuenya error
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                //menyisipkan class is-valid pada element form yang valuenya sudah benar
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });

        })
    </script>
</body>

</html>