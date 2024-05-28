<?php
    include_once 'conn.php';

    if(isset($_POST['btn_login'])){
        $sql_queries_login = "SELECT * FROM tbl_pengguna WHERE email = '$_POST[email]' AND password = '$_POST[password]' ";
        $result = mysqli_query($conn, $sql_queries_login) or die(mysqli_error($conn));
        
        if(mysqli_num_rows($result) == 0){
            echo 'Silahkan periksa kembali email dan password anda,';
        } else {
            // set session
            $_SESSION['coffeestall_email'] = $_POST['email'];
            
            // reload
            die('<script>location.replace("?")</script>');
        }
        
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CoffeeStall</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        html,
        body{
            height: 100%;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
        @media screen and (min-width: 1180px) {
            .custom-element{
                max-width: 500px;
            }
        }
    </style>
</head>
<body>
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
                    <form method="post" class="mt-4">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                          <small id="emailHelp" class="form-text text-muted">Masukan alamat email yang terdaftar.</small>
                        </div>
                        <div class="form-group">
                          <label for="login_password">Password</label>
                          <input type="password" name="password" class="form-control" id="login_password">
                        </div>
                        <div class="form-group form-check">
                          <input type="checkbox" class="form-check-input" id="rememberme">
                          <label class="form-check-label" for="rememberme">Remember Me</label>
                        </div>
                        <button name="btn_login" type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="d-flex mt-3">
                        <p class="text-muted mr-1">Belum punya akun?</p>
                        <a id="register_now" href="#">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register -->
        <?= include 'register.php'?>
        
    </div>
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#register_now').click(function(){
                $('#login_page').addClass('d-none');
                $('#register_page').removeClass('d-none');
            });
            $('#login_now').click(function(){
                $('#login_page').removeClass('d-none');
                $('#register_page').addClass('d-none');
            });

            $('#register_form').on('submit', function(event){
                if($('#password_konfirmasi').val() != $('#regist_password').val()){
                    event.preventDefault();
                    $('#password_konfirmasi').addClass('is-invalid');
                }else{
                    $('#password_konfirmasi').removeClass('is-invalid');
                }
                
                if(!$.isNumeric($('#phone').val())){
                    event.preventDefault();
                    $('#phone').addClass('is-invalid');
                }else{
                    $('#phone').removeClass('is-invalid');
                }

            });
        });
    </script>
</body>
</html>