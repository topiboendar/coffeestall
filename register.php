<?php

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    if(isset($_POST['btn_daftar_akun'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $password_konfirmasi = $_POST['password_konfirmasi'];

        // akun yang didaftarkan otomatis terdaftar sebagai pembeli
        $sql_query_account = "INSERT INTO 
                                tbl_role (username, password, id_role, fullname) 
                                VALUES ('$username', '$password', '2', '$fullname')";

        if(mysqli_query($conn, $sql_query_account)){
            echo "Data berhasil di inputkan";
        } else {
            echo "Error: " . $sql_query_account . "<br>" . mysqli_error($conn);
        }
    }

?>

<div id="register_page" class="row align-items-center h-100">
    <div class="col col-lg-5 h-100 w-100 d-none d-md-block pr-md-0">
        <div class="row h-100 w-100 bg-warning align-items-center justify-content-center">
            <h3><span class="font-weight-bold">Coffee</span> Stall</h3>
        </div>
    </div>
    <div class="col col-lg-7 pl-md-0">
        <div class="custom-element mx-lg-auto">
            <h3 class="font-weight-bold">Daftar Sekarang</h3>
            <form id="register_form" class="mt-4" method="post">
                <div class="form-group">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="fullnameGuide" required>
                    <small id="fullnameGuide" class="form-text text-muted">Masukan nama lengkap anda.</small>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="regist_password">Password</label>
                            <input type="password" class="form-control" id="regist_password" name="password" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="password_konfirmasi">Konfirmasi Password</label>
                            <input type="password" id="password_konfirmasi" name="password_konfirmasi" class="form-control" requried>
                            <div id='validationInfoFeedback' class='invalid-feedback'>Password yang diinputkan tidak sama</div>
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