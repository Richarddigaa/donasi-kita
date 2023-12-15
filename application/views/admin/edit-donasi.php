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
                        <input type="hidden" name="old_pict" value="<?= $d['gambar'] ?>">
                        <div class="form-group">
                            <label for="donasi" class="col-sm-2 col-form-label">Judul Donasi</label>
                            <input type="text" class="form-control form-control-user" id="donasi" name="donasi" value="<?= $d['judul'] ?>">
                            <small class="text-danger"><?php echo form_error('donasi'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <select name="kategori" class="form-control form-control-user">
                                <option value="<?= $d['id_kategori']; ?>"><?= $d['kategori']; ?></option>
                                <?php
                                foreach ($kategori as $k) { ?>
                                    <option value="<?= $k['id_kategori']; ?>"><?= $k['kategori']; ?></option> <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dana_dibutuhkan" class="col-sm-2 col-form-label">Dana Yang Dibutuhkan</label>
                            <input type="number" class="form-control form-control-user" id="dana_dibutuhkan" name="dana_dibutuhkan" value="<?= $d['dana_dibutuhkan'] ?>">
                            <small class="text-danger"><?php echo form_error('dana_dibutuhkan'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="dana_terkumpul" class="col-sm-2 col-form-label">Dana Yang Terkumpul</label>
                            <input type="number" class="form-control form-control-user" id="dana_terkumpul" name="dana_terkumpul" value="<?= $d['dana_terkumpul'] ?>">
                            <small class="text-danger"><?php echo form_error('dana_terkumpul'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="detail" class="col-sm-2 col-form-label">Detail Donasi</label> 
                            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control form-control-user">
                                <?= $d['detail'] ?>
                            </textarea>
                            <small class="text-danger"><?php echo form_error('detail'); ?></small>
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