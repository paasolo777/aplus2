<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('import_questions'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('import_questions'); ?> <small class="text-small"><?= lang('upload_using_csv_file'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-10 offset-2">
                                                    <label><?= lang('csv_questions_file'); ?> <small class="text-danger">*</small></label>
                                                    <input type="file" name="file" id="questions_file" required class="form-control" accept=".csv" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2 col-sm-10 offset-2 my-1">
                                                    <input type="submit" name="btnadd" value="<?= lang('upload_csv_file'); ?>" class="<?= BUTTON_CLASS ?>" />

                                                </div>
                                                <div class="form-group col-md-3 col-sm-10 offset-2 my-1">
                                                    <a class="btn btn-primary" href='<?= base_url(); ?>assets/data-format-for-multi-match.csv' target="_blank" download> <em class='fas fa-download mr-3'></em><?= lang('download_sample_file_here'); ?></a>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="mt-4">
                                            <h5 class="text-danger"><?= lang('how_to_convert_csv_in_to_unicode_for_non_english'); ?></h5>
                                            <p><?= lang('1_fill_the_data_in_excel_sheet_which_formate_we_given'); ?>
                                            <p>
                                            <p><?= lang('2_save_as_the_file'); ?> <strong><?= lang('unicode_text_txt'); ?></strong></p>
                                            <p><?= lang('3_open_txt_file_in_notepad'); ?></p>
                                            <p><?= lang('4_replace_the_tab_space_with_comma'); ?></p>
                                            <p><?= lang('5_save_as_this_file_with_txt_extension_and_change_the_encoding'); ?><b> <?= lang('utf_8'); ?></b>.</p>
                                            <p><?= lang('6_change_the_file_extension_txt_to_csv'); ?></p>
                                            <p><?= lang('7_now_this_file_use_import_question'); ?></p>
                                            <p><a href="https://www.ablebits.com/office-addins-blog/2014/04/24/convert-excel-csv/" target="_blank"><?= lang('for_more_info'); ?></a></p>
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

    <?php base_url() . include 'footer.php'; ?>

</body>

</html>