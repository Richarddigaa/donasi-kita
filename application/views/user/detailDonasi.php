<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
        <?php foreach ($donasi as $d) { ?>
            <div class="col-lg-5 md-5">
                <img src="<?= base_url('assets/img/upload/') . $d['gambar']; ?>" class="w-100" alt="...">
            </div>
            <div class="col-lg-6 offset-lg-1">
                <h1><?php echo $d['judul']; ?></h1>
                <p class="fs-5">
                    <?php echo $d['detail']; ?>
                </p>
                <p class="text-harga">
                    <?= "Dana yang dibutuhkan Rp. " . number_format($d['dana_dibutuhkan']); ?>
                </p>    
                <p class="text-harga">
                    <?= "Dana yang sudah terkumpul Rp. " . number_format($d['dana_terkumpul']); ?>
                </p>
                <a class="btn btn-outline-dark mt-auto" href="<?= base_url('user/detailDonasi/') . $d['id']; ?>">Bantu Mereka</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>