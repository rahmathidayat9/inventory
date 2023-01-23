<?= $this->extend('template') ?>

<?= $this->section('style') ?>
    <link href="<?= base_url() ?>/assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-7">
                        <?php 
                            $session = \Config\Services::session();

                            if ($session->getFlashdata('error')) {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $session->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php }?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Awal:</label>
                                    <input type="date" name="tgl_awal" id="tgl_awal"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Akhir:</label>
                                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                                </div>
                            </div>
                        </div>

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Stok Barang
                            <div class="row ekspor">
                                <a href="" target="_blank" class="btn-ekspor badge badge-danger badge-pill ml-3" data-tipe="barang">Ekspor</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Barang Masuk
                            <div class="row ekspor">
                                <a href="" target="_blank" class="btn-ekspor badge badge-danger badge-pill ml-3" data-tipe="barang-masuk">Ekspor</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Barang Keluar
                            <div class="row ekspor">
                                <a href="" target="_blank" class="btn-ekspor badge badge-danger badge-pill ml-3" data-tipe="barang-keluar">Ekspor</a>
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/sb-admin-2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready( function () {
        toastr.options.closeDuration = 300;

        $('.btn-ekspor').click(function (e) { 
            e.preventDefault();
            
            let tgl_awal = $("#tgl_awal").val()
            let tgl_akhir = $("#tgl_akhir").val()
            let tipe = $(this).data('tipe')
            
            if (tgl_awal.length == 0) {
                toastr.error('Pilih tanggal awal & tanggal akhir terlebih dahulu!')
                return false;
            } else if(tgl_akhir.length == 0) {
                toastr.error('Pilih tanggal awal & tanggal akhir terlebih dahulu!')
                return false;
            }

            let ekspor_url = '<?= base_url() ?>/dashboard/ekspor-pdf?data='+tipe+'&tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir
            window.open(ekspor_url, '_blank')
        });
    });
</script>
<?= $this->endSection() ?>