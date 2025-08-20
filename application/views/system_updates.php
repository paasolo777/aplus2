<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('system_update'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('system_update'); ?> <small class="text-danger"> <?= lang('current_version'); ?> <?php echo (!empty($system_version['message'])) ? $system_version['message'] : "" ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <?php
                                            $quiz_url = $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                                            ?>
                                            <input type="hidden" name="quiz_url" value="<?= $quiz_url; ?>" required />
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('purchase_code'); ?></label>
                                                    <input type="text" name="purchase_code" placeholder="<?= lang('enter_purchase_code'); ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('update_zip'); ?> <small class="text-danger"><?= lang('only_zip_file_allow'); ?></small></label>
                                                    <input id="file" name="file" type="file" accept=".zip,.rar" required class="form-control">
                                                    <small class="text-danger"><?= lang('your_current_version_is'); ?> <?php echo (!empty($system_version['message'])) ? $system_version['message'] : "" ?> , <?= lang('please_update_nearest_version_here_if_available'); ?></small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-10">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?>" />
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
</body>

</html>