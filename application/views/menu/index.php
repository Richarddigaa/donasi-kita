<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col-lg-6">

    <?= form_error('menu',  '<div class="alert alert-danger alert-message" role="alert">','</div>'); ?>

    <?= $this->session->flashdata('pesan'); ?>

        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">
            <i class="fas fa-fw fa-plus"></i>
            Tambah Menu
        </a>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach ($menu as $m) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $m['menu']; ?></td>
                    <td>
                        <a href=""><i class="fas fa-fw fa-edit m-1"></i></a>
                        <a href=""><i class="fas fa-fw fa-trash m-1" style="color: #ea1a4e;"></i></a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Menu</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="menu" class="form-control form-control-user">
                            <option value="">Pilih Kategori</option>
                            <?php $k = ['Sains', 'Hobby', 'Komputer', 'Komunikasi', 'Hukum', 'Agama', 'Populer', 'Bahasa', 'Komik'];
                            for ($i = 0; $i < 9; $i++) { ?>
                                <option value="<?= $k[$i]; ?>"><?= $k[$i]; ?></option>
                            <?php } ?>
                        </select>
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