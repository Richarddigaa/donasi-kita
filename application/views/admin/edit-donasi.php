    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    

    <?php 
        foreach ($donasi as $d) {
            $queryDonasi = "SELECT * FROM donasi JOIN kategori ON donasi.id_kategori = kategori.id_kategori WHERE donasi.id = $d[id]";
            $donasi = $this->db->query($queryDonasi)->result_array();
        }
    ?>

    <?php foreach ($donasi as $d) { ?>
        
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Donasi</h4>

                    
                    <form action="<?= base_url('admin/ubahDonasi/') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                        <input type="hidden" name="dana_terkumpul" value="<?= $d['dana_terkumpul'] ?>">
                        <input type="text" name="old_pict" value="<?= $d['gambar'] ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="donasi" name="donasi" value="<?= $d['judul'] ?>">
                        </div>
                        <div class="form-group">
                            <select name="kategori" class="form-control form-control-user">
                                <option value="<?= $d['id_kategori']; ?>"><?= $d['kategori']; ?></option>
                                <?php
                                foreach ($kategori as $k) { ?>
                                    <option value="<?= $k['id_kategori']; ?>"><?= $k['kategori']; ?></option> <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="dana_dibutuhkan" name="dana_dibutuhkan" value="<?= $d['dana_dibutuhkan'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="detail" id="detail" value="<?= $d['detail'] ?>"></input>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" id="gambar" name="gambar">
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary mr-2"> Simpan </button>
                            <button class="btn btn-light" onclick="goBack()">Batal</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->