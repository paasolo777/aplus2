<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('system_settings'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('system_settings_for_app'); ?> <small class="text-small"><?= lang('note_that_this_will_directly_reflect_the_changes_in_app'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('system_timezone'); ?> <small class="text-danger">*</small></label>
                                                    <input type="hidden" id="system_timezone_gmt" name="system_timezone_gmt" value="<?php echo (!empty($system_timezone_gmt['message'])) ? $system_timezone_gmt['message'] : '-11:00'; ?>" aria-required="true">
                                                    <?php $options = getTimezoneOptions(); ?>
                                                    <select id="system_timezone" name="system_timezone" required class="form-control">
                                                        <?php foreach ($options as $option) { ?>
                                                            <option value="<?= $option[2] ?>" data-gmt="<?= $option['1']; ?>" <?= (isset($system_timezone['message']) && $system_timezone['message'] == $option[2]) ? 'selected' : ''; ?>><?= $option[2] ?> - GMT <?= $option[1] ?> - <?= $option[0] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('app_link'); ?></label>
                                                    <input type="url" id="app_link" name="app_link" class="form-control" value="<?php echo (!empty($app_link['message'])) ? $app_link['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('more_apps_link_your_google_ios_market_place_url'); ?></label>
                                                    <input type="url" id="more_apps" name="more_apps" class="form-control" value="<?php echo (!empty($more_apps['message'])) ? $more_apps['message'] : "" ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('ios_app_link'); ?></label>
                                                    <input type="url" id="ios_app_link" name="ios_app_link" class="form-control" value="<?php echo (!empty($ios_app_link['message'])) ? $ios_app_link['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('more_apps_link_your_ios_market_place_url'); ?></label>
                                                    <input type="url" id="ios_more_apps" name="ios_more_apps" class="form-control" value="<?php echo (!empty($ios_more_apps['message'])) ? $ios_more_apps['message'] : "" ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-2 col-xs-12">
                                                    <label class="control-label"><?= lang('refer_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" id="refer_coin" min="0" name="refer_coin" required class="form-control" value="<?php echo ($refer_coin) ? $refer_coin['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-2 col-xs-12">
                                                    <label class="control-label"><?= lang('earn_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" id="earn_coin" min="0" name="earn_coin" required class="form-control" value="<?php echo ($earn_coin) ? $earn_coin['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-2 col-xs-12">
                                                    <label class="control-label"><?= lang('app_version_android'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" id="app_version" name="app_version" required class="form-control" value="<?php echo (!empty($app_version['message'])) ? $app_version['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-2 col-xs-12">
                                                    <label class="control-label"><?= lang('app_version_ios'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" id="app_version_ios" name="app_version_ios" required class="form-control" value="<?php echo (!empty($app_version_ios['message'])) ? $app_version_ios['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('force_update_app'); ?></label><br>
                                                    <input type="checkbox" id="force_update_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($force_update) && $force_update['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>

                                                    <input type="hidden" id="force_update" name="force_update" value="<?= ($force_update) ? $force_update['message'] : 0; ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-2 col-xs-12">
                                                    <label class="control-label"><?= lang('true_value'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" id="true_value" name="true_value" required class="form-control" value="<?php echo ($true_value) ? $true_value['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-2 col-xs-12">
                                                    <label class="control-label"><?= lang('false_value'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" id="false_value" name="false_value" required class="form-control" value="<?php echo ($false_value) ? $false_value['message'] : "" ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-xs-12">
                                                    <label class="control-label"><?= lang('share_app_text'); ?> <small class="text-danger">*</small></label>
                                                    <textarea id="shareapp_text" name="shareapp_text" required class="form-control"><?= (!empty($shareapp_text['message'])) ? $shareapp_text['message'] : '' ?></textarea>
                                                </div>
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('app_maintenance'); ?></label><br>
                                                    <input type="checkbox" id="app_maintenance_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($app_maintenance) && $app_maintenance['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>

                                                    <input type="hidden" id="app_maintenance" name="app_maintenance" value="<?= ($app_maintenance) ? $app_maintenance['message'] : 0; ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-xs-12">
                                                    <h6 class="inner_heading"><strong><?= lang('quiz_mode'); ?></strong></h6>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('language_mode'); ?></label><br>
                                                    <input type="checkbox" id="language_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($language_mode) && $language_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>
                                                    <input type="hidden" id="language_mode" name="language_mode" value="<?= ($language_mode) ? $language_mode['message'] : 0; ?>">
                                                </div>
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('option_e_mode'); ?></label><br>
                                                    <input type="checkbox" id="option_e_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($option_e_mode) && $option_e_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>

                                                    <input type="hidden" id="option_e_mode" name="option_e_mode" value="<?= ($option_e_mode) ? $option_e_mode['message'] : 0; ?>">
                                                </div>

                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('daily_quiz_mode'); ?></label><br>
                                                    <input type="checkbox" id="daily_quiz_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($daily_quiz_mode) && $daily_quiz_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>

                                                    <input type="hidden" id="daily_quiz_mode" name="daily_quiz_mode" value="<?= ($daily_quiz_mode) ? $daily_quiz_mode['message'] : 0; ?>">
                                                </div>

                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('latex_mode'); ?></label><br>
                                                    <input type="checkbox" id="latex_mode_btn" data-plugin="switchery" <?php
                                                                                                                        if (!empty($latex_mode) && $latex_mode['message'] == '1') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                        ?>>

                                                    <input type="hidden" id="latex_mode" name="latex_mode" value="<?= ($latex_mode) ? $latex_mode['message'] : 0; ?>">
                                                </div>

                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('exam_latex_mode'); ?></label><br>
                                                    <input type="checkbox" id="exam_latex_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($exam_latex_mode) && $exam_latex_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>

                                                    <input type="hidden" id="exam_latex_mode" name="exam_latex_mode" value="<?= ($exam_latex_mode) ? $exam_latex_mode['message'] : 0; ?>">
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

    <script type="text/javascript">
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });
    </script>

    <script type="text/javascript">
        $('#system_timezone').on('change', function(e) {
            gmt = $(this).find(':selected').data('gmt');
            $('#system_timezone_gmt').val(gmt);

        });

        /* on change of language mode btn - switchery js */
        var changeCheckbox = document.querySelector('#language_mode_btn');
        changeCheckbox.onchange = function() {
            if (changeCheckbox.checked)
                $('#language_mode').val(1);
            else
                $('#language_mode').val(0);
        };
        /* on change of option e mode btn - switchery js */
        var changeCheckbox1 = document.querySelector('#option_e_mode_btn');
        changeCheckbox1.onchange = function() {
            if (changeCheckbox1.checked)
                $('#option_e_mode').val(1);
            else
                $('#option_e_mode').val(0);
        };

        /* on change of force update btn - switchery js */
        var changeCheckbox2 = document.querySelector('#force_update_btn');
        changeCheckbox2.onchange = function() {
            if (changeCheckbox2.checked)
                $('#force_update').val(1);
            else
                $('#force_update').val(0);
        };
        /* on change of daily quiz mode btn - switchery js */
        var changeCheckbox3 = document.querySelector('#daily_quiz_mode_btn');
        changeCheckbox3.onchange = function() {
            if (changeCheckbox3.checked)
                $('#daily_quiz_mode').val(1);
            else
                $('#daily_quiz_mode').val(0);
        };
        /* on change of contest mode btn - switchery js */


        /* on change of app maintenance btn - switchery js */
        var changeCheckbox7 = document.querySelector('#app_maintenance_btn');
        changeCheckbox7.onchange = function() {
            if (changeCheckbox7.checked)
                $('#app_maintenance').val(1);
            else
                $('#app_maintenance').val(0);
        };
        /* on change of app maintenance btn - switchery js */

        /* on change of latex mode btn - switchery js */
        var changeCheckbox4 = document.querySelector('#latex_mode_btn');
        changeCheckbox4.onchange = function() {
            if (changeCheckbox4.checked)
                $('#latex_mode').val(1);
            else {
                $('#latex_mode').val(0);
                <?php
                if (!empty($latex_mode) && $latex_mode['message'] == '1') {
                ?>
                    Swal.fire({
                        title: "<?= lang('are_you_sure_want_to_turn_off_latex_mode'); ?>",
                        text: "<?= lang('latex_off_message'); ?>",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "<?= lang('yes_remove_it'); ?>",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#latex_mode').val(0);
                        } else {
                            $("#latex_mode_btn").prop("checked", false).trigger("click");
                            changeCheckbox4.checked = true;
                        }
                    });
                <?php
                }
                ?>

                // if (confirm('Are you sure you want to turn off LaTeX mode? Once disabled, any questions or content requiring LaTeX formatting for mathematical or technical notation will not be properly formatted, and this change cannot be undone')) {
                //     $('#latex_mode').val(0);
                // } else {
                //     $("#latex_mode_btn").prop("checked", false).trigger("click");
                //     changeCheckbox4.checked = true;
            }
        };
        /* on change of latex mode btn - switchery js */


        /* on change of exam latex mode btn - switchery js */
        var changeCheckbox5 = document.querySelector('#exam_latex_mode_btn');
        changeCheckbox5.onchange = function() {
            if (changeCheckbox5.checked)
                $('#exam_latex_mode').val(1);
            else {
                $('#exam_latex_mode').val(0);
                <?php
                if (!empty($exam_latex_mode) && $exam_latex_mode['message'] == '1') {
                ?>
                    Swal.fire({
                        title: "<?= lang('are_you_sure_want_to_turn_off_latex_mode_in_exam_module'); ?>",
                        text: "<?= lang('latex_off_message'); ?>",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "<?= lang('yes_remove_it'); ?>",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#exam_latex_mode').val(0);
                        } else {
                            $("#exam_latex_mode_btn").prop("checked", false).trigger("click");
                            changeCheckbox5.checked = true;
                        }
                    });
                <?php
                }
                ?>
            }
        };
        /* on change of latex mode btn - switchery js */
    </script>




    <?php

    function getTimezoneOptions()
    {
        $list = DateTimeZone::listAbbreviations();
        $idents = DateTimeZone::listIdentifiers();

        $data = $offset = $added = array();
        foreach ($list as $abbr => $info) {
            foreach ($info as $zone) {
                if (!empty($zone['timezone_id']) and !in_array($zone['timezone_id'], $added) and in_array($zone['timezone_id'], $idents)) {
                    $z = new DateTimeZone($zone['timezone_id']);
                    $c = new DateTime('', $z);
                    $zone['time'] = $c->format('H:i a');
                    $offset[] = $zone['offset'] = $z->getOffset($c);
                    $data[] = $zone;
                    $added[] = $zone['timezone_id'];
                }
            }
        }

        array_multisort($offset, SORT_ASC, $data);
        $i = 0;
        $temp = array();
        foreach ($data as $key => $row) {
            $temp[0] = $row['time'];
            $temp[1] = formatOffset($row['offset']);
            $temp[2] = $row['timezone_id'];
            $options[$i++] = $temp;
        }
        return $options;
    }

    function formatOffset($offset)
    {
        $hours = $offset / 3600;
        $remainder = $offset % 3600;
        $sign = $hours > 0 ? '+' : '-';
        $hour = (int) abs($hours);
        $minutes = (int) abs($remainder / 60);

        if ($hour == 0 and $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0');
    }
    ?>

</body>

</html>