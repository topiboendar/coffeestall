<header id="header" class="navbar-light bg-white border-bottom">
    <nav class="navbar navbar-expand-lg navbar-row col-md-11 col-lg-10 mx-auto">
        <h4 class="mb-0"><span class="font-weight-bold">Coffee</span> Stall</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBurger" aria-controls="navBurger" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navBurger">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class='nav-item'><a class='nav-link <?php echo $parameter == 'home' || $parameter == '' ? 'active' : '' ;?>' href='?'>Beranda</a></li>
                <li class='nav-item'><a class='nav-link' href='#product_container'>Produk</a></li>
                <li class='nav-item'><a class='nav-link' href='#about_us'>Tentang Kami</a></li>
                <?php
                echo $is_login ?
                 "
                    <li class='nav-item'><a class='nav-link position-relative pr-3 pt-0 mt-2' href='?keranjang'>Keranjang <span id='jumlah_item_keranjang' class='badge badge-pill badge-danger'>$jumlah_item_keranjang</span></a></li>
                    <li class='nav-item'><a class='nav-link'data-toggle='modal' data-target='#modalLogout' href='#'>Logout</a></li>
                
                " :
                "<li class='nav-item'><a class='nav-link border border-dark rounded-pill px-3 py-1 my-2 my-lg-0 ml-lg-3 font-weight-bold' style='font-size: 14px;' href='?login'>Login</a></li>"
                ?>
            </ul>
        </div>
    </nav>
</header>

<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin keluar ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" id="btn_logout" class="btn btn-primary" onclick="location.href='?logout';">Ya</button>
      </div>
    </div>
  </div>
</div>