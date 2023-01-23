<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INVENTORY - <?= $title ?? 'Dashboard' ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/assets/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
    <?= $this->renderSection('style') ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="sidebar-brand-text mx-3">INVENTORY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Master Data
            </div>

            <?php if(user('role') == 'admin') { ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengguna"
                    aria-expanded="true" aria-controls="pengguna">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pengguna</span>
                </a>
                <div id="pengguna" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-admin">Admin</a>
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-petugas">Petugas</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manajemen"
                    aria-expanded="true" aria-controls="manajemen">
                    <i class="fas fa-fw fa-cubes"></i>
                    <span>Manajemen Barang</span>
                </a>
                <div id="manajemen" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-supplier">Supplier</a>
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-customer">Customer</a>
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-rak">Rak</a>
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-jenis-barang">Jenis Barang</a>
                        <a class="collapse-item" href="<?= base_url() ?>/dashboard/list-satuan-barang">Satuan Barang</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Transaksi
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/dashboard/list-barang">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Stok Barang</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/dashboard/list-barang-masuk">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Barang Masuk</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/dashboard/list-barang-keluar">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Barang Keluar</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Menu
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/dashboard/laporan">
                    <i class="fas fa-fw fa-file-export"></i>
                    <span>Laporan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/dashboard/setting">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manajemen Settings</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user('name') ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url() ?>/assets/sb-admin-2/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?? 'Dashboard' ?></h1>
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; INVENTORY <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/assets/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/assets/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/assets/sb-admin-2/js/sb-admin-2.min.js"></script>
    <?= $this->renderSection('script') ?>
</body>

</html>