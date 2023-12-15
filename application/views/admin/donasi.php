    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                <?php echo $this->session->flashdata('pesan'); ?>

                <?= form_error('donasi', '<div class="alert alert-danger alert-message" role="alert">','</div>'); ?>

                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDonasiModal">
                    <i class="fas fa-fw fa-plus mr-2"></i>Tambah Donasi
                </a>

                <?php 
                $queryDonasi = "SELECT * FROM donasi JOIN kategori ON donasi.id_kategori = kategori.id_kategori";
                $donasi = $this->db->query($queryDonasi)->result_array();
                ?>

                    <div class="widget">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Dana Yang Dibutuhkan</th>
                                        <th scope="col">Dana Yang Terkumpul</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($donasi as $d) : ?>
                                    <tr>
                                        <td scope="row"><?php echo $i . '.'; ?></td>
                                        <td><span><?php echo $d['judul']; ?></span></td>
                                        <td><span><?php echo $d['kategori']; ?></span></td>
                                        <td><?php echo "Rp. " . number_format($d['dana_dibutuhkan'], 2, ',', '.'); ?></td>
                                        <td><?php echo "Rp. " . number_format($d['dana_terkumpul'], 2, ',', '.'); ?></td>
                                        <td><?php echo $d['detail']; ?></td>
                                        <td>
                                            <picture>
                                                <source srcset="" type="image/svg+xml"> <img src="<?= base_url('assets/img/upload/') . $d['gambar']; ?>" class="img-fluid img-thumbnail" alt="...">
                                            </picture>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/ubahDonasi/') . $d['id']; ?>" class="btn btn-primary mr-2 mb-2"><i class="far fa-fw fa-edit mr-2"></i>Edit</a>
                                            <a href="<?php echo base_url('admin/hapusDonasi/') . $d['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $d['judul']; ?> ?');" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-2"></i>Hapus</a>
                                        </td>
                                    </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="newDonasiModal" tabindex="-1" role="dialog" aria-labelledby="newDonasiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDonasiModalLabel">Tambah Donasi</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <form action="<?= base_url('admin/donasi'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="donasi" name="donasi" placeholder="Masukkan Judul Donasi">
                    </div>
                    <div class="form-group">
                        <select name="kategori" class="form-control form-control-user">
                            <option value="">Pilih Kategori</option>
                            <?php
                            foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['kategori']; ?></option> <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="dana_dibutuhkan" name="dana_dibutuhkan" placeholder="Masukkan Dana Yang Dibutuhkan">
                    </div>
                    <div class="form-group">
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control form-control-user" placeholder="Masukkan Detail Donasi"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="gambar" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>