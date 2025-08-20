<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('web_home_settings'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('web_home_settings'); ?> <small class="text-small"><?= lang('note_that_this_will_directly_reflect_the_changes_in_web'); ?></small></h1>
                    </div>
                    <div class="section-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('web_home_settings'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>
                                    <div class="card-body">
                                        <table aria-describedby="mydesc" class='table-striped' id='web_home_settings_list' data-toggle="table" data-url="<?= base_url() . 'Table/web_home_settings' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-show-columns="true" data-show-refresh="true" data-fixed-columns="true" data-fixed-number="2" data-fixed-right-number="1" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "web-home-settings-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams" data-escape="false">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true" data-visible="false"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="no"><?= lang('sr_no'); ?></th>
                                                    <th scope="col" data-field="language_id" data-sortable="true" data-visible="false"><?= lang('language_id'); ?></th>
                                                    <th scope="col" data-field="language" data-sortable="true"><?= lang('language'); ?></th>
                                                    <th scope="col" data-field="operate" data-sortable="false" data-force-hide="true"><?= lang('operate'); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <h4>
                                            <label class="control-label"><b><?= lang('note_for_every_section'); ?> </b></label>
                                        </h4>
                                        <ul>
                                            <div class="text-danger h6">
                                                <li> <?= lang('heading_support'); ?></li>
                                            </div>
                                            <div class="text-danger h6">
                                                <li> <?= lang('title_support'); ?></li>
                                            </div>
                                            <div class="text-danger h6">
                                                <li> <?= lang('description_support'); ?></li>
                                            </div>
                                        </ul>

                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <?php if (is_language_mode_enabled()) { ?>
                                                <div class="row">
                                                    <div class="form-group col-md-3 col-sm-12">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select name="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>" <?= ($this->uri->segment(2) == $lang->id) ? 'selected' : '' ?>><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                            <!-- Section 1  -->
                                            <h4>
                                                <label class="control-label"><b><?= lang('section_1'); ?></b></label>
                                            </h4>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label class="control-label"><?= lang('visibility_mode'); ?></label><br>
                                                    <input type="checkbox" id="section-1-mode" data-plugin="switchery" <?php if (!empty($section_1_mode) && $section_1_mode['message'] == '1') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>

                                                    <input type="hidden" id="section-1-mode-value" name="section_1_mode" value="<?= !empty($section_1_mode) ? $section_1_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('heading'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section1_heading" type="text" placeholder="<?= lang('heading'); ?>" class="form-control" value="<?php echo (isset($section1_heading) && !empty($section1_heading['message'])) ? $section1_heading['message'] : "" ?>" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('title_1'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section1_title1" placeholder="<?= lang('title_1'); ?>" type="text" class="form-control" value='<?php echo (isset($section1_title1) && !empty($section1_title1['message'])) ? $section1_title1['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('title_2'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section1_title2" placeholder="<?= lang('title_2'); ?>" type="text" class="form-control" value='<?php echo (isset($section1_title2) && !empty($section1_title2['message'])) ? $section1_title2['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('title_3'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section1_title3" placeholder="<?= lang('title_3'); ?>" type="text" class="form-control" value='<?php echo (isset($section1_title3) && !empty($section1_title3['message'])) ? $section1_title3['message'] : "" ?>' required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('image_1'); ?></label>
                                                    <?php if (isset($section1_image1['message']) && !empty($section1_image1['message'])) { ?>
                                                        <input class="form-control section1_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image1">
                                                        <p style="display: none" id="section1_image1_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image1['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image1['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section1_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image1" required>
                                                        <p style="display: none" id="section1_image1_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('image_2'); ?></label>
                                                    <?php if (isset($section1_image2['message']) && !empty($section1_image2['message'])) { ?>
                                                        <input class="form-control section1_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image2">
                                                        <p style="display: none" id="section1_image2_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image2['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image2['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section1_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image2" required>
                                                        <p style="display: none" id="section1_image2_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('image_3'); ?></label>
                                                    <?php if (isset($section1_image3['message']) && !empty($section1_image3['message'])) { ?>
                                                        <input class="form-control section1_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image3">
                                                        <p style="display: none" id="section1_image3_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image3['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section1_image3['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section1_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section1_image3" required>
                                                        <p style="display: none" id="section1_image3_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('description_1'); ?></label>
                                                    <textarea name="section1_desc1" class="form-control" id="section1_desc1" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_1'); ?>"><?php echo (isset($section1_desc1) && !empty($section1_desc1['message'])) ? $section1_desc1['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('description_2'); ?></label>
                                                    <textarea name="section1_desc2" class="form-control" id="section1_desc2" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_2'); ?>"><?php echo (isset($section1_desc2) && !empty($section1_desc2['message'])) ? $section1_desc2['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('description_3'); ?></label>
                                                    <textarea name="section1_desc3" class="form-control" id="section1_desc3" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_3'); ?>"><?php echo (isset($section1_desc3) && !empty($section1_desc3['message'])) ? $section1_desc3['message'] : "" ?></textarea>
                                                </div>
                                            </div>



                                            <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                            <!-- Section 2  -->
                                            <hr>
                                            <h4>
                                                <label class="control-label"><b><?= lang('section_2'); ?></b></label>
                                            </h4>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label class="control-label"><?= lang('visibility_mode'); ?></label><br>
                                                    <input type="checkbox" id="section-2-mode" data-plugin="switchery" <?php if (!empty($section_2_mode) && $section_2_mode['message'] == '1') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>

                                                    <input type="hidden" id="section-2-mode-value" name="section_2_mode" value="<?= !empty($section_2_mode) ? $section_2_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('heading'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section2_heading" placeholder="<?= lang('heading'); ?>" type="text" class="form-control" value='<?php echo (isset($section2_heading) && !empty($section2_heading['message'])) ? $section2_heading['message'] : "" ?>' required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_1'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section2_title1" placeholder="<?= lang('title_1'); ?>" type="text" class="form-control" value='<?php echo (isset($section2_title1) && !empty($section2_title1['message'])) ? $section2_title1['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_2'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section2_title2" placeholder="<?= lang('title_2'); ?>" type="text" class="form-control" value='<?php echo (isset($section2_title2) && !empty($section2_title2['message'])) ? $section2_title2['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_3'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section2_title3" placeholder="<?= lang('title_3'); ?>" type="text" class="form-control" value='<?php echo (isset($section2_title3) && !empty($section2_title3['message'])) ? $section2_title3['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_4'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section2_title4" placeholder="<?= lang('title_4'); ?>" type="text" class="form-control" value='<?php echo (isset($section2_title4) && !empty($section2_title4['message'])) ? $section2_title4['message'] : "" ?>' required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_1'); ?></label>
                                                    <textarea name="section2_desc1" class="form-control" id="section2_desc1" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_1'); ?>"><?php echo (isset($section2_desc1) && !empty($section2_desc1['message'])) ? $section2_desc1['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_2'); ?></label>
                                                    <textarea name="section2_desc2" class="form-control" id="section2_desc2" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_2'); ?>"><?php echo (isset($section2_desc2) && !empty($section2_desc2['message'])) ? $section2_desc2['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_3'); ?></label>
                                                    <textarea name="section2_desc3" class="form-control" id="section2_desc3" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_3'); ?>"><?php echo (isset($section2_desc3) && !empty($section2_desc3['message'])) ? $section2_desc3['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_4'); ?></label>
                                                    <textarea name="section2_desc4" class="form-control" id="section2_desc4" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_4'); ?>"><?php echo (isset($section2_desc4) && !empty($section2_desc4['message'])) ? $section2_desc4['message'] : "" ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_1'); ?></label>
                                                    <?php if (isset($section2_image1['message']) && !empty($section2_image1['message'])) { ?>
                                                        <input class="form-control section2_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image1">
                                                        <p style="display: none" id="section2_image1_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image1['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image1['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section2_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image1" required>
                                                        <p style="display: none" id="section2_image1_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_2'); ?></label>
                                                    <?php if (isset($section2_image2['message']) && !empty($section2_image2['message'])) { ?>
                                                        <input class="form-control section2_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image2">
                                                        <p style="display: none" id="section2_image2_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image2['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image2['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section2_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image2" required>
                                                        <p style="display: none" id="section2_image2_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_3'); ?></label>
                                                    <?php if (isset($section2_image3['message']) && !empty($section2_image3['message'])) { ?>
                                                        <input class="form-control section2_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image3">
                                                        <p style="display: none" id="section2_image3_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image3['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image3['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section2_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image3" required>
                                                        <p style="display: none" id="section2_image3_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_4'); ?></label>
                                                    <?php if (isset($section2_image4['message']) && !empty($section2_image4['message'])) { ?>
                                                        <input class="form-control section2_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image4">
                                                        <p style="display: none" id="section2_image4_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image4['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section2_image4['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section2_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section2_image4" required>
                                                        <p style="display: none" id="section2_image4_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                            <!-- Section 3  -->
                                            <hr>
                                            <h4>
                                                <label class="control-label"><b><?= lang('section_3'); ?></b></label>
                                            </h4>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label class="control-label"><?= lang('visibility_mode'); ?></label><br>
                                                    <input type="checkbox" id="section-3-mode" data-plugin="switchery" <?php if (!empty($section_3_mode) && $section_3_mode['message'] == '1') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>

                                                    <input type="hidden" id="section-3-mode-value" name="section_3_mode" value="<?= !empty($section_3_mode) ? $section_3_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('heading'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section3_heading" placeholder="<?= lang('heading'); ?>" type="text" class="form-control" value="<?php echo (!empty($section3_heading['message'])) ? $section3_heading['message'] : "" ?>" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_1'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section3_title1" placeholder="<?= lang('title_1'); ?>" type="text" class="form-control" value='<?php echo (!empty($section3_title1['message'])) ? $section3_title1['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_2'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section3_title2" placeholder="<?= lang('title_2'); ?>" type="text" class="form-control" value='<?php echo (!empty($section3_title2['message'])) ? $section3_title2['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_3'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section3_title3" placeholder="<?= lang('title_3'); ?>" type="text" class="form-control" value='<?php echo (!empty($section3_title3['message'])) ? $section3_title3['message'] : "" ?>' required>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('title_4'); ?> <small class="text-danger">*</small></label>
                                                    <input name="section3_title4" placeholder="<?= lang('title_4'); ?>" type="text" class="form-control" value='<?php echo (!empty($section3_title4['message'])) ? $section3_title4['message'] : "" ?>' required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_1'); ?></label>
                                                    <?php if (isset($section3_image1['message']) && !empty($section3_image1['message'])) { ?>
                                                        <input class="form-control section3_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image1">
                                                        <p style="display: none" id="section3_image1_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image1['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image1['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section3_image1" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image1" required>
                                                        <p style="display: none" id="section3_image1_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_2'); ?></label>
                                                    <?php if (isset($section3_image2['message']) && !empty($section3_image2['message'])) { ?>
                                                        <input class="form-control section3_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image2">
                                                        <p style="display: none" id="section3_image2_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image2['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image2['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section3_image2" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image2" required>
                                                        <p style="display: none" id="section3_image2_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_3'); ?></label>
                                                    <?php if (isset($section3_image3['message']) && !empty($section3_image3['message'])) { ?>
                                                        <input class="form-control section3_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image3">
                                                        <p style="display: none" id="section3_image3_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image3['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image3['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section3_image3" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image3" required>
                                                        <p style="display: none" id="section3_image3_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('image_4'); ?></label>
                                                    <?php if (isset($section3_image4['message']) && !empty($section3_image4['message'])) { ?>
                                                        <input class="form-control section3_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image4">
                                                        <p style="display: none" id="section3_image4_img_error_msg" class="alert alert-danger"></p>
                                                        <div class="mt-1"><a href='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image4['message'] ?>' data-lightbox="Logos"><img src='<?= base_url() . WEB_HOME_SETTINGS_LOGO_PATH . $section3_image4['message'] ?>' height=50, width=50></a></div>
                                                    <?php } else { ?>
                                                        <input class="form-control section3_image4" type="file" accept="image/jpg,image/png,image/svg+xml,image/jpeg" name="section3_image4" required>
                                                        <p style="display: none" id="section3_image4_img_error_msg" class="alert alert-danger"></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_1'); ?></label>
                                                    <textarea name="section3_desc1" class="form-control" id="section3_desc1" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_1'); ?>"><?php echo (isset($section3_desc1) && !empty($section3_desc1['message'])) ? $section3_desc1['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_2'); ?></label>
                                                    <textarea name="section3_desc2" class="form-control" id="section3_desc2" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_2'); ?>"><?php echo (isset($section3_desc2) && !empty($section3_desc2['message'])) ? $section3_desc2['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_3'); ?></label>
                                                    <textarea name="section3_desc3" class="form-control" id="section3_desc3" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_3'); ?>"><?php echo (isset($section3_desc3) && !empty($section3_desc3['message'])) ? $section3_desc3['message'] : "" ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('description_4'); ?></label>
                                                    <textarea name="section3_desc4" class="form-control" id="section3_desc4" cols="20" rows="5" placeholder="<?= lang('enter_description_for_title_4'); ?>"><?php echo (isset($section3_desc4) && !empty($section3_desc4['message'])) ? $section3_desc4['message'] : "" ?></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?> mt-4" />
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

        function queryParams(p) {
            return {
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }

        var section1Mode = document.querySelector('#section-1-mode');
        section1Mode.onchange = function() {
            if (section1Mode.checked)
                $('#section-1-mode-value').val(1);
            else
                $('#section-1-mode-value').val(0);
        };

        var section2Mode = document.querySelector('#section-2-mode');
        section2Mode.onchange = function() {
            if (section2Mode.checked)
                $('#section-2-mode-value').val(1);
            else
                $('#section-2-mode-value').val(0);
        };

        var section3Mode = document.querySelector('#section-3-mode');
        section3Mode.onchange = function() {
            if (section3Mode.checked)
                $('#section-3-mode-value').val(1);
            else
                $('#section-3-mode-value').val(0);
        };

        // get the value of all the images
        let images = ['section1_image1', 'section1_image2', 'section1_image3', 'section2_image1', 'section2_image2', 'section2_image3', 'section2_image4', , 'section3_image1', 'section3_image1', 'section3_image2', 'section3_image3', 'section3_image4'];

        //added in loop to check the upload file validation
        $.each(images, function(index, value) {
            $("." + value).change(function(e) {
                var file, img;

                if ((file = this.files[0])) {
                    img = new Image();

                    //checks only image which are not png or jpg
                    if (file.type !== 'image/png' && file.type !== 'image/jpeg' && file.type !== 'image/jpg' && file.type !== 'image/svg+xml') {
                        $('.' + value).val('');
                        $('#' + value + '_img_error_msg').html('<?= IMAGE_ALLOW_PNG_JPG_SVG_MSG; ?>');
                        $('#' + value + '_img_error_msg').show().delay(3000).fadeOut();
                    }

                    //gets error when uploading any file rather than image
                    img.onerror = function() {
                        $('.' + value + '_icon').val('');
                        $('#' + value + '_icon_img_error_msg').html('<?= INVALID_IMAGE_TYPE; ?>');
                        $('#' + value + '_icon_img_error_msg').show().delay(3000).fadeOut();
                    };
                    img.src = _URL.createObjectURL(file);
                }
            });
        });
    </script>
</body>

</html>