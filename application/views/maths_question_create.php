<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('questions_for_maths_quiz'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_maths_questions'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_math_questions'); ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="frmQuestion" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <?php
                                            $question_id = $this->uri->segment(2);
                                            $sess_language_id = '0';
                                            $sess_category = '0';
                                            $sess_subcategory = '0';
                                            $sess_question_type = "";
                                            if ($question_id != '') {
                                                $sess_language_id = (!empty($data)) ? $data[0]->language_id : 0;
                                                $sess_category = (!empty($data)) ? $data[0]->category : 0;
                                                $sess_subcategory = (!empty($data)) ? $data[0]->subcategory : 0;
                                                $sess_question_type = (!empty($data)) ? $data[0]->question_type : "";
                                            } else if ($this->session->userdata()) {
                                                $type = $this->uri->segment(1);
                                                $sess_data = $this->session->userdata("$type");
                                                if (!empty($sess_data)) {
                                                    $sess_language_id = $sess_data['language_id'];
                                                    $sess_category = $sess_data['category'];
                                                    $sess_subcategory = $sess_data['subcategory'];
                                                }
                                            }
                                            ?>
                                            <?php if ($question_id != '') { ?>
                                                <input type="hidden" id="edit_id" name="edit_id" required value="<?= $question_id ?>" aria-required="true">
                                                <input type="hidden" id="image_url" name="image_url" value="<?= ($question_id != '') ? ((!empty($data)) ? (($data[0]->image != '') ? MATHS_QUESTION_IMG_PATH . $data[0]->image : '') : '') : '' ?>">
                                            <?php } ?>
                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select name="language_id" id="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                                        <select id="category" name="category" class="form-control" required>
                                                            <option value=""><?= lang('select_main_category'); ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('sub_category'); ?></label>
                                                        <select id="subcategory" name="subcategory" class="form-control">
                                                            <option value=""><?= lang('select_sub_category'); ?></option>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                                        <select id="category" name="category" class="form-control" required>
                                                            <option value=""><?= lang('select_main_category'); ?></option>
                                                            <?php foreach ($category as $cat) { ?>
                                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('sub_category'); ?></label>
                                                        <select id="subcategory" name="subcategory" class="form-control">
                                                            <option value=""><?= lang('select_sub_category'); ?></option>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('question'); ?> <small class="text-danger">*</small></label>
                                                    <textarea id="question" name="question" class="form-control" required><?= ($question_id != '') ? ((!empty($data)) ? $data[0]->question : '') : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('question_type'); ?> <small class="text-danger">*</small></label>
                                                    <div>
                                                        <div class="form-check-inline bg-light p-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="question_type" value="1" <?= ($question_id ==  '') ? 'checked' : '' ?> <?= (!empty($data)) ? (($data[0]->question_type == '1') ? 'checked' : '') : '' ?> required> <?= lang('options'); ?>
                                                            </label>
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="question_type" value="2" <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->question_type == '2') ? 'checked' : '') : '') : '' ?>> <?= lang('true_false'); ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('image_for_question'); ?> <small><?= lang('if_any'); ?></small></label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                    <?php if ($question_id != '' && isset($data[0]->image) && !empty($data[0]->image)) { ?>
                                                        <div class="m-2" id="imageView">
                                                            <img src="<?= base_url() . MATHS_QUESTION_IMG_PATH . $data[0]->image ?>" alt="logo" width="40" height="40">
                                                            <button type="button" class="btn btn-sm btn-danger" data-id="<?= $data[0]->id ?>" data-image='<?= MATHS_QUESTION_IMG_PATH . $data[0]->image ?>' id="removeImage"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="control-label"><?= lang('option_a'); ?> <small class="text-danger">*</small></label>
                                                    <textarea class="form-control" id="a" name="a" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optiona : '') : '' ?></textarea>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="control-label"><?= lang('option_b'); ?> <small class="text-danger">*</small></label>
                                                    <textarea class="form-control" id="b" name="b" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optionb : '') : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div id="tf">
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label class="control-label"><?= lang('option_c'); ?> <small class="text-danger">*</small></label>
                                                        <textarea class="form-control" id="c" name="c" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optionc : '') : '' ?></textarea>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label class="control-label"><?= lang('option_d'); ?> <small class="text-danger">*</small></label>
                                                        <textarea class="form-control" id="d" name="d" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optiond : '') : '' ?></textarea>
                                                    </div>
                                                </div>
                                                <?php if (is_option_e_mode_enabled()) { ?>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label class="control-label"><?= lang('option_e'); ?> <small class="text-danger">*</small></label>
                                                            <textarea class="form-control" id="e" name="e" required><?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->optione : '') : '' ?></textarea>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('answer'); ?> <small class="text-danger">*</small></label>
                                                    <select name='answer' id='answer' class='form-control' required>
                                                        <option value=''><?= lang('select_right_answer'); ?></option>
                                                        <option value='a' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'a') ? 'selected' : '') : '') : '' ?>><?= lang('a'); ?></option>
                                                        <option value='b' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'b') ? 'selected' : '') : '') : '' ?>><?= lang('b'); ?></option>
                                                        <option class='ntf' value='c' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'c') ? 'selected' : '') : '') : '' ?>><?= lang('c'); ?></option>
                                                        <option class='ntf' value='d' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'd') ? 'selected' : '') : '') : '' ?>><?= lang('d'); ?></option>
                                                        <?php if (is_option_e_mode_enabled()) { ?>
                                                            <option class='ntf' value='e' <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer == 'e') ? 'selected' : '') : '') : '' ?>><?= lang('e'); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('note'); ?></label>
                                                    <small><?= lang('this_will_be_showing_with_review_selection_only'); ?></small>
                                                    <textarea name='note' id="note" class='form-control'><?= ($question_id != '') ? ((!empty($data)) ? $data[0]->note : '') : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
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
    <?php base_url(include 'ckeditor.php') ?>

    <script>
        if (!<?= json_encode($question_id) ?>) {
            ckeditor_initialize('', true);
        }
    </script>

    <script type="text/javascript">
        function questionType2Setting() {
            $('#tf').hide('fast');
            $('#c').removeAttr('required');
            $('#d').removeAttr('required');
            $('#e').removeAttr('required');
            $('.ntf').hide('fast');
            $(document).ready(function() {
                ckeditor_initialize(2, true);
            });
        }

        function questionType1Setting() {
            $('#tf').show('fast');
            $('.ntf').show('fast');
            $('#c').attr("required", "required");
            $('#d').attr("required", "required");
            $('#e').attr("required", "required");
            $(document).ready(function() {
                ckeditor_initialize(1, true);
            });
        }

        $('input[name="question_type"]').on("click", function(e) {
            var question_type = $(this).val();
            if (question_type == "2") {
                $('#answer').val('');
                questionType2Setting()
            } else {
                $('#answer').val('');
                questionType1Setting()
            }
        });
        if (<?= json_encode($question_id) ?>) {
            var question_type = "<?= $sess_question_type ?>"
            if (question_type == "2") {
                questionType2Setting()
            } else {
                questionType1Setting()
            }
        }
    </script>

    <script type="text/javascript">
        $('#removeImage').on('click', function(e) {
            table = "tbl_maths_question";
            id = $(this).data("id");
            image = $(this).data("image");
            removeImage(id, image, table)
        });
    </script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        var type = 'maths-question-subcategory';
        var sess_language_id = '<?= $sess_language_id ?>';
        var sess_category = '<?= $sess_category ?>';
        var sess_subcategory = '<?= $sess_subcategory ?>';
        $(document).ready(function() {
            if (sess_language_id != '0' || sess_category != '0') {
                <?php if (is_language_mode_enabled()) { ?>
                    $('#language_id').val(sess_language_id).trigger("change", [sess_language_id, sess_category, sess_subcategory]);
                <?php } else { ?>
                    $('#category').val(sess_category).trigger("change", [sess_category, sess_subcategory]);
                <?php } ?>
            }
        });
        $('#language_id').on('change', function(e, row_language_id, row_category, row_subcategory) {
            var language_id = $('#language_id').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#category').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#category').html(result).trigger("change");
                    if (language_id == row_language_id && (row_category != '0' || row_category != 0))
                        $('#category').val(row_category).trigger("change", [row_category, row_subcategory]);
                }
            });
        });

        $('#category').on('change', function(e, row_category, row_subcategroy) {
            var category_id = $('#category').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_subcategories_of_category',
                data: 'category_id=' + category_id,
                beforeSend: function() {
                    $('#subcategory').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#subcategory').html(result);
                    if (category_id == row_category && (row_subcategroy != "0" || row_subcategroy != 0))
                        $('#subcategory').val(row_subcategroy);
                }
            });
        });
    </script>

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#file').val('');
                    $('#img_error_msg').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#img_error_msg').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });
    </script>
</body>

</html>