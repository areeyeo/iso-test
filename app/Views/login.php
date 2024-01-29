<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>" />
</head>
<style>
    /* เพิ่ม CSS ในส่วนนี้เพื่อกำหนดฟอนต์ให้กับทุกส่วนของหน้าเว็บไซต์ */
    * {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body class="hold-transition sidebar-mini">

    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="d-flex justify-content-end mt-3 mr-3">
                    <img src="<?= base_url('dist/img/logotnet.png'); ?>" style="width: 80px;">
                </div>
                <h3 class="text-center font-weight-bold mt-2">Login</h3>
                <div class="card-body">

                    <form class="mb-3" id="form_login" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" />
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" value="" id="remember">
                                    <!-- <input type="checkbox" id="remember" /> -->
                                    <label for="remember"> Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block mt-2" name="submit" value="Submit">Login</button>
                        </div>
                    </form>
                    <!-- <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p> -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            // Attach the event handler only once when the document is ready
            $("#form_login").on('submit', function(event) {
                event.preventDefault();
                store_alert(); // Call the function to handle the submission
            });

            // Ajax form submission with image
            function store_alert() {
                var formData = new FormData($("#form_login")[0]);

                // Show loading indicator here
                var loadingIndicator = Swal.fire({
                    title: 'Loading...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                        url: '<?= base_url("/login/loginAuth") ?>',
                        type: "POST",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "JSON",
                        beforeSend: function() {
                            // Show loading indicator here
                            loadingIndicator;
                        },
                    })
                    .done(function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    window.location.reload();
                                } else {
                                    window.location.href = '<?= site_url("/") ?>';
                                }
                            }, 2000);
                        } else {
                            // console.log(response);
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: false
                            });
                        }
                    })
                    .fail(function(xhr, status, error) {
                        // Hide loading indicator here in case of failure
                        Swal.fire({
                            title: error,
                            icon: 'error',
                            showConfirmButton: false
                        });
                    });
            }

        });
    </script>
</body>

</html>