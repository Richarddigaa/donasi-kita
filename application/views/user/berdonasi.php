
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9"> 
            <?php foreach ($donasi as $d) { ?>
            <form action="<?= base_url('user/berdonasi/') . $d['id'] ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_donasi" value="<?= $d['id'] ?>">
                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                <div class="form-group row m-3"> 
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row m-3"> 
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $user['nama']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="judul_donasi" class="col-sm-2 col-form-label">Judul Donasi</label>
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control form-control-user" id="judul_donasi" name="judul_donasi" value="<?= $d['judul']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="dana" class="col-sm-2 col-form-label">Dana Yang Didonasikan</label>
                    <div class="col-sm-10"> 
                        <input type="number" class="form-control form-control-user" id="dana" name="dana" placeholder="Masukan Nominal" required>
                        <small class="text-danger"><?php echo form_error('dana'); ?></small>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="pembayaran" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                    <div class="col-sm-10">
                        <select name="pembayaran" class="form-control form-control-user">
                            <option value="">Pilih Metode Pembayaran</option>
                            <?php
                            foreach ($pembayaran as $p) { ?>
                                <option value="<?= $p['id_pembayaran']; ?>"><?= $p['nama_pembayaran'] . ' - No Rekening : ' . $p['rekening'] . ' An. Donasi Kita'; ?></option> 
                            <?php } ?>
                        </select>
                        <small class="text-danger"><?php echo form_error('pembayaran'); ?></small>
                    </div>
                </div>
                <div class="form-group row m-3">
                    <label for="gambar" class="col-sm-2 col-form-label">Silahkan Upload Bukti Transfer</label>
                    <div class="col-sm-10"> 
                        <input type="file" class="form-control form-control-user" id="gambar" name="gambar">
                    </div>
                </div>
                <div class="form-group row justify-content-end m-3">
                    <div class="col-sm-10"> 
                        <button type="submit" class="btn btn-primary">Kirim</button> 
                        <button class="btn btn-dark" onclick="window.history.go(-1)">Batal</button> 
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>