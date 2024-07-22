<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
</head>
<style>
    /* เพิ่ม CSS ในส่วนนี้เพื่อกำหนดฟอนต์ให้กับทุกส่วนของหน้าเว็บไซต์ */
    * {
        font-family: 'Kanit', sans-serif;
    }

    .nav-sidebar .menu-is-opening>.nav-link i.right,
    .nav-sidebar .menu-is-opening>.nav-link svg.right,
    .nav-sidebar .menu-open>.nav-link i.right,
    .nav-sidebar .menu-open>.nav-link svg.right {
        transform: rotate(90deg);
    }


    .nav-sidebar>.nav-item .nav-icon.far {
        font-size: 1rem;
    }

    [class*=sidebar-light-] .nav-sidebar>.nav-item.menu-open>.nav-link {
        background-color: #007BFF;
        color: white;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <h2 class="display-4">is loading <i class="fa fa-sync fa-spin"></i></h2>
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> -->
                <li class="nav-item dropdown">
                    <div class="user-block">
                        <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if (session()->get('profile_image') == null) : ?>
                                <img class="img-circle" src="<?= base_url('dist/img/avatar6.png'); ?>" alt="User Image">
                            <?php else : ?>
                                <img class="img-circle" src="data:image/png;base64, <?php echo session()->get('profile_image'); ?>" alt="User Image">
                            <?php endif; ?>
                            <span class="username">
                                <?php echo session()->get('name'); ?>
                                <?php echo session()->get('lastname'); ?>
                            </span>
                            <span class="description">
                                <?php echo session()->get('role'); ?>
                            </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <!-- Dropdown items go here -->
                            <a class="dropdown-item" href="<?= site_url('/profile'); ?>"> <i class="fas fa-id-card"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="nav-link" href="<?= site_url('/logout'); ?>" role="button">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= site_url('/'); ?>" class="brand-link">
                <img src="<?= base_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ISO OPTIMIZE</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">Home</li>
                        <li class="nav-item">
                            <a href="<?= site_url('/under_construction'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>

                            </a>

                        </li>
                        <div>
                            <hr>
                        </div>
                        <li class="nav-header">Management System</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-city"></i>
                                <p>
                                    Context
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('context/loaddatatype/1'); ?>" class="nav-link">
                                        <i class="far fa-circle fa-xs nav-icon"></i>
                                        <p>Context Analysis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('context/loaddatatype/2'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Interested Party</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('context/loaddatatype/3'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ISMS Scope</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('context/loaddatatype/4'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ISMS Process</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>
                                    Leadership
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/7'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Leadership & Com...</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/8'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>IS Policy</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/9'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ISMS Roles & Res...</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/under_construction'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Planning
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('/under_construction'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Risk Criteria
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-circle-notch nav-icon"></i>
                                                <p>
                                                    Context
                                                    <i class="right fas fa-angle-right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <?php $contextLinks = [
                                                    ['text' => 'Consequence Level', 'url' => 'planning/risk_Criteria_Context_Consequence'],
                                                    ['text' => 'Likelihood Level', 'url' => 'planning/risk_Criteria_Context_Likelihood'],
                                                    ['text' => 'Risk Level', 'url' => 'planning/risk_Criteria_Context_Risk_Level'],
                                                    ['text' => 'Risk Options', 'url' => 'planning/risk_Criteria_Context_Risk_Option']
                                                ]; ?>
                                                <?php foreach ($contextLinks as $link) : ?>
                                                    <li class="nav-item">
                                                        <a href="<?= site_url($link['url']); ?>" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>
                                                                <?= $link['text']; ?>
                                                            </p>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-circle-notch nav-icon"></i>
                                                <p>
                                                    Information Security
                                                    <i class="right fas fa-angle-right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <?php $contextLinks = [
                                                    ['text' => 'Consequence Level', 'url' => 'planning/risk_Criteria_IS_Consequence'],
                                                    ['text' => 'Likelihood Level', 'url' => 'planning/risk_Criteria_IS_Likelihood'],
                                                    ['text' => 'Risk Level', 'url' => 'planning/risk_Criteria_IS_Risk_Level'],
                                                    ['text' => 'Risk Options', 'url' => 'planning/risk_Criteria_IS_Risk_Option']
                                                ]; ?>
                                                <?php foreach ($contextLinks as $link) : ?>
                                                    <li class="nav-item">
                                                        <a href="<?= site_url($link['url']); ?>" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>
                                                                <?= $link['text']; ?>
                                                            </p>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/18'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SOA</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/10'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>IS Objectives</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/11'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Planning of changes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Support
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/12'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Competence</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/13'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Awareness</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/14'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Communication</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/17'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Documented</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/under_construction'); ?>" class="nav-link">
                                <i class="fas fa-circle fa-lg nav-icon"></i>
                                <p>
                                    Operation
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('operations/operations_management/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Operations Mana...</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('context/loaddatatype/15'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>RA & RTP Result IS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Performance
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('/performance/performance_management/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Performance Evalua...</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('/internal_audit/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Internal Audit</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('/performance/management_review/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Management Review</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/under_construction'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Improvement
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('/improvements/improvements_overview/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Improvements Overvi..</p>
                                    </a>
                                    <a href="<?= site_url('/improvements/nonconformity_action/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nonconformity & Act...</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <div>
                            <hr>
                        </div>
                        <li class="nav-header">Management setting</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Risk Criteria Context
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php $contextLinks = [
                                    ['text' => 'Consequence Level', 'url' => 'planning/risk_Criteria_Context_Consequence'],
                                    ['text' => 'Likelihood Level', 'url' => 'planning/risk_Criteria_Context_Likelihood'],
                                    ['text' => 'Risk Level', 'url' => 'planning/risk_Criteria_Context_Risk_Level'],
                                    ['text' => 'Risk Options', 'url' => 'planning/risk_Criteria_Context_Risk_Option']
                                ]; ?>
                                <?php foreach ($contextLinks as $link) : ?>
                                    <li class="nav-item">
                                        <a href="<?= site_url($link['url']); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                <?= $link['text']; ?>
                                            </p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Risk Criteria Informa...
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php $contextLinks = [
                                    ['text' => 'Consequence Level', 'url' => 'planning/risk_Criteria_IS_Consequence'],
                                    ['text' => 'Likelihood Level', 'url' => 'planning/risk_Criteria_IS_Likelihood'],
                                    ['text' => 'Risk Level', 'url' => 'planning/risk_Criteria_IS_Risk_Level'],
                                    ['text' => 'Risk Options', 'url' => 'planning/risk_Criteria_IS_Risk_Option']
                                ]; ?>
                                <?php foreach ($contextLinks as $link) : ?>
                                    <li class="nav-item">
                                        <a href="<?= site_url($link['url']); ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                <?= $link['text']; ?>
                                            </p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <div>
                            <hr>
                        </div>
                        <li class="nav-header">Initial System</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Database
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('database/userlist/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Userlist</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('database/role/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Role Management</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('database/context_select/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Topic Management</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('database/context_requirement/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Requirement</p>
                                    </a>
                                </li>
                                <li class="nav-item" hidden>
                                    <a href="<?= site_url('database/log_list/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Log Activites</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('permission/context/index'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permission</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <div>
                            <hr>
                        </div>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> -->
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('dist/js/demo.js'); ?>"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jszip/jszip.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/pdfmake.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/vfs_fonts.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

    <body>

</html>