<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link">
        <!-- <img src="<?= base_url(); ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <i class="fas fa-code ml-3 mr-2"></i>
        <span class="brand-text font-weight-light font-weight-bold">E-Arsip</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/dist/img/' . session()->get('foto_user')); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('nama_user'); ?><br>
                    <?php if (session()->get('level') == "1") : ?>
                        <span>Login sebagai, Admin</span>
                    <?php else : ?>
                        <span>Login sebagai, User</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/Home" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Kategori" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Departemen" class="nav-link">
                        <i class="nav-icon fas fa-hospital"></i>
                        <p>
                            Departemen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/User" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Arsip" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Arsip
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Auth/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>