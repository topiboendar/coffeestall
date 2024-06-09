<?php
include_once 'conn.php';

if (isset($_POST['btn_login'])) {
    $sql_queries_login = "SELECT * FROM tbl_pengguna WHERE email = '$_POST[email]' AND password = '$_POST[password]' ";
    $result = mysqli_query($conn, $sql_queries_login) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) == 0) {
        echo "<div id='login_warning' class='p-2 position-absolute w-100' style='z-index: 1;'>
                    <div class='alert alert-warning w-100' role='alert'>
                        <strong>Email</strong> dan <strong>Password</strong> yang kamu ketikan salah, silahkan ulangi kembali.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                  </div>";
    } else {
        // set session
        $_SESSION['coffeestall_email'] = $_POST['email'];

        // reload
        die('<script>location.replace("?")</script>');
    }
}


?>
<div class="container-fluid h-100">
    <div id="login_page" class="row align-items-center h-100">
        <div class="col col-lg-5 h-100 w-100 d-none d-md-block pr-md-0">
            <div class="row h-100 w-100 bg-warning align-items-center justify-content-center">
                <h3><span class="font-weight-bold">Coffee</span> Stall</h3>
            </div>
        </div>
        <div class="col col-lg-7 pl-md-0">
            <div class="custom-element mx-lg-auto">
                <h3 class="font-weight-bold">Login</h3>
                <form id="login_form" method="post" class="mt-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" id="email" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Masukan alamat email yang terdaftar.</small>
                    </div>
                    <div class="form-group">
                        <label for="login_password">Password</label>
                        <input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" class="form-control" id="login_password">
                    </div>
                    <button id="login_btn" name="btn_login" type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="d-flex mt-3">
                    <p class="text-muted mr-1">Belum punya akun?</p>
                    <a id="register_now" href="#">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Register -->
    <?php include 'register.php' ?>

</div>
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('#register_now').click(function() {
            $('#login_page').addClass('d-none');
            $('#register_page').removeClass('d-none');
        });
        $('#login_now').click(function() {
            $('#login_page').removeClass('d-none');
            $('#register_page').addClass('d-none');
        });

        $('#login_form').on('submit', function(event) {
            if ($('#email').val().length || $('#login_password').val().length === 0) {
                $('#emailHelp').addClass('d-none');
            } else {
                $('#emailHelp').removeClass('d-none');
            }
        })

        setTimeout(() => {
            $('#login_warning').fadeOut();

        }, 4000);

        $('#register_form').on('submit', function(event) {
            if ($('#password_konfirmasi').val() != $('#regist_password').val()) {
                event.preventDefault();
                $('#password_konfirmasi').addClass('is-invalid');
            } else {
                $('#password_konfirmasi').removeClass('is-invalid');
            }

            // if(!$.isNumeric($('#phone').val())){
            //     event.preventDefault();
            //     $('#phone').addClass('is-invalid');
            // }else{
            //     $('#phone').removeClass('is-invalid');
            // }

        });
    });
</script>