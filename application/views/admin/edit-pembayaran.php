    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ubah Metode Pembayaran</h4>
                    <form action="<?= base_url('admin/edit_pembayaran/' . $data->id_pembayaran) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" name="pembayaran" value="<?php echo $data->nama_pembayaran; ?>" required />
                            <small class="text-danger"><?php echo form_error('pembayaran'); ?></small>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="rekening" value="<?php echo $data->rekening; ?>" required />
                            <small class="text-danger"><?php echo form_error('rekening'); ?></small>
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