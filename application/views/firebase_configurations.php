<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('firebase_configurations'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('firebase_configurations'); ?> </h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <?php
                                                    $target_path = getcwd() . DIRECTORY_SEPARATOR;
                                                    $file_name = $target_path . 'assets/firebase_config.json';
                                                    $is_file = 0;
                                                    if (file_exists($file_name)) {
                                                        $is_file = 1;
                                                    }
                                                    ?>
                                                    <label class="control-label"><?= lang('current_file_status'); ?> : <?= ($is_file) ? '<small class="badge badge-success">' . lang('file_exists') . '</small>' : '<small class="badge badge-danger">' . lang('file_not_exists_please_upload') . '</small>' ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('update_file'); ?> <small class="text-danger"><?= lang('only_json_file_allow'); ?> *</small></label>
                                                    <input id="file" name="file" type="file" accept=".json" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-10">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?>" />
                                                </div>
                                            </div>
                                        </form>
                                        <hr />
                                        <ol>
                                            <li><?= lang('open'); ?> <a href="https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk" target="_blank">https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk </a> <?= lang('and_select_project_you_want_to_generate_private_key_file_for'); ?></li>
                                            <li><?= lang('click_generate_new_private_key_then_confirm_by_clicking_generate_key_then'); ?><b><?= lang('upload_generated_json_file'); ?></b>.
                                                <img src="<?= base_url() . 'assets/generate-key.png' ?>" width="100%" />
                                            </li>
                                        </ol>
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

</body>

</html>