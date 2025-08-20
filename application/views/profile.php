<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('profile'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('profile'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('quiz_name'); ?></label>
                                                    <input name="app_name" type="text" value="<?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?>" required class="form-control" placeholder="<?= lang('enter_quiz_name'); ?>" />
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('jwt_key'); ?></label>
                                                    <i class="fa fa-question-circle ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('jwt_key_instruction'); ?>"></i>
                                                    <input name="jwt_key" type="text" value="<?php echo ($jwt_key) ? $jwt_key['message'] : "" ?>" required class="form-control" placeholder="<?= lang('enter_jwt_key'); ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('full_log'); ?> <small class="text-danger"><?= lang('460_115_size_allowed'); ?></small></label>
                                                    <input id="full_file" name="full_file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                                    <input type="hidden" name="full_url" value="<?= LOGO_IMG_PATH . is_settings('full_logo'); ?>">
                                                    <?php if (is_settings('full_logo')) { ?>
                                                        <div class="m-2"><img src="<?= base_url() . LOGO_IMG_PATH . is_settings('full_logo'); ?>" alt="logo" width="250"></div>
                                                    <?php } ?>
                                                    <div style="display: none" id="msg_full_file" class="alert alert-danger"></div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('half_logo'); ?> <small class="text-danger"><?= lang('255_255_size_allowed'); ?></small></label>
                                                    <input id="half_file" name="half_file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                                    <input type="hidden" name="half_url" value="<?= LOGO_IMG_PATH . is_settings('half_logo'); ?>">
                                                    <?php if (is_settings('half_logo')) { ?>
                                                        <div class="m-2"><img src="<?= base_url() . LOGO_IMG_PATH . is_settings('half_logo'); ?>" alt="logo" height="60"></div>
                                                    <?php } ?>
                                                    <div style="display: none" id="msg_half_file" class="alert alert-danger"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('login_background_image'); ?><small class="text-danger"><?= lang('1920_1080_recommended'); ?></small></label>
                                                    <input id="background_file" name="background_file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                                    <input type="hidden" name="background_file_url" value="<?= !empty(is_settings('background_file')) ? LOGO_IMG_PATH . is_settings('background_file') : "" ?>">
                                                    <?php if (is_settings('background_file')) { ?>
                                                        <div class="m-2"><img src="<?= base_url() . LOGO_IMG_PATH . is_settings('background_file'); ?>" alt="background_file" width="150" height="80"></div>
                                                    <?php } ?>
                                                    <div style="display: none" id="msg_background_file" class="alert alert-danger"></div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('bot_image'); ?><small class="text-danger"><?= lang('102_102_recommended'); ?></small></label>
                                                    <input id="bot_image" name="bot_image" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                                    <input type="hidden" name="bot_file_url" value="<?= !empty(is_settings('bot_image')) ? LOGO_IMG_PATH . is_settings('bot_image')  : "" ?>">
                                                    <?php if (is_settings('bot_image')) { ?>
                                                        <div class="m-2"><img src="<?= base_url() . LOGO_IMG_PATH . is_settings('bot_image'); ?>" alt="bot_image" width="80" height="80"></div>
                                                    <?php } ?>
                                                    <div style="display: none" id="msg_bot_image" class="alert alert-danger"></div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label class="control-label"><?= lang('theme_color'); ?></label>
                                                    <input id="theme_color" name="theme_color" class="form-control" data-jscolor="{}" value="<?= isset($theme_color) && !empty($theme_color) ? $theme_color : "#f05387" ?>">
                                                    <small class="text-danger"><?= lang('note_avoid_to_use_white_like_color_text_will_not_be_visible'); ?></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label class="control-label"><?= lang('footer_copyright_text'); ?> </label>
                                                    <textarea id="footer-copyrights-text" name="footer_copyrights_text" class="form-control"><?php echo ($footer_copyrights_text) ? $footer_copyrights_text['message'] : "" ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-10">
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

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#full_file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#full_file').val('');
                    $('#msg_full_file').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#msg_full_file').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        $("#half_file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#half_file').val('');
                    $('#msg_half_file').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#msg_half_file').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });


        $("#background_file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#background_file').val('');
                    $('#msg_background_file').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#msg_background_file').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });


        $("#bot_image").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#bot_image').val('');
                    $('#msg_bot_image').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#msg_bot_image').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            tinymce.init({
                selector: '#footer-copyrights-text',
                height: 250,
                menubar: true,
                plugins: [
                    'advlist autolink lists link charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                setup: function(editor) {
                    editor.on("change keyup", function(e) {
                        editor.save();
                        $(editor.getElement()).trigger('change');
                    });
                }
            });
        });
    </script>



</body>

</html>