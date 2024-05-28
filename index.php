<?php
    session_start();
    // session_destroy();
    // exit;

    include "conn.php";

    // routing path 
    $parameter = '';
    
    if(isset($_GET)){
        foreach ($_GET as $key => $value) {
            $parameter = $key;
        }
    }
    
    # ==================
    # HANDLE SESSION
    # ==================   
    
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';

    // session dummy
    // $_SESSION['coffeestall_email'] = 'asd@mail.com';


    $email = '';
    if(isset($_SESSION['coffeestall_email'])){
        $email = $_SESSION['coffeestall_email'];
    }

    include 'user_privilege.php';
    
    echo "Email yang aktif: $email<hr>
            <br>Nama user: $nama_user
            <br>Id role: $role_id
            <br>is_login: $is_login
            <br>alias: $alias
    
    
    ";
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
</head>

<body>
    <!-- header include by js -->
    <?php $parameter !== 'login' ? include 'pages/layouts/header.php' : '';?>
    <?php include 'routing.php'?>
    <?php $parameter !== 'login' ? include 'pages/layouts/footer.php' : '';?>
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="vendor/popper.js/dist/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="vendor/simple-pagination/jquery.simplePagination.js"></script>
    <script src="script.js"></script>
    <script>
        $(document).ready(function(){

            const pageContainer = document.createElement('div');
            pageContainer.setAttribute('id', 'page_container');
            pageContainer.classList.add('d-flex', 'justify-content-center', 'pt-4')
            
            $('#product_container').append(pageContainer);

            showProducts();
            
            setTimeout(() => {

                let cardItem = $('#product_row #prod_item')
                let productAvailable = cardItem.length;
                let productOnPage = 4;
                cardItem.slice(productOnPage).hide();
                
                $('#page_container').pagination({
                    
                    // total wrap in present
                    items: productAvailable,
                    // item allowed on single page
                    itemsOnPage: productOnPage,
                    // style
                    // cssStyle: "light-theme",

                    // this is pagination feature
                    onPageClick: function(pageNumber){
                        
                        let showForm = productOnPage * (pageNumber -1);
                        let showTo = showForm + productOnPage;

                        // hide everything
                        cardItem.hide()
                            // ...and then only show the rows
                            .slice(showForm, showTo).show();

                    }
                });
                
            }, 5000)

            $(".custom-file-input").on("change", function() {
                let fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
            
            priceTag();
        });
    </script>
</body>

</html>