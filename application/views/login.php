<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= lang('admin_login'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

    <?php base_url() . include 'include.php'; ?>
</head>

<body>
    <div class="login" style="background-image: url(<?= is_settings('background_file') ? base_url() . LOGO_IMG_PATH . is_settings('background_file') : base_url() . LOGO_IMG_PATH . 'background-image-stock.png'; ?>); background-position: center;">
        <div class="overlay">
            <div id="app">
                <section class="login-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 col-lg-7"></div>
                            <div class="col-md-8 col-lg-4">
                                <div class="card login_card">
                                    <div class="login-brand">
                                        <?php if (is_settings('full_logo')) { ?>
                                            <img src="<?= base_url() . LOGO_IMG_PATH . is_settings('full_logo'); ?>" alt="logo" width="150">
                                        <?php } ?>
                                    </div>
                                    <div class="login-welcome-text">
                                        <h3><?= lang('sign_in'); ?></h3>
                                        <p><?= lang('welcome_lets_get_started_sign_in_to_explore'); ?></p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="<?= base_url() ?>loginMe" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="form-group">
                                                <label for="email"><?= lang('username'); ?></label>
                                                <input type="text" class="form-control" name="username" placeholder="<?= lang('enter_username'); ?>" required value="<?= isset($_COOKIE["elite_user_login"]) ? $_COOKIE["elite_user_login"] : '' ?>" autofocus>
                                                <div class="invalid-feedback">
                                                    <?= lang('please_fill_in_your_username'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="password" class="control-label"><?= lang('password'); ?></label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="password" id="password" class="form-control" name="password" placeholder="<?= lang('enter_password'); ?>" value="<?= isset($_COOKIE["elite_userpassword"]) ? $_COOKIE["elite_userpassword"] : '' ?>" required>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-eye-slash" id="btnIcon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= lang('please_fill_in_your_password'); ?>
                                                </div>
                                            </div>

                                            <label class="checkbox">
                                                <input type="checkbox" name="rememberMe" id="rememberMe" <?php if (isset($_COOKIE["elite_user_login"])) { ?> checked <?php } ?> />
                                                <?= lang('remember_me'); ?>
                                            </label>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                    <?= lang('login'); ?>
                                                </button>
                                            </div>
                                        </form>

                                        <?php $footer_copyrights_text = $this->db->where('type', 'footer_copyrights_text')->get('tbl_settings')->row_array(); ?>
                                        <div class="text-center mt-4 pb-3">
                                            <?php
                                            if (isset($footer_copyrights_text) && !empty($footer_copyrights_text['message'])) { ?>
                                                <div class="text-muted"> <?= $footer_copyrights_text['message'] ?> </div>
                                            <?php } else { ?>
                                                <div class="text-muted"> <?= lang('copyright'); ?> &copy; <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?> <?= date('Y') ?></div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>assets/js/stisla.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/scripts.js" type="text/javascript"></script>

    <!-- Toast JS -->
    <script src="<?= base_url(); ?>assets/js/iziToast.min.js"></script>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                if ($(this).data('submitted') === true) {
                    // Stop form from submitting again
                    e.preventDefault();
                } else {
                    // Set the data-submitted attribute to true for record
                    $(this).data('submitted', true);
                }
            });
        });
    </script>

    <script>
        $("#btnIcon").click(function() {
            var input = $('#password');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
                $(this).attr("class", "fa fa-eye");

            } else {
                input.attr("type", "password");
                $(this).attr("class", "fa fa-eye-slash");
            }
        });
    </script>
    <?php if ($this->session->flashdata('error')) { ?>
        <script type='text/javascript'>
            iziToast.error({
                message: '<?= $this->session->flashdata('error'); ?>',
                position: 'topRight'
            });
        </script>
    <?php } ?>
</body>

</html>