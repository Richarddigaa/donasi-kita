    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <?php echo $this->session->flashdata('pesan'); ?>

                    <?= form_error('kategori', '<div class="alert alert-danger alert-message" role="alert">','</div>'); ?>

                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategoriModal">
                        <i class="fas fa-fw fa-plus mr-2"></i>Tambah Kategori
                    </a>
                    <div class="widget">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kategori as $k) : ?>
                                    <tr>
                                        <td scope="row"><?php echo $i . '.'; ?></td>
                                        <td><span><?php echo $k['kategori']; ?></span></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin/edit_kategori/<?php echo $k['id']; ?>" class="btn btn-primary mr-2"><i class="far fa-fw fa-edit mr-2"></i>Edit</a>
                                            <a href="<?php echo base_url(); ?>admin/hapus_kategori/<?php echo $k['id']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-2"></i>Hapus</a>
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

<div class="modal fade" id="newKategoriModal" tabindex="-1" role="dialog" aria-labelledby="newKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKategoriModalLabel">Tambah kategori</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <form action="<?= base_url('admin/kategori'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="kategori" name="kategori" placeholder="Masukkan Kategori">
                        </div>
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