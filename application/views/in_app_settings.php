<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('in_app_settings'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

    <?php base_url() . include 'include.php'; ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <?php base_url() . include 'header.php'; ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= lang('in_app_settings'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-6">
                                                    <label class="control-label"><?= lang('in_app_purchase'); ?></label><br>
                                                    <input type="checkbox" id="in_app_purchase_mode_btn" data-plugin="switchery" <?= (!empty($in_app_purchase_mode) && $in_app_purchase_mode['message'] == '1') ? 'checked' : '' ?>>
                                                    <input type="hidden" id="in_app_purchase_mode" name="in_app_purchase_mode" value="<?= ($in_app_purchase_mode) ? $in_app_purchase_mode['message'] : 0; ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" id="settingData" style="display: none;">
                                                <div class="form-group col-md-6 col-lg-6 col-sm-12 col-12">
                                                    <h6><?= lang('ios'); ?></h6>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 col-lg-12 col-sm-12 col-12">
                                                            <label class="control-label"><?= lang('itune_shared_secret'); ?></label><br>
                                                            <input type="text" name="shared_secrets" class="form-control" value="<?= $shared_secrets['message'] ?? '' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-6 col-sm-12 col-12">
                                                    <h6><?= lang('android'); ?></h6>
                                                    <div class="row">
                                                        <div class="form-group col-md-4 col-lg-4 col-sm-12 col-12">
                                                            <label class="control-label"><?= lang('app_package_name'); ?></label><br>
                                                            <input type="text" name="app_package_name" class="form-control" value="<?= $app_package_name['message'] ?? '' ?>">

                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6 col-sm-10 col-10">
                                                            <label class="control-label"><?= lang('client_email'); ?></label><br>
                                                            <input class="form-control" value="<?= $clientEmail ?>" disabled style="pointer-events: none;">
                                                        </div>
                                                        <div class="form-group col-md-2 col-lg-2 col-sm-2 col-2">
                                                            <label class="control-label">&nbsp;</label><br>
                                                            <button type="button" class="btn btn-icon btn-primary" id="copyEmail" data-mail="<?= $clientEmail ?>"><i class="fa fa-clipboard"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <?php
                                                    if ($is_validate) {
                                                    ?>
                                                        <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?>" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <h6 class="text-danger"><?= lang('check_your_firebase_configuration_file'); ?></h6>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <?php base_url() . include 'footer.php'; ?>
    <script>
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });

        /* on change of in app purchase mode btn - switchery js */
        var changeCheckbox = document.querySelector('#in_app_purchase_mode_btn');
        changeCheckbox.onchange = function() {
            if (changeCheckbox.checked) {
                $('#in_app_purchase_mode').val(1);
                $('#settingData').show('fast');
            } else {
                $('#in_app_purchase_mode').val(0);
                $('#settingData').hide('fast');
            }
        };
    </script>
    <script>
        $(document).ready(function() {
            if ($('#in_app_purchase_mode').val() == 1) {
                $('#settingData').show('fast');
            } else {
                $('#settingData').hide('fast');
            }
        });

        $(document).on('click', '#copyEmail', function() {
            var text = $(this).data('mail');
            copyToClipboard(text);
        });

        function copyToClipboard(element) {
            var temp = $("<input>");
            $("body").append(temp);
            temp.val(element).select();
            document.execCommand("copy");
            temp.remove();
            alert("copied");
        }
    </script>

</body>

</html>