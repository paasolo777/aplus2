<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('questions_for_quiz'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

    <?php base_url() . include 'include.php'; ?>
    <link href="<?= base_url(); ?>assets/css/select2.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <?php base_url() . include 'header.php'; ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= lang('create_and_manage_questions'); ?></h1>
                        <?php
                        if ($this->uri->segment(2)) {
                        ?>
                            <div class="section-header-breadcrumb">
                                <a href="<?= base_url('manage-multi-match') ?>" class="footer_dev_link text-decoration-none">
                                    <h6>
                                        <i class="fa fa-arrow-left"></i>
                                        Back
                                    </h6>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_questions'); ?></h4>
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
                                            $sess_answer_type = "";
                                            $sess_answer = "";
                                            $selected_answer = [];
                                            if ($question_id != '') {
                                                $sess_language_id = (!empty($data)) ? $data[0]->language_id : 0;
                                                $sess_category = (!empty($data)) ? $data[0]->category : 0;
                                                $sess_subcategory = (!empty($data)) ? $data[0]->subcategory : 0;
                                                $sess_question_type = (!empty($data)) ? $data[0]->question_type : "";
                                                $sess_answer_type = (!empty($data)) ? $data[0]->answer_type : "";
                                                $sess_answer = (!empty($data)) ? $data[0]->answer : "";
                                                $selected_answer = (!empty($sess_answer)) ? explode(',', $sess_answer) : [];
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
                                                <input type="hidden" id="image_url" name="image_url" value="<?= ($question_id != '') ? ((!empty($data)) ? (($data[0]->image != '') ? MULTIMATCH_QUESTION_IMG_PATH . $data[0]->image : '') : '') : '' ?>">
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
                                                        <label class="control-label"><?= lang('sub_category'); ?> <small class="text-danger">*</small></label>
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
                                                                <option value="<?= $cat->id ?>"><?= $cat->is_premium == 1 ? $cat->category_name . ' - Premium' : $cat->category_name ?></option>
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
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('question_type'); ?> <small class="text-danger">*</small></label>
                                                    <div>
                                                        <div class="form-check-inline bg-light p-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="question_type" value="1" <?= ($question_id ==  '') ? 'checked' : '' ?> <?= (!empty($data)) ? (($data[0]->question_type == '1') ? 'checked' : '') : '' ?> required><?= lang('options'); ?>
                                                            </label>
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="question_type" value="2" <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->question_type == '2') ? 'checked' : '') : '') : '' ?>><?= lang('true_false'); ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-12">
                                                    <label class="control-label"><?= lang('answer_type'); ?> <small class="text-danger">*</small></label>
                                                    <div>
                                                        <div class="form-check-inline bg-light p-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="answer_type" value="1" <?= ($question_id ==  '') ? 'checked' : '' ?> <?= (!empty($data)) ? (($data[0]->answer_type == '1') ? 'checked' : '') : '' ?> required><?= lang('multiselect'); ?>
                                                            </label>
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="answer_type" value="2" <?= ($question_id !=  '') ? ((!empty($data)) ? (($data[0]->answer_type == '2') ? 'checked' : '') : '') : '' ?>><?= lang('sequence'); ?>
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
                                                            <img src="<?= base_url() . MULTIMATCH_QUESTION_IMG_PATH . $data[0]->image ?>" alt="logo" width="40" height="40">
                                                            <button type="button" class="btn btn-sm btn-danger" data-id="<?= $data[0]->id ?>" data-image='<?= MULTIMATCH_QUESTION_IMG_PATH . $data[0]->image ?>' id="removeImage"><i class="fa fa-times"></i></button>
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
                                                <div class="form-group col-md-6 col-sm-12" id="option1_answer1">
                                                    <label class="control-label"><?= lang('answer'); ?> <small class="text-danger">*</small></label><br>
                                                    <select name='answer[]' id="answer1" class='form-control select2' data-placeholder="<?= lang('select_right_answer'); ?>" required multiple="multiple">
                                                        <option value='a' <?= in_array('a', $selected_answer) && ((!empty($data)) ? (($data[0]->question_type == '1') ? true : false) : false) ? 'selected' : '' ?>><?= lang('a'); ?></option>
                                                        <option value='b' <?= in_array('b', $selected_answer) && ((!empty($data)) ? (($data[0]->question_type == '1') ? true : false) : false) ? 'selected' : '' ?>><?= lang('b'); ?></option>
                                                        <option value='c' <?= in_array('c', $selected_answer) && ((!empty($data)) ? (($data[0]->question_type == '1') ? true : false) : false) ? 'selected' : '' ?>><?= lang('c'); ?></option>
                                                        <option value='d' <?= in_array('d', $selected_answer) && ((!empty($data)) ? (($data[0]->question_type == '1') ? true : false) : false) ? 'selected' : '' ?>><?= lang('d'); ?></option>
                                                        <?php if (is_option_e_mode_enabled()) { ?>
                                                            <option value='e' <?= in_array('e', $selected_answer) ? 'selected' : '' ?>><?= lang('e'); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12" id="option2_answer1">
                                                    <label class="control-label"><?= lang('answer'); ?></label><br>
                                                    <select name='answer[]' id="answer_tf" class='form-control select2' data-placeholder="<?= lang('select_right_answer'); ?>" multiple="multiple">
                                                        <option value='a' <?= in_array('a', $selected_answer) && ((!empty($data)) ? (($data[0]->question_type == '2') ? true : false) : false) ? 'selected' : '' ?>><?= lang('a'); ?></option>
                                                        <option value='b' <?= in_array('b', $selected_answer) && ((!empty($data)) ? (($data[0]->question_type == '2') ? true : false) : false) ? 'selected' : '' ?>><?= lang('b'); ?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 answer_order" id="option1_answer2">
                                                    <label class="control-label"><?= lang('answer'); ?></label>
                                                    <input type='text' name='text_answer' class='form-control answer_type2' value="<?= $sess_answer ?>">
                                                    <ol id="sortable-row" class="mt-3">
                                                        <li id=a><?= lang('a'); ?></li>
                                                        <li id=b><?= lang('b'); ?></li>
                                                        <li id=c><?= lang('c'); ?></li>
                                                        <li id=d><?= lang('d'); ?></li>
                                                        <?php if (is_option_e_mode_enabled()) { ?>
                                                            <li id=e><?= lang('e'); ?></li>
                                                        <?php } ?>
                                                    </ol>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 answer_order" id="option2_answer2">
                                                    <label class="control-label"><?= lang('answer'); ?></label>
                                                    <input type='text' name='text_answer' class='form-control answer_type2' value="<?= $sess_answer ?>">
                                                    <ol id="sortable-row-1" class="mt-3">
                                                        <li id=a><?= lang('a'); ?></li>
                                                        <li id=b><?= lang('b'); ?></li>
                                                    </ol>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('level'); ?> <small class="text-danger">*</small></label>
                                                    <input type='number' name='level' class='form-control' required min="1" value="<?= ($question_id !=  '') ? ((!empty($data)) ? $data[0]->level : '') : "" ?>">
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
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="<?= base_url(); ?>assets/js/select2.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('#removeImage').on('click', function(e) {
            table = "tbl_question";
            id = $(this).data("id");
            image = $(this).data("image");
            removeImage(id, image, table)
        });
    </script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        var type = 'multi-match-subcategory';
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
                    if (language_id == row_language_id && row_category != 0)
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
                    if (category_id == row_category && row_subcategroy != 0)
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

    <script>
        $(function() {
            // Initialize sortable for both lists
            $("#sortable-row, #sortable-row-1").sortable({
                update: function(event, ui) {
                    saveOrder($(this).attr("id"));
                }
            });
        });

        function saveOrder(listId) {
            var selectedOrder = [];
            // Get the IDs of list items for the updated sortable list
            $(`ol#${listId} li`).each(function() {
                selectedOrder.push($(this).attr("id"));
            });
            // Update the value of .answer_type2 with the selected order
            $('.answer_type2').val(selectedOrder.join(','));
        }
    </script>

    <script type="text/javascript">
        var answer = "<?= $sess_answer ?>"

        $(".select2").each(function() {
            $(this).select2({
                placeholder: $(this).data('placeholder')
            });
        });

        function updateOptions(questionType, answerType) {
            $('#option1_answer1,#option1_answer2, #option2_answer1, #option2_answer2').hide('fast');

            if (questionType == 1 && answerType == 1) {
                $('#option1_answer1').show('fast');
                $('#tf').show('fast');
                $('#answer_tf').removeAttr('required');
                $('#answer1').attr("required", "required");
                $('#c').attr("required", "required");
                $('#d').attr("required", "required");
                <?php if (is_option_e_mode_enabled()) { ?>
                    $('#e').attr("required", "required");
                <?php } ?>
                $('.answer_type2').val('').removeAttr('readonly');
            } else if (questionType == 1 && answerType == 2) {
                $('#option1_answer2').show('fast');
                $('#tf').show('fast');
                $('#answer_tf').removeAttr('required');
                $('#answer1').removeAttr("required");
                $('#c').attr("required", "required");
                $('#d').attr("required", "required");
                answerType = 'a,b,c,d';
                <?php if (is_option_e_mode_enabled()) { ?>
                    $('#e').attr("required", "required");
                    answerType += ',e';
                <?php } ?>
                $('.answer_type2').val(answerType).attr('readonly', 'readonly');
            } else if (questionType == 2 && answerType == 1) {
                $('#option2_answer1').show('fast');
                $('#tf').hide('fast');
                $('#answer1').removeAttr('required');
                $('#answer_tf').attr("required", "required");
                $('#c').removeAttr('required');
                $('#d').removeAttr('required');
                <?php if (is_option_e_mode_enabled()) { ?>
                    $('#e').removeAttr('required');
                <?php } ?>
                $('.answer_type2').val('').removeAttr('readonly');
            } else if (questionType == 2 && answerType == 2) {
                $('#option2_answer2').show('fast');
                $('#tf').hide('fast');
                $('#answer1').removeAttr('required');
                $('#answer_tf').removeAttr('required');
                $('#c').removeAttr('required');
                $('#d').removeAttr('required');
                <?php if (is_option_e_mode_enabled()) { ?>
                    $('#e').removeAttr('required');
                <?php } ?>
                answerType = 'a,b';
                $('.answer_type2').val(answerType).attr('readonly', 'readonly');
            }
        }
        $(document).ready(function() {
            if (!<?= json_encode($question_id) ?>) {
                $('#option1_answer2, #option2_answer1, #option2_answer2').hide('fast');
            }
            $('input[name="question_type"], input[name="answer_type"]').on("click", function() {
                var questionType = $('input[name="question_type"]:checked').val();
                var answerType = $('input[name="answer_type"]:checked').val();
                $('.answer_type2').val('').removeAttr('readonly');
                updateOptions(questionType, answerType);
            });
        });

        if (<?= json_encode($question_id) ?>) {
            var questionType = "<?= $sess_question_type ?>"
            var answerType = "<?= $sess_answer_type ?>"
            if (answerType == 2) {
                if (questionType == 1) {
                    var elems = $('ol#sortable-row').children('li');
                    $('ol#sortable-row').html();
                    var newOrder = (answer).split(',');
                    var temp = [];
                    for (i = 0; i < newOrder.length; i++) {
                        for (j = 0; j < elems.length; j++) {
                            if (elems[j].id === newOrder[i]) {
                                temp.push(elems[j]);
                                break;
                            }

                        }
                    }
                    $('ol#sortable-row').prepend(temp);

                } else if (questionType == 2) {
                    var elems = $('ol#sortable-row-1').children('li');
                    $('ol#sortable-row-1').html();
                    var newOrder = (answer).split(',');
                    var temp = [];
                    for (i = 0; i < newOrder.length; i++) {
                        for (j = 0; j < elems.length; j++) {
                            if (elems[j].id === newOrder[i]) {
                                temp.push(elems[j]);
                                break;
                            }

                        }
                    }
                    $('ol#sortable-row-1').prepend(temp);
                }
            }
            updateOptions(questionType, answerType);
        }
    </script>

</body>

</html>