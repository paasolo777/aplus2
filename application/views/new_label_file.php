<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('new_label_added') ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('new_label_added_in') . ' ' . lang($this->uri->segment(2)) ?></h1>
                        <div class="section-header-breadcrumb">
                            <a href="<?= base_url('system-languages') ?>" class="footer_dev_link text-decoration-none">
                                <h6>
                                    <i class="fa fa-arrow-left"></i>
                                    <?= lang('back') ?>
                                </h6>
                            </a>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <?php
                                        if ($set_label == 1) {
                                        ?>
                                            <h4><?= lang('the_lable_has_not_been_added_in') . ' ' . $language_name . '. ' . lang('please_update_it') ?></h4>
                                        <?php
                                        } else if ($set_label == 2) { ?>
                                            <h4><?= lang('you_can_change_label_in') . ' ' . $language_name ?></h4>
                                        <?php
                                        } else {
                                        ?>
                                            <h4><?= lang('please_update_it') ?></h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <?php
                                                foreach ($missing_keys as $key => $value) {

                                                ?>
                                                    <div class="form-group col-md-4 col-sm-6">
                                                        <label class="control-label"><?= $value ?></label><br>
                                                        <input type="text" class="form-control" name="lang_val[<?= htmlspecialchars($key) ?>]" value="<?= htmlspecialchars($value) ?>">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php if ($missing_keys) {
                                            ?>
                                                <div class="row">
                                                    <div class="form-group col-sm-12">
                                                        <input type="submit" name="btnadd" value="<?= lang('submit') ?>" class="<?= BUTTON_CLASS ?>" />
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
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