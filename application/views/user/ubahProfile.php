
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9"> 
            <?= form_open_multipart('user/ubahProfile'); ?> 
                <div class="form-group row m-3"> 
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10"> <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= $user['email']; ?>" readonly> </div>
                </div>
                <div class="form-group row m-3"> <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10"> <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $user['nama']; ?>"> <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?> </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-2">Gambar</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="img-thumbnail" alt="">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file"> 
                                    <input type="file" class="form-control form-control-user" id="image" name="image"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end m-3">
                    <div class="col-sm-10"> 
                        <button type="submit" class="btn btn-primary">Ubah</button> 
                        <button class="btn btn-dark" onclick="window.history.go(-1)"> Kembali</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>