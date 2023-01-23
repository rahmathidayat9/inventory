<?= $this->extend('template') ?>

<?= $this->section('style') ?>
    <link href="<?= base_url() ?>/assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
                <div class="alert-stock"></div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <button type="button" class="btn btn-primary btn-sm" id="addBtn" data-toggle="modal" data-target="#formModal">
                        <i class="fas fa-plus fa-fw"></i> TAMBAH DATA
                    </button>
                    
                    <button type="button" class="btn btn-danger btn-sm" id="deleteAllBtn">
                        <i class="fas fa-trash fa-fw"></i> HAPUS DATA
                    </button>
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkbox-all" id="checkbox-all">
                                            <label class="custom-control-label" for="checkbox-all"></label>
                                        </div>
                                        </th>
                                        <th>Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Stok</th>
                                        <th>Rak</th>
                                        <th>Supplier</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Form -->
                <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Form Data</h5>
                        <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="submitForm">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="barang_name">Nama Barang:</label>
                                    <input type="hidden" name="type" id="type" value="insert" class="form-control">
                                    <input required type="hidden" name="barang_id" id="barang_id" class="form-control">
                                    <input required type="text" name="barang_name" id="barang_name" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="jenis_barang_id">Jenis Barang:</label>
                                    <select type="text" name="jenis_barang_id" id="jenis_barang_id" class="form-control">
                                        <option value="" disabled selected>- JENIS BARANG -</option>
                                        <?php foreach($jenis_barang as $jenis_barang) { ?>
                                            <option value="<?= $jenis_barang['id'] ?>"><?= $jenis_barang['jenis'] ?></option>    
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="barang_stock">Stok Barang:</label>
                                    <input required type="number" name="barang_stock" value="0" min="0" id="barang_stock" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="satuan_barang_id">Satuan Barang:</label>
                                    <select name="satuan_barang_id" id="satuan_barang_id" class="form-control">
                                        <option value="" disabled selected>- SATUAN BARANG -</option>
                                        <?php foreach($satuan_barang as $satuan_barang) { ?>
                                            <option value="<?= $satuan_barang['id'] ?>"><?= $satuan_barang['satuan'] ?></option>    
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rak_id">Rak:</label>
                                <select name="rak_id" id="rak_id" class="form-control">
                                    <option value="" disabled selected>- RAK -</option>
                                    <?php foreach($rak as $rak) { ?>
                                        <option value="<?= $rak['id'] ?>"><?= $rak['rak_name'] ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Supplier:</label>
                                <select required name="supplier_id" id="supplier_id" class="form-control">
                                    <option value="" disabled selected>- SUPPLIER -</option>
                                    <?php foreach($supplier as $supplier) { ?>
                                        <option value="<?= $supplier['id'] ?>"><?= $supplier['supplier_name'] ?></option>    
                                    <?php } ?>
                                </select>
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
        $("#deleteAllBtn").hide()

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
            ajax: '<?=  base_url() ?>/dashboard/list-barang',
            order: [],
            columnDefs: [
                { targets: 0, orderable: false},
                { targets: 1, orderable: false},
                { targets: 2, orderable: false},
                { targets: 3, orderable: false},
                { targets: 4, orderable: false},
                { targets: 5, orderable: false},
                { targets: 6, orderable: false},
            ],
        });

        $("#addBtn").click(function() {
            removeInputValues(['barang_id', 'barang_name', 'barang_stock', 'satuan_barang_id', 'jenis_barang_id', 'rak_id', 'supplier_id'])
            $("#type").val('insert')
            $("#barang_stock").prop('readonly', true)
            $("#barang_stock").val('0')
            $("#formModalLabel").html('Tambah Barang')
        })

        $(document).on("click", "#editBtn", function() {
            $("#formModalLabel").html('Edit Barang')
            $("#type").val('edit')
            let id = $(this).data('id')

            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/dashboard/edit-barang",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function (response) {
                    let barang = response.data
                    $("#formModal").modal('show')
                    $("#type").val('update')
                    $("#barang_id").val(barang.id)
                    $("#barang_name").val(barang.barang_name)
                    $("#barang_stock").prop('readonly', false)
                    $("#barang_stock").val(barang.barang_stock)
                    $("#satuan_barang_id").val(barang.satuan_barang_id)
                    $("#rak_id").val(barang.rak_id)
                    $("#jenis_barang_id").val(barang.jenis_barang_id)
                    $("#supplier_id").val(barang.supplier_id)
                }
            });
        })

        $("#submitForm").submit(function(e) {
            e.preventDefault()
            let type = $("#type").val()
            let url

            if (type == 'insert') {
                url = "<?= base_url() ?>/dashboard/insert-barang"
            } else {
                url = "<?= base_url() ?>/dashboard/update-barang"
            }
            
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (response) {
                    showToast('success', response.message, 300)
                    removeInputValues(['barang_id', 'barang_name', 'barang_stock', 'satuan_barang_id', 'jenis_barang_id','rak_id', 'supplier_id'])
                    $("#formModal").modal('hide')
                    $('.alert-stock').alert('close')
                    // datatable.ajax.reload()
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });
        })

        /* Delete CheckBox */
        let checked = []

        $(document).on('click', '#checkbox-all', function() {
            if ($(this).is(':checked')) {
                $("#deleteAllBtn").show()
                $('.checkbox').prop("checked", true)
            } else {
                $('.checkbox').prop("checked", false)
                $("#deleteAllBtn").hide()
            }
        })

        $(document).on('click', '.checkbox', function() {
            $("#dataTable .checkbox:checked").each(function(e) {
                checked.push($(this).val())
            })

            if (checked.length > 0) {
                $("#deleteAllBtn").show()
            } else {
                $("#deleteAllBtn").hide()
            }

            checked = []
        })

        $("#deleteAllBtn").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $("#dataTable .checkbox:checked").each(function(e) {
                        checked.push(`'${$(this).val()}'`)
                    })

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>/dashboard/delete-bulk-barang",
                        data: {
                            id: checked.join(',')
                        },
                        dataType: "JSON",
                        success: function (response) {
                            $("#deleteAllBtn").hide()
                            $('#checkbox-all').prop("checked", false)
                            showToast('success', response.message, 300)
                            datatable.ajax.reload()
                        }
                    });
                }
            })
        })

        $(document).on('click', '#deleteBtn', function() {
            let id = $(this).data('id')

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>/dashboard/delete-barang",
                        data: {
                            id: id,
                        },
                        dataType: "JSON",
                        success: function (response) {     
                            showToast('success', response.message, 300)
                            $('.alert-stock').alert('close')
                            datatable.ajax.reload()
                        }
                    });
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>