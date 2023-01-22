<?= $this->extend('template') ?>

<?= $this->section('style') ?>
    <link href="<?= base_url() ?>/assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
                <div class="row">
                <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
                    </div>
                    <form id="updateProfil">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap*:</label>
                            <input type="text" value="<?= user('name') ?>" value="" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username*:</label>
                            <input type="text" value="<?= user('username') ?>" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">No Hp:</label>
                            <input type="text" value="<?= user('phone') ?>" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: <small>(kosongkan jika tidak ingin mengubah password)</small></label>
                            <input type="hidden" readonly value="<?= user('password') ?>" name="now_password" id="now_password" class="form-control">
                            <input type="password" name="new_password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save fa-fw"></i> SAVE
                        </button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>    
                
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus fa-fw"></i> GENERATE BULAN
                        </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Form -->
                <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Form Data</h5>
                        <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="submitForm">
                            <div class="form-group">
                                <label for="bulan">Bulan:</label>
                                <input required type="hidden" name="bulan_id" id="bulan_id" class="form-control">
                                <input required type="text" name="bulan" id="bulan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no">No Bulan:</label>
                                <input required readonly name="no" id="no" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                    </div>
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
        function removeInputValues(params) {
            params.forEach(function(value, index) {
                $(`[name="${value}"]`).val('')
            })
        }

        function showToast(type = 'success', message, duration = 300) { 
            toastr.options.closeDuration = duration;
            
            switch (type) {
                case 'success':
                    toastr.success(message)
                break
                case 'error':
                    toastr.error(message)
                break
                default:
                    toastr.remove()
                break
            }
        }
        
        let datatable = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 12,
            lengthChange: false,
            ajax: '<?=  base_url() ?>/dashboard/setting',
            order: [],
            columnDefs: [
                { targets: 0, orderable: false},
                { orderable: false, targets: 1 },
            ]
        });

        $(document).on("click", "#editBtn", function() {
            $("#formModalLabel").html('Edit Bulan')
            let id = $(this).data('id')

            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/dashboard/edit-bulan",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function (response) {
                    let rak = response.data
                    $("#formModal").modal('show')
                    $("#bulan_id").val(rak.id)
                    $("#bulan").val(rak.bulan)
                    $("#no").val(rak.no)
                }
            });
        })

        $("#submitForm").submit(function(e) {
            e.preventDefault()
            
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/dashboard/update-bulan",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (response) {
                    showToast('success', response.message, 300)
                    removeInputValues(['bulan_id', 'bulan', 'no'])
                    $("#formModal").modal('hide')
                    datatable.ajax.reload()
                }
            });
        })

        /* Update Profil */
        $("#updateProfil").submit(function(e) {
            e.preventDefault()
            
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/dashboard/update-profil",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (response) {
                    showToast('success', response.message, 300)
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });
        })
    });
</script>
<?= $this->endSection() ?>