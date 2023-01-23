<?= $this->extend('template') ?>

<?= $this->section('style') ?>
    <link href="<?= base_url() ?>/assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
                                        <th>Qty</th>
                                        <th>Tanggal</th>
                                        <th>Petugas</th>
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
                                    <label for="rak_id">Rak:</label>
                                    <select required name="rak_id" id="rak_id" class="form-control">
                                        <option value="" disabled selected>- RAK -</option>
                                        <?php foreach($rak as $rak) { ?>
                                            <option value="<?= $rak['id'] ?>"><?= $rak['rak_name'] ?></option>    
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="barang_name">Barang:</label>
                                    <input required type="hidden" name="barang_keluar_id" id="barang_keluar_id" class="form-control">
                                    <select required name="barang_id" id="barang_id" class="form-control">
                                        <option value="" disabled selected>- BARANG -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="barang_stock">Stok Barang:</label>
                                    <input required type="text" readonly name="barang_stock" id="barang_stock" class="form-control">
                                    <span class="barang-stock-feedback invalid-feedback"></span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="qty">Qty: <span id="satuan_barang"></span></label>
                                    <input required type="number" min="1" name="qty" id="qty" class="form-control">
                                    <span class="qty-feedback invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_id">Customer Tujuan:</label>
                                <select required name="customer_id" id="customer_id" class="form-control">
                                    <option value="" disabled selected>- CUSTOMER -</option>
                                    <?php foreach($customer as $customer) { ?>
                                        <option value="<?= $customer['id'] ?>"><?= $customer['customer_name'] ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tanggal:</label>
                                <input required type="text" readonly value="<?= date('Y-m-d') ?>" name="tgl" id="tgl" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan:</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="2"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Close</button>
                        <button type="submit" id="saveBtn" class="btn btn-primary">Save</button>
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
            ajax: '<?=  base_url() ?>/dashboard/list-barang-keluar',
            order: [],
            columnDefs: [
                { targets: 0, orderable: false},
                { targets: 1, orderable: false},
                { targets: 2, orderable: false},
                { targets: 3, orderable: false},
                { targets: 4, orderable: false},
                { targets: 5, orderable: false},
                { targets: 6, orderable: false},
            ]
        });

        /* Filter Barang Of Supplier */
        $("#rak_id").change(function() {
            let rak_id = $(this).val()
            let rak_name = $(this).find(':selected').text()

            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/dashboard/barang-rak-filter",
                data: {
                  rak_id: rak_id  
                },
                dataType: "JSON",
                success: function (response) {
                    let result = response.data
                    let list_barang = "<option disabled selected>- BARANG -</option>"
                    
                    if (result.length > 0) {
                        $.each(result, function(index, value) {
                            list_barang += `<option data-stock="${value.barang_stock}" data-satuan="${value.satuan}" value="${value.id}">${value.barang_name}</option>`
                        })   
                    } else {
                        $("#satuan_barang").html('')
                        list_barang = `<option disabled selected>Tidak ada barang di ${rak_name}!</option>`
                    }

                    $("#barang_id").html(list_barang)
                }
            });
        })

        /* Filter Qty Of Barang */
        $("#barang_id").change(function() {
            let satuan = $(this).find(':selected').attr('data-satuan')
            let barang_stock = $(this).find(':selected').attr('data-stock')

            /* Validasi stock */
            $(".barang-stock-feedback").html('')
            $("#barang_stock").removeClass('is-invalid')
            $("#saveBtn").prop('disabled', false)

            if (barang_stock < 1) {
                $(".barang-stock-feedback").html('Stock kosong , silahkan pilih barang lain!')
                $("#barang_stock").addClass('is-invalid')
                $("#saveBtn").prop('disabled', true)
            }

            $("#barang_stock").val(`${barang_stock}`)
            $("#satuan_barang").html(`(${satuan})`)
        })

        $("#addBtn").click(function() {
            removeInputValues(['barang_keluar_id', 'barang_id', 'customer_id', 'rak_id', 'qty', 'keterangan'])
            $("#tgl").val("<?= date('Y-m-d') ?>")
            $("#formModalLabel").html('Barang Keluar')
            $("#satuan_barang").html(``)
            $("#barang_id").html('')
            $("#barang_stock").val(``)
            $("#barang_id").html("<option disabled selected>- BARANG -</option>")
            $("#saveBtn").show()
            $("#rak_id").prop('disabled', false)
            $("#barang_id").prop('disabled', false)
            $("#qty").prop('disabled', false)
            $("#customer_id").prop('disabled', false)
            $("#keterangan").prop('disabled', false)
            $("#keterangan").val('-')
            $(".barang-stock-feedback").html('')
            $("#barang_stock").removeClass('is-invalid')
            $("#saveBtn").prop('disabled', false)
        })
        
        $(document).on("click", "#detailBtn", function() {
            $("#formModalLabel").html('Detail Info')
            $("#saveBtn").hide()
            $(".barang-stock-feedback").html('')
            $("#barang_stock").removeClass('is-invalid')
            $("#saveBtn").prop('disabled', false)
            
            let id = $(this).data('id')

            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/dashboard/detail-barang-keluar",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function (response) {
                    let barang_keluar = response.data
                    $("#formModal").modal('show')
                    $("#barang_keluar_id").val(barang_keluar.id)
                    $("#rak_id").val(barang_keluar.rak_id)
                    $("#qty").val(barang_keluar.qty)
                    $("#customer_id").val(barang_keluar.customer_id)
                    $("#keterangan").val(barang_keluar.keterangan)
                    $("#tgl").val(barang_keluar.tanggal)

                    $("#rak_id").prop('disabled', true)
                    $("#barang_id").prop('disabled', true)
                    $("#qty").prop('disabled', true)
                    $("#customer_id").prop('disabled', true)
                    $("#keterangan").prop('disabled', true)

                    $.ajax({
                        type: "GET",
                        url: "<?= base_url() ?>/dashboard/barang-rak-filter",
                        data: {
                            rak_id: barang_keluar.rak_id  
                        },
                        dataType: "JSON",
                        success: function (response) {
                            let data = response.data
                            let list_barang = "<option disabled selected>- BARANG -</option>"
                            
                            if (data.length > 0) {
                                $.each(data, function(index, value) {
                                    list_barang += `<option data-stock="${value.barang_stock}" data-satuan="${value.satuan}" value="${value.id}">${value.barang_name}</option>`
                                })   
                            } else {
                                $("#satuan_barang").html('')
                                list_barang = `<option disabled selected>Barang Tidak Tersedia!</option>`
                            }

                            $("#barang_id").html(list_barang)
                            $("#barang_id").val(barang_keluar.barang_id)
                            let satuan = $("#barang_id").find(':selected').attr('data-satuan')
                            let barang_stock = $("#barang_id").find(':selected').attr('data-stock')
                            
                            $("#barang_stock").val(`${barang_stock}`)
                            $("#satuan_barang").html(`(${satuan})`)
                        }
                    });
                }
            });
        })
        
        $("#qty").keyup(function() {
            let barang_stock = parseInt($("#barang_stock").val())
            let qty = parseInt($(this).val())

            $(".qty-feedback").html('')
            $("#qty").removeClass('is-invalid')
            $("#saveBtn").prop('disabled', false)

            if (qty > barang_stock) {
                $(".qty-feedback").html('Qty melebihi stok!')
                $("#qty").addClass('is-invalid')
                $("#saveBtn").prop('disabled', true)
            } else if (qty < 1) {
                $(".qty-feedback").html('Qty minimal 1!')
                $("#qty").addClass('is-invalid')
                $("#saveBtn").prop('disabled', true)
            }
        })

        $("#submitForm").submit(function(e) {
            e.preventDefault()

            let type = $("#type").val()
            let url
            
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/dashboard/insert-barang-keluar",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (response) {
                    showToast('success', response.message, 300)
                    removeInputValues(['barang_keluar_id', 'barang_id', 'customer_id', 'rak_id', 'qty', 'keterangan'])
                    $("#formModal").modal('hide')
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
                        url: "<?= base_url() ?>/dashboard/delete-bulk-barang-keluar",
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
                        url: "<?= base_url() ?>/dashboard/delete-barang-keluar",
                        data: {
                            id: id,
                        },
                        dataType: "JSON",
                        success: function (response) {     
                            showToast('success', response.message, 300)
                            datatable.ajax.reload()
                        }
                    });
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>