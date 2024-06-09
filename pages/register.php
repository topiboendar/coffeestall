<?php

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    if(isset($_POST['btn_daftar_akun'])){
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $password_konfirmasi = $_POST['password_konfirmasi'];

        // akun yang didaftarkan otomatis terdaftar sebagai pembeli
        $sql_query_account = "INSERT INTO 
                                tbl_pengguna (email, nomer_hape, password, role_id, nama_lengkap) 
                                VALUES ('$email', '$phone', '$password', '2', '$fullname')";

        if(mysqli_query($conn, $sql_query_account)){
            echo "
            <div class='modal fade' id='infoNewAccountSuccess' tabindex='-1' aria-labelledby='infoNewAccountSuccessLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='infoNewAccountSuccessLabel'>Notifikasi</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <p>Akun berhasil didaftarkan, silahkan login.<p>
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
                $('#infoNewAccountSuccess').modal('show');
            </script>";
        } else {
            echo "Error: " . $sql_query_account . "<br>" . mysqli_error($conn);
        }
    }

?>
<div id="register_page" class="row align-items-center h-100 d-none">
    <div class="col col-lg-5 h-100 w-100 d-none d-md-block pr-md-0">
        <div class="row h-100 w-100 bg-warning align-items-center justify-content-center">
            <h3><span class="font-weight-bold">Coffee</span> Stall</h3>
        </div>
    </div>
    <div class="col col-lg-7 pl-md-0">
        <div class="custom-element mx-lg-auto">
            <h3 class="font-weight-bold">Daftar Sekarang</h3>
            <form id="register_form" class="mt-4" method="post">
                
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="fullnameGuide">
                    <small id="fullnameGuide" class="form-text text-muted">Masukan nama lengkap anda.</small>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="regist_password">Password</label>
                            <input type="password" class="form-control" id="regist_password" name="password">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="password_konfirmasi">Konfirmasi Password</label>
                            <input type="password" id="password_konfirmasi" name="password_konfirmasi" class="form-control" requried>
                            <div class='invalid-feedback'>Password yang diinputkan tidak sama</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <small class="text-muted">Jangan membagikan data akun pribadi anda kepada orang lain.</small>
                </div>
                <button id="btn_daftar" name="btn_daftar_akun" type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
            <div class="d-flex mt-3">
                <p class="text-muted mr-1">Sudah punya akun?</p>
                <a id="login_now" href="#">Login</a>
            </div>
        </div>
    </div>
</div>