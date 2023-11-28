    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Kategori</h4>
                    <form action="<?= base_url('admin/edit_kategori/' . $data->id) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" name="kategori" value="<?php echo $data->kategori; ?>" placeholder="" required />
                            <small class="text-danger"><?php echo form_error('kategori'); ?></small>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary mr-2"> Simpan </button>
                            <button class="btn btn-light" onclick="goBack()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->