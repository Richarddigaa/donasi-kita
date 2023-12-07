
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>

<div class="py-5">
    <div class="container text-center">
        <h3>Tentang Kami</h3>
        <p class="fs-5 mt-3">
            PRIHATIN Cakery adalah bisnis menengah yang bergerak dalam industri kuliner, terutama dalam hal berbagai macam kue.
            PRIHATIN Cakery unggul dalam penjualan. dimana setiap langkah-langkah operasinya masih dilakukan secara manual untuk melayani pelanggannya dalam hal penjualan dan pembelian.
            Sistem informasi perusahaan ini sangat penting untuk memudahkan pelayanan dan mengefektifkan kinerja yang berkualitas terhadap pelanggan.
        </p>
    </div>
</div>

<?php 
    $queryDonasi = "SELECT * FROM donasi LIMIT 8";
    $donasi = $this->db->query($queryDonasi)->result_array();
?>

<section class="py-5">
    <div class="container text-center">
        <h3>Ayo Langsung Berdonasi</h3>
    </div>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($donasi as $d) { ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Donasi image-->
                    <img class="card-img-top" src="<?= base_url('assets/img/upload/') . $d['gambar']; ?>" alt="..." />
                    <!-- Donasi details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Donasi name-->
                            <h4 class="fw-bolder"><?= $d['judul']; ?></h4>
                            <p class="card-text text-truncate"><?= $d['detail']; ?> </p>
                            <p class="card-text text-harga"><?= "Dana yang sudah terkumpul Rp. " . number_format($d['dana_terkumpul'], 2, ',', '.'); ?> </p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('user/detailDonasi/') . $d['id']; ?>">Ayo Berdonasi</a></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
    

            