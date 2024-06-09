<div class="modal fade" tabindex="-1" id="btnAddProduct">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">tambah produk baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewProduct" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nameProduct">Nama Produk</label>
                        <input type="text" class="form-control" minlength="10" maxlength="40" id="nameProduct" name="nama_produk">
                        <small class="form-text text-muted">Masukan 10 s.d 30 huruf, tanpa special karakter.</small>
                    </div>
                    <div class="form-group">
                        <label for="descriptionProduk">Deskripsi Produk</label>
                        <textarea class="form-control" name="deskripsi_produk" id="descriptionProduk"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="priceProduct">Harga Satuan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" id="priceProduct" name="harga_satuan" min="20000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qtyProduct">Jumlah Produk</label>
                        <input type="number" class="form-control" id="qtyProduct" name="jumlah_produk">
                    </div>
                    <div class="form-group custom-file">
                        <label for="gambarProduk" class="custom-file-label">Pilih file...</label>
                        <input type="file" Class="custom-file-input" name="gambar_produk" id="gambarProduk" accept=".jpg, .jpeg, .png">
                        <small class="text-black-50 font-italic">Upload foto produk dengan format .jpg, .jpeg, .png</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button id="btnAddNewProduct" form="addNewProduct" name="btn_simpan" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>