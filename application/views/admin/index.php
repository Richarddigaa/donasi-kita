

        

        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2 bg-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                    Kategori
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-white">
                                    <?= $totalKategori; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('admin/kategori'); ?>">
                                    <i class="fas fa-bars fa-3x text-warning"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                    Donasi
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-white">
                                    <?= $totalDonasi; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('admin/donasi'); ?>">
                                    <i class="fas fa-donate fa-3x text-primary"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                    Metode Pembayaran
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-white">
                                    <?= $totalPembayaran; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('admin/pembayaran'); ?>">
                                    <i class="fas fa-wallet fa-3x text-danger"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-danger">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                                    Riwayat Donasi
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-white">
                                    <?= $totalRiwayat; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('admin/riwayatDonasi'); ?>">
                                    <i class="fas fa-clipboard-check fa-3x text-success"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

            