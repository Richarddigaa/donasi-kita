
<?php

    if (isset($_GET['keyword'])) {
        $queryDonasi = "SELECT * FROM donasi WHERE judul LIKE '%$_GET[keyword]%'";
        $donasi = $this->db->query($queryDonasi)->result_array();
    }
    // get produk by kategori
    else if (isset($_GET['kategori'])) {
        $queryGETkategori = "SELECT id_kategori FROM kategori WHERE kategori='$_GET[kategori]'";
        $kategoriId = $this->db->query($queryGETkategori)->result_array();
    
        foreach ($kategoriId as $ki) { 
            $queryDonasi = "SELECT * FROM donasi WHERE id_kategori='$ki[id_kategori]'";
            $donasi = $this->db->query($queryDonasi)->result_array();
        }
    }
    // get produk default
    else {
        $queryDonasi = "SELECT * FROM donasi";
        $donasi = $this->db->query($queryDonasi)->result_array();
    }

    $countData = $this->db->query($queryDonasi)->num_rows();
?>

<div class="container py-5">
     <?php echo $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-3 mb-5">
            <h3>Kategori</h3>
            <ul class="list-group">
                <?php foreach ($kategori as $k) { ?>
                    <a href="<?= base_url('user/donasi?kategori=') . $k['kategori']; ?>" style="text-decoration: none;">
                        <li class="list-group-item"><?php echo $k['kategori']; ?></li>
                    </a>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <h3 class="text-center mb-3">Bantu Mereka Yang Membutuhkan</h3>
            <div class="row">
                <?php
                if ($countData < 1) {
                ?>
                    <h4 class="text-center my-5">Donasi Yang Anda Cari Tidak Tersedia</h4>
                <?php
                }
                ?>
                <?php foreach ($donasi as $d) { ?>
                    <div class="col-md-4 mb-4 ">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="<?= base_url('assets/img/upload/') . $d['gambar']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="fw-bolder"><?php echo $d['judul']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $d['detail']; ?></p>
                                <p class="card-text text-harga"><?= "Dana yang sudah terkumpul Rp. " . number_format($d['dana_terkumpul']); ?> </p>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('user/detailDonasi/') . $d['id']; ?>">Bantu Mereka</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
