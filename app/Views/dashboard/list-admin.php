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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone</th>
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
                                <label for="name">Nama:</label>
                                <input type="hidden" name="type" id="type" value="insert" class="form-control">
                                <input type="hidden" name="role_id" value="966dde03-c90e-42aa-b218-001a02c76385" id="role_id" class="form-control">
                                <input required type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input required type="hidden" name="user_id" id="user_id" class="form-control">
                                <input required type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input required type="hidden" name="now_password" id="now_password" class="form-control">
                                <input required type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telepon:</label>
                                <input required type="text" name="phone" id="phone" class="form-control">
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
            ajax: '<?=  base_url() ?>/dashboard/list-admin',
            order: [],
            columnDefs: [
                { targets: 0, orderable: false},
                { orderable: false, targets: 3 },
                { orderable: false, targets: 4 },
            ]
        });

        $("#addBtn").click(function() {
            removeInputValues(['user_id', 'name', 'username', 'now_password', 'password', 'phone'])
            $("#type").val('insert')
            $("#password").prop('required', true)
            $("#formModalLabel").html('Tambah Data')
        })

        $(document).on("click", "#editBtn", function() {
            $("#formModalLabel").html('Edit Data')
            $("#type").val('edit')
            $("#password").prop('required', false)
            let id = $(this).data('id')

            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/dashboard/edit-user",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function (response) {
                    let user = response.data
                    $("#formModal").modal('show')
                    $("#user_id").val(user.id)
                    $("#name").val(user.name)
                    $("#username").val(user.username)
                    $("#now_password").val(user.password)
                    $("#phone").val(user.phone)
                }
            });
        })

        $("#submitForm").submit(function(e) {
            e.preventDefault()
            let type = $("#type").val()
            let url

            if (type == 'insert') {
                url = "<?= base_url() ?>/dashboard/insert-user"
            } else {
                url = "<?= base_url() ?>/dashboard/update-user"
            }
            
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (response) {
                    showToast('success', response.message, 300)
                    removeInputValues(['user_id', 'name', 'username', 'now_password', 'password', 'phone'])
                    $("#formModal").modal('hide')
                    datatable.ajax.reload()
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
                        url: "<?= base_url() ?>/dashboard/delete-bulk-user",
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
                        url: "<?= base_url() ?>/dashboard/delete-user",
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