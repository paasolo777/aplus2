<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('system_utilities'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('system_utilities'); ?> <small class="text-small"><?= lang('system_utilities_for_app'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('general_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- Maximum Wining Coins -->
                                                <div class="form-group col-md-3 col-sm-12 mt-2">
                                                    <label class="control-label"><?= lang('maximum_winning_coins'); ?> <small class="text-danger">*</small></label>
                                                    <input name="maximum_winning_coins" type="number" min=1 class="form-control" value="<?php echo (!empty($maximum_winning_coins['message'])) ? $maximum_winning_coins['message'] : 4 ?>" required>
                                                </div>

                                                <!-- Minimum Coin Winning Percentage -->
                                                <div class="form-group col-md-3 col-sm-12 mt-2">
                                                    <label class="control-label"><?= lang('minimum_winning_percentage'); ?> <small class="text-danger">*</small></label>
                                                    <input name="minimum_coins_winning_percentage" type="number" min=1 class="form-control" value="<?php echo (!empty($minimum_coins_winning_percentage['message'])) ? $minimum_coins_winning_percentage['message'] : 70 ?>" required>
                                                </div>

                                                <!-- Quiz Winning Percentage -->
                                                <div class="form-group col-md-3 col-sm-12 mt-2">
                                                    <label class="control-label"><?= lang('quiz_winning_percentage'); ?> <small class="text-danger">*</small></label>
                                                    <input name="quiz_winning_percentage" type="number" min=0 class="form-control" value="<?php echo ($quiz_winning_percentage['message'] != null) ? $quiz_winning_percentage['message'] : 30 ?>" required>
                                                </div>

                                                <!-- Score -->
                                                <div class="form-group col-md-3 col-sm-12 mt-2">
                                                    <label class="control-label"><?= lang('score'); ?> <small class="text-danger">*</small></label>
                                                    <input name="score" type="number" min=1 class="form-control" value="<?php echo (!empty($score['message'])) ? $score['message'] : 4 ?>" required>
                                                </div>

                                                <!-- Answer Mode -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('answer_mode'); ?> <small class="text-danger">*</small></label>
                                                    <select id="answer_mode" name="answer_mode" class="form-control" required>
                                                        <option value="1"> <?= lang('show_answer_correctness'); ?></option>
                                                        <option value="2"> <?= lang('don_not_show_answer_correctness'); ?></option>
                                                        <option value="3"> <?= lang('show_answer_correctness_show_correct_answer'); ?></option>
                                                    </select>
                                                    <input type="hidden" id="answer_mode_value" value="<?php echo (!empty($answer_mode['message'])) ? $answer_mode['message'] : 1 ?>">
                                                </div>

                                                <!-- Review Answer Deduct Coins -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('review_answers_deduct'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="review_answers_deduct_coin" min="1" name="review_answers_deduct_coin" required class="form-control" value="<?php echo isset($review_answers_deduct_coin) ? $review_answers_deduct_coin['message'] : "" ?>">
                                                </div>

                                                <!-- Welcome Bonus -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('welcome_bonus'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="welcome_bonus_coin" min="1" name="welcome_bonus_coin" required class="form-control" value="<?php echo isset($welcome_bonus_coin) ? $welcome_bonus_coin['message'] : "" ?>">
                                                </div>

                                                <!-- Question Shuffle Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('question_shuffle'); ?></label><br>
                                                    <input type="checkbox" id="question_shuffle_mode_btn" data-plugin="switchery" <?= isset($question_shuffle_mode) && !empty($question_shuffle_mode) && $question_shuffle_mode['message'] == '1' ? 'checked' : "" ?>>
                                                    <input type="hidden" id="question_shuffle_mode" name="question_shuffle_mode" value="<?= isset($question_shuffle_mode) && !empty($question_shuffle_mode) ? $question_shuffle_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- Option Shuffle Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('option_shuffle'); ?></label><br>
                                                    <input type="checkbox" id="option_shuffle_mode_btn" data-plugin="switchery" <?= isset($option_shuffle_mode) && !empty($option_shuffle_mode) && $option_shuffle_mode['message'] == '1' ? 'checked' : "" ?>>
                                                    <input type="hidden" id="option_shuffle_mode" name="option_shuffle_mode" value="<?= isset($option_shuffle_mode) && !empty($option_shuffle_mode) ? $option_shuffle_mode['message'] : 0; ?>">
                                                </div>

                                            </div>
                                            <hr class="row">

                                            <!-- Quiz Zone Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('quiz_zone_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">

                                                <!-- Quiz Zone Visiblity Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="quiz_zone_mode_btn" data-plugin="switchery" <?php isset($quiz_zone_mode) && !empty($quiz_zone_mode) && $quiz_zone_mode['message'] == '1' ? print_r('checked') : "" ?>>
                                                    <input type="hidden" id="quiz_zone_mode" name="quiz_zone_mode" value="<?= isset($quiz_zone_mode) && !empty($quiz_zone_mode) ? $quiz_zone_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- Quiz Zone Fix Level Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question_in_level'); ?></label><br>
                                                    <input type="checkbox" id="quiz_zone_fix_level_question_btn" data-plugin="switchery" <?php (isset($quiz_zone_fix_level_question) && !empty($quiz_zone_fix_level_question) && $quiz_zone_fix_level_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="quiz_zone_fix_level_question" name="quiz_zone_fix_level_question" value="<?= (isset($quiz_zone_fix_level_question) && !empty($quiz_zone_fix_level_question)) ? $quiz_zone_fix_level_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Quiz Zone Total Level Question -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="quiz_zone_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_per_level'); ?></label>
                                                    <input type="number" min="1" id="quiz_zone_total_level_question" name="quiz_zone_total_level_question" class="form-control" value="<?php echo (isset($quiz_zone_total_level_question) && !empty($quiz_zone_total_level_question)) ? $quiz_zone_total_level_question['message'] : '10' ?>">
                                                </div>

                                                <!-- Quiz Zone Durtaion -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('quiz_zone_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="quiz_zone_duration" type="number" min=1 class="form-control" value="<?php echo (!empty($quiz_zone_duration['message'])) ? $quiz_zone_duration['message'] : "30" ?>" required>
                                                </div>

                                                <!-- Lifeline Coins Deduction -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('lifeline_deduct'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="quiz_zone_lifeline_deduct_coin" min="1" name="quiz_zone_lifeline_deduct_coin" required class="form-control" value="<?php echo isset($quiz_zone_lifeline_deduct_coin) ? $quiz_zone_lifeline_deduct_coin['message'] : "" ?>">
                                                </div>

                                                <!-- Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="quiz_zone_wrong_answer_deduct_score" min="1" name="quiz_zone_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($quiz_zone_wrong_answer_deduct_score) ? $quiz_zone_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="quiz_zone_correct_answer_credit_score" min="1" name="quiz_zone_correct_answer_credit_score" required class="form-control" value="<?php echo isset($quiz_zone_correct_answer_credit_score) ? $quiz_zone_correct_answer_credit_score['message'] : "" ?>">
                                                </div>
                                            </div>

                                            <hr class="row">
                                            <!-- Guess The Word Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('guess_the_word_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="guess_the_word_btn" data-plugin="switchery" <?php isset($guess_the_word_question) && !empty($guess_the_word_question) && $guess_the_word_question['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="guess_the_word_question" name="guess_the_word_question" value="<?= isset($guess_the_word_question) && !empty($guess_the_word_question) ? $guess_the_word_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Guess the word Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="guess_the_word_fix_question_btn" data-plugin="switchery" <?php (isset($guess_the_word_fix_question) && !empty($guess_the_word_fix_question) && $guess_the_word_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="guess_the_word_fix_question" name="guess_the_word_fix_question" value="<?= (isset($guess_the_word_fix_question) && !empty($guess_the_word_fix_question)) ? $guess_the_word_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Guess The Word Total Level Question -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="guess_the_word_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="guess_the_word_total_question" name="guess_the_word_total_question" class="form-control" value="<?php echo (isset($guess_the_word_total_question) && !empty($guess_the_word_total_question)) ? $guess_the_word_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- Guess The Word Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('guess_the_word_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="guess_the_word_seconds" type="number" min=1 class="form-control" value="<?php echo (!empty($guess_the_word_seconds['message'])) ? $guess_the_word_seconds['message'] : 60 ?>" required>
                                                </div>

                                                <!-- Guess The Word Max Hints -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('max_hints_per_quiz_question'); ?> <small class="text-danger">*</small></label>
                                                    <input name="guess_the_word_max_hints" type="number" min=1 class="form-control" value="<?php echo (!empty($guess_the_word_max_hints['message'])) ? $guess_the_word_max_hints['message'] : 60 ?>" required>
                                                </div>

                                                <!-- Guess The Word Max Winning -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('guess_the_word_max_winning'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="guess_the_word_max_winning_coin" min="1" name="guess_the_word_max_winning_coin" required class="form-control" value="<?php echo isset($guess_the_word_max_winning_coin) ? $guess_the_word_max_winning_coin['message'] : "" ?>">
                                                </div>

                                                <!-- Guess The Word Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="guess_the_word_wrong_answer_deduct_score" min="1" name="guess_the_word_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($guess_the_word_wrong_answer_deduct_score) ? $guess_the_word_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Guess The Word Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="guess_the_word_correct_answer_credit_score" min="1" name="guess_the_word_correct_answer_credit_score" required class="form-control" value="<?php echo isset($guess_the_word_correct_answer_credit_score) ? $guess_the_word_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                                <!-- Guess The Word Max Hints Per Quiz's Question -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('hint_deduct_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="guess_the_word_hint_deduct_coin" min="1" name="guess_the_word_hint_deduct_coin" required class="form-control" value="<?php echo isset($guess_the_word_hint_deduct_coin) ? $guess_the_word_hint_deduct_coin['message'] : "" ?>">
                                                </div>
                                            </div>


                                            <hr class="row">
                                            <!-- Audio Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('audio_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- Audio Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="audio_mode_btn" data-plugin="switchery" <?php isset($audio_mode_question) && !empty($audio_mode_question) && $audio_mode_question['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="audio_mode_question" name="audio_mode_question" value="<?= isset($audio_mode_question) && !empty($audio_mode_question) ? $audio_mode_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Audio Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="audio_quiz_fix_question_btn" data-plugin="switchery" <?php (isset($audio_quiz_fix_question) && !empty($audio_quiz_fix_question) && $audio_quiz_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="audio_quiz_fix_question" name="audio_quiz_fix_question" value="<?= (isset($audio_quiz_fix_question) && !empty($audio_quiz_fix_question)) ? $audio_quiz_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Audio Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="audio_quiz_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="audio_quiz_total_question" name="audio_quiz_total_question" class="form-control" value="<?php echo (isset($audio_quiz_total_question) && !empty($audio_quiz_total_question)) ? $audio_quiz_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- Audio Quiz Total Time of file -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="fix_audio_time">
                                                    <label class="control-label"><?= lang('total_audio_time_of_file'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input type="number" min="1" id="total_audio_time" name="total_audio_time" required class="form-control" value="<?php echo isset($total_audio_time) && !empty($total_audio_time) ? $total_audio_time['message'] : '' ?>">
                                                </div>

                                                <!-- Audio Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('audio_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="audio_quiz_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($audio_quiz_seconds) && !empty($audio_quiz_seconds['message'])) ? $audio_quiz_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- Audio Quiz Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="audio_quiz_wrong_answer_deduct_score" min="1" name="audio_quiz_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($audio_quiz_wrong_answer_deduct_score) ? $audio_quiz_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Audio Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="audio_quiz_correct_answer_credit_score" min="1" name="audio_quiz_correct_answer_credit_score" required class="form-control" value="<?php echo isset($audio_quiz_correct_answer_credit_score) ? $audio_quiz_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                            </div>


                                            <hr class="row">
                                            <!-- Maths Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('maths_quiz_duaration'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- Maths Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="maths_quiz_mode_btn" data-plugin="switchery" <?php isset($maths_quiz_mode) && !empty($maths_quiz_mode) && $maths_quiz_mode['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="maths_quiz_mode" name="maths_quiz_mode" value="<?= isset($maths_quiz_mode) && !empty($maths_quiz_mode) ? $maths_quiz_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- Maths Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="maths_quiz_fix_question_btn" data-plugin="switchery" <?php (isset($maths_quiz_fix_question) && !empty($maths_quiz_fix_question) && $maths_quiz_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="maths_quiz_fix_question" name="maths_quiz_fix_question" value="<?= (isset($maths_quiz_fix_question) && !empty($maths_quiz_fix_question)) ? $maths_quiz_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Maths Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="maths_quiz_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="maths_quiz_total_question" name="maths_quiz_total_question" class="form-control" value="<?php echo (isset($maths_quiz_total_question) && !empty($maths_quiz_total_question)) ? $maths_quiz_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- Maths Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('maths_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="maths_quiz_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($maths_quiz_seconds) && !empty($maths_quiz_seconds['message'])) ? $maths_quiz_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- Maths Quiz Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="maths_quiz_wrong_answer_deduct_score" min="1" name="maths_quiz_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($maths_quiz_wrong_answer_deduct_score) ? $maths_quiz_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Maths Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="maths_quiz_correct_answer_credit_score" min="1" name="maths_quiz_correct_answer_credit_score" required class="form-control" value="<?php echo isset($maths_quiz_correct_answer_credit_score) ? $maths_quiz_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                            </div>


                                            <hr class="row">
                                            <!-- Fun N Learn Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('fun_n_learn_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- Fun N Learn Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="fun_n_learn_btn" data-plugin="switchery" <?php isset($fun_n_learn_question) && !empty($fun_n_learn_question) && $fun_n_learn_question['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="fun_n_learn_question" name="fun_n_learn_question" value="<?= isset($fun_n_learn_question) && !empty($fun_n_learn_question) ? $fun_n_learn_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Fun N Learn Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="fun_n_learn_quiz_fix_question_btn" data-plugin="switchery" <?php (isset($fun_n_learn_quiz_fix_question) && !empty($fun_n_learn_quiz_fix_question) && $fun_n_learn_quiz_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="fun_n_learn_quiz_fix_question" name="fun_n_learn_quiz_fix_question" value="<?= (isset($fun_n_learn_quiz_fix_question) && !empty($fun_n_learn_quiz_fix_question)) ? $fun_n_learn_quiz_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Fun N Learn Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="fun_n_learn_quiz_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="fun_n_learn_quiz_total_question" name="fun_n_learn_quiz_total_question" class="form-control" value="<?php echo (isset($fun_n_learn_quiz_total_question) && !empty($fun_n_learn_quiz_total_question)) ? $fun_n_learn_quiz_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- Fun N Learn Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fun_n_learn_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="fun_and_learn_time_in_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($fun_and_learn_time_in_seconds) && !empty($fun_and_learn_time_in_seconds['message'])) ? $fun_and_learn_time_in_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- Fun N Learn Quiz Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="fun_n_learn_quiz_wrong_answer_deduct_score" min="1" name="fun_n_learn_quiz_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($fun_n_learn_quiz_wrong_answer_deduct_score) ? $fun_n_learn_quiz_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Fun N Learn Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="fun_n_learn_quiz_correct_answer_credit_score" min="1" name="fun_n_learn_quiz_correct_answer_credit_score" required class="form-control" value="<?php echo isset($fun_n_learn_quiz_correct_answer_credit_score) ? $fun_n_learn_quiz_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                            </div>


                                            <hr class="row">
                                            <!-- True False Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('true_false_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- True False Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="true_false_btn" data-plugin="switchery" <?php isset($true_false_mode) && !empty($true_false_mode) && $true_false_mode['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="true_false_mode" name="true_false_mode" value="<?= isset($true_false_mode) && !empty($true_false_mode) ? $true_false_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- True False Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="true_false_quiz_fix_question_btn" data-plugin="switchery" <?php (isset($true_false_quiz_fix_question) && !empty($true_false_quiz_fix_question) && $true_false_quiz_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="true_false_quiz_fix_question" name="true_false_quiz_fix_question" value="<?= (isset($true_false_quiz_fix_question) && !empty($true_false_quiz_fix_question)) ? $true_false_quiz_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- True False Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="true_false_quiz_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="true_false_quiz_total_question" name="true_false_quiz_total_question" class="form-control" value="<?php echo (isset($true_false_quiz_total_question) && !empty($true_false_quiz_total_question)) ? $true_false_quiz_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- True False Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('true_false_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="true_false_quiz_in_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($true_false_quiz_in_seconds) && !empty($true_false_quiz_in_seconds['message'])) ? $true_false_quiz_in_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- True False Quiz Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="true_false_quiz_wrong_answer_deduct_score" min="1" name="true_false_quiz_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($true_false_quiz_wrong_answer_deduct_score) ? $true_false_quiz_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- True False Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="true_false_quiz_correct_answer_credit_score" min="1" name="true_false_quiz_correct_answer_credit_score" required class="form-control" value="<?php echo isset($true_false_quiz_correct_answer_credit_score) ? $true_false_quiz_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                            </div>

                                            <hr class="row">
                                            <!-- 1 vs 1 Battle Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('1_vs_1_battle_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- 1 vs 1 Battle Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_one_btn" data-plugin="switchery" <?php isset($battle_mode_one) && !empty($battle_mode_one) && $battle_mode_one['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="battle_mode_one" name="battle_mode_one" value="<?= isset($battle_mode_one) && !empty($battle_mode_one) ? $battle_mode_one['message'] : 0; ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Category Mode Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('category_mode'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_one_category_btn" data-plugin="switchery" <?php isset($battle_mode_one_category) && !empty($battle_mode_one_category) && $battle_mode_one_category['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="battle_mode_one_category" name="battle_mode_one_category" value="<?= isset($battle_mode_one_category) && !empty($battle_mode_one_category) ? $battle_mode_one_category['message'] : 0; ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_one_fix_question_btn" data-plugin="switchery" <?php (isset($battle_mode_one_fix_question) && !empty($battle_mode_one_fix_question) && $battle_mode_one_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="battle_mode_one_fix_question" name="battle_mode_one_fix_question" value="<?= (isset($battle_mode_one_fix_question) && !empty($battle_mode_one_fix_question)) ? $battle_mode_one_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="battle_mode_one_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="battle_mode_one_total_question" name="battle_mode_one_total_question" class="form-control" value="<?php echo (isset($battle_mode_one_total_question) && !empty($battle_mode_one_total_question)) ? $battle_mode_one_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('1_vs_1_battle_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="battle_mode_one_in_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($battle_mode_one_in_seconds) && !empty($battle_mode_one_in_seconds['message'])) ? $battle_mode_one_in_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_one_correct_answer_credit_score" min="1" name="battle_mode_one_correct_answer_credit_score" required class="form-control" value="<?php echo isset($battle_mode_one_correct_answer_credit_score) ? $battle_mode_one_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Extra score for quickest correct answer -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('extra_score_for_quickest_correct_answer'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_one_quickest_correct_answer_extra_score" min="1" name="battle_mode_one_quickest_correct_answer_extra_score" required class="form-control" value="<?php echo isset($battle_mode_one_quickest_correct_answer_extra_score) ? $battle_mode_one_quickest_correct_answer_extra_score['message'] : "" ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Extra score for Second quickest correct answer -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('extra_score_for_seconds_quickest_correct_answer'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_one_second_quickest_correct_answer_extra_score" min="1" name="battle_mode_one_second_quickest_correct_answer_extra_score" required class="form-control" value="<?php echo isset($battle_mode_one_second_quickest_correct_answer_extra_score) ? $battle_mode_one_second_quickest_correct_answer_extra_score['message'] : "" ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Entry Coin -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('entry_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_one_entry_coin" min="1" name="battle_mode_one_entry_coin" required class="form-control" value="<?php echo isset($battle_mode_one_entry_coin) ? $battle_mode_one_entry_coin['message'] : "" ?>">
                                                </div>

                                                <!-- 1 vs 1 Battle Quiz Room Code Generator Characters  -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('room_code_generator_characters'); ?> <small class="text-danger"><?= lang('fixed_limit_is_6'); ?> *</small></label>
                                                    <select id="battle_mode_one_code_char" name="battle_mode_one_code_char" class="form-control" required>
                                                        <option value="1"> <?= lang('only_numbers'); ?></option>
                                                        <option value="2"> <?= lang('only_characters'); ?></option>
                                                        <option value="3"> <?= lang('both'); ?> </option>
                                                    </select>
                                                    <input type="hidden" value="<?php echo isset($battle_mode_one_code_char) ? $battle_mode_one_code_char['message'] : "" ?>" id="battle_mode_one_code_char_value">
                                                </div>

                                            </div>



                                            <hr class="row">
                                            <!-- Group Battle Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('group_battle_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- Group Battle Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_group_btn" data-plugin="switchery" <?php isset($battle_mode_group) && !empty($battle_mode_group) && $battle_mode_group['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="battle_mode_group" name="battle_mode_group" value="<?= isset($battle_mode_group) && !empty($battle_mode_group) ? $battle_mode_group['message'] : 0; ?>">
                                                </div>

                                                <!-- Group Battle Quiz Category Mode Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('category_mode'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_group_category_btn" data-plugin="switchery" <?php isset($battle_mode_group_category) && !empty($battle_mode_group_category) && $battle_mode_group_category['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="battle_mode_group_category" name="battle_mode_group_category" value="<?= isset($battle_mode_group_category) && !empty($battle_mode_group_category) ? $battle_mode_group_category['message'] : 0; ?>">
                                                </div>

                                                <!-- Group Battle Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_group_fix_question_btn" data-plugin="switchery" <?php (isset($battle_mode_group_fix_question) && !empty($battle_mode_group_fix_question) && $battle_mode_group_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="battle_mode_group_fix_question" name="battle_mode_group_fix_question" value="<?= (isset($battle_mode_group_fix_question) && !empty($battle_mode_group_fix_question)) ? $battle_mode_group_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Group Battle Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="battle_mode_group_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="battle_mode_group_total_question" name="battle_mode_group_total_question" class="form-control" value="<?php echo (isset($battle_mode_group_total_question) && !empty($battle_mode_group_total_question)) ? $battle_mode_group_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- Group Battle Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('group_battle_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="battle_mode_group_in_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($battle_mode_group_in_seconds) && !empty($battle_mode_group_in_seconds['message'])) ? $battle_mode_group_in_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- Group Battle Quiz Wrong Answer Deduct Score -->
                                                <input type="hidden" name="battle_mode_group_wrong_answer_deduct_score" value="10">

                                                <!-- Group Battle Quiz Correct Answer Credit Score -->
                                                <input type="hidden" name="battle_mode_group_correct_answer_credit_score" value="10">

                                                <!-- Group Battle Quiz Entry Coin -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('entry_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_group_entry_coin" min="1" name="battle_mode_group_entry_coin" required class="form-control" value="<?php echo isset($battle_mode_group_entry_coin) ? $battle_mode_group_entry_coin['message'] : "" ?>">
                                                </div>

                                                <!-- Group Battle Quiz Extra score for quickest correct answer -->
                                                <input type="hidden" name="battle_mode_group_quickest_correct_answer_extra_score" value="10">

                                                <!-- Group Battle Quiz Extra score for Second quickest correct answer -->
                                                <input type="hidden" name="battle_mode_group_second_quickest_correct_answer_extra_score" value="10">

                                                <!-- Group Battle Quiz Room Code Generator Characters  -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('room_code_generator_characters'); ?> <small class="text-danger"><?= lang('fixed_limit_is_6'); ?> *</small></label>
                                                    <select id="battle_mode_group_code_char" name="battle_mode_group_code_char" class="form-control" required>
                                                        <option value="1"> <?= lang('only_numbers'); ?></option>
                                                        <option value="2"> <?= lang('only_characters'); ?></option>
                                                        <option value="3"> <?= lang('both'); ?> </option>
                                                    </select>
                                                    <input type="hidden" value="<?php echo isset($battle_mode_group_code_char) ? $battle_mode_group_code_char['message'] : "" ?>" id="battle_mode_group_code_char_value">
                                                </div>

                                            </div>


                                            <hr class="row">
                                            <!-- Random Battle Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('random_battle_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">
                                                <!-- Random Battle Quiz Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_random_btn" data-plugin="switchery" <?php isset($battle_mode_random) && !empty($battle_mode_random) && $battle_mode_random['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="battle_mode_random" name="battle_mode_random" value="<?= isset($battle_mode_random) && !empty($battle_mode_random) ? $battle_mode_random['message'] : 0; ?>">
                                                </div>

                                                <!-- Random Battle Quiz Category Mode Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('category_mode'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_random_category_btn" data-plugin="switchery" <?php isset($battle_mode_random_category) && !empty($battle_mode_random_category) && $battle_mode_random_category['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="battle_mode_random_category" name="battle_mode_random_category" value="<?= isset($battle_mode_random_category) && !empty($battle_mode_random_category) ? $battle_mode_random_category['message'] : 0; ?>">
                                                </div>

                                                <!-- Random Battle Quiz Fix Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question'); ?></label><br>
                                                    <input type="checkbox" id="battle_mode_random_fix_question_btn" data-plugin="switchery" <?php (isset($battle_mode_random_fix_question) && !empty($battle_mode_random_fix_question) && $battle_mode_random_fix_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="battle_mode_random_fix_question" name="battle_mode_random_fix_question" value="<?= (isset($battle_mode_random_fix_question) && !empty($battle_mode_random_fix_question)) ? $battle_mode_random_fix_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Random Battle Quiz Total Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="battle_mode_random_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_limit'); ?></label>
                                                    <input type="number" min="1" id="battle_mode_random_total_question" name="battle_mode_random_total_question" class="form-control" value="<?php echo (isset($battle_mode_random_total_question) && !empty($battle_mode_random_total_question)) ? $battle_mode_random_total_question['message'] : 10 ?>">
                                                </div>

                                                <!-- Random Battle Quiz Seconds -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('random_battle_quiz_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="battle_mode_random_in_seconds" type="number" min=1 class="form-control" value="<?php echo (isset($battle_mode_random_in_seconds) && !empty($battle_mode_random_in_seconds['message'])) ? $battle_mode_random_in_seconds['message'] : "" ?>" required>
                                                </div>

                                                <!-- Random Battle Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_random_correct_answer_credit_score" min="1" name="battle_mode_random_correct_answer_credit_score" required class="form-control" value="<?php echo isset($battle_mode_random_correct_answer_credit_score) ? $battle_mode_random_correct_answer_credit_score['message'] : "" ?>">
                                                </div>

                                                <!-- Random Battle Quiz Extra score for quickest correct answer -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('extra_score_for_quickest_correct_answer'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_random_quickest_correct_answer_extra_score" min="1" name="battle_mode_random_quickest_correct_answer_extra_score" required class="form-control" value="<?php echo isset($battle_mode_random_quickest_correct_answer_extra_score) ? $battle_mode_random_quickest_correct_answer_extra_score['message'] : "" ?>">
                                                </div>

                                                <!-- Random Battle Quiz Extra score for Second quickest correct answer -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('extra_score_for_seconds_quickest_correct_answer'); ?></label>
                                                    <input type="number" min=1 id="battle_mode_random_second_quickest_correct_answer_extra_score" min="1" name="battle_mode_random_second_quickest_correct_answer_extra_score" required class="form-control" value="<?php echo isset($battle_mode_random_second_quickest_correct_answer_extra_score) ? $battle_mode_random_second_quickest_correct_answer_extra_score['message'] : "" ?>">
                                                </div>

                                                <!-- Random Battle Quiz Opponent Search duration -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('opponent_search_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input type="number" min=1 id="battle_mode_random_search_duration" min="1" name="battle_mode_random_search_duration" required class="form-control" value="<?php echo isset($battle_mode_random_search_duration) ? $battle_mode_random_search_duration['message'] : "" ?>">
                                                </div>

                                                <!-- Random Battle Quiz Entry Coin -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('entry_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="battle_mode_random_entry_coin" min="1" name="battle_mode_random_entry_coin" required class="form-control" value="<?php echo isset($battle_mode_random_entry_coin) ? $battle_mode_random_entry_coin['message'] : "" ?>">
                                                </div>

                                            </div>

                                            <hr class="row">
                                            <!-- Self Challenge Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('self_challenge_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">

                                                <!-- Self Challenge Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="self_challenge_mode_btn" data-plugin="switchery" <?php isset($self_challenge_mode) && !empty($self_challenge_mode) && $self_challenge_mode['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="self_challenge_mode" name="self_challenge_mode" value="<?= isset($self_challenge_mode) && !empty($self_challenge_mode) ? $self_challenge_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- Self Challenge Max Minutes -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('self_challenge_max_minutes'); ?> <small class="text-danger">*</small></label>
                                                    <input name="self_challenge_max_minutes" type="number" min=1 class="form-control" value="<?php echo (!empty($self_challenge_max_minutes['message'])) ? $self_challenge_max_minutes['message'] : "" ?>" required>
                                                </div>

                                                <!-- Self Challenge Max Questions -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('self_challenge_max_questions'); ?> <small class="text-danger">*</small></label>
                                                    <input name="self_challenge_max_questions" type="number" min=1 class="form-control" value="<?php echo (!empty($self_challenge_max_questions['message'])) ? $self_challenge_max_questions['message'] : "" ?>" required>
                                                </div>
                                            </div>



                                            <hr class="row">
                                            <!-- Exam Module Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('exam_module_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">

                                                <!-- Exam Module Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="exam_module_btn" data-plugin="switchery" <?php isset($exam_module) && !empty($exam_module) && $exam_module['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="exam_module" name="exam_module" value="<?= isset($exam_module) && !empty($exam_module) ? $exam_module['message'] : 0; ?>">
                                                </div>

                                                <!-- Exam Module Resume Exam After Close Timeout -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('resume_exam_after_close_timeout'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="exam_module_resume_exam_timeout" type="number" min=1 class="form-control" value="<?php echo (!empty($exam_module_resume_exam_timeout['message'])) ? $exam_module_resume_exam_timeout['message'] : "" ?>" required>
                                                </div>
                                            </div>

                                            <hr class="row">

                                            <!-- Contest Quiz Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('contest_quiz_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">

                                                <!-- Contest Visibility -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="contest_mode_btn" data-plugin="switchery" <?php isset($contest_mode) && !empty($contest_mode) && $contest_mode['message'] == '1' ? print_r('checked') : "" ?>>

                                                    <input type="hidden" id="contest_mode" name="contest_mode" value="<?= isset($contest_mode) && !empty($contest_mode) ? $contest_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- Contest Quiz Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="contest_mode_wrong_deduct_score" min="1" name="contest_mode_wrong_deduct_score" required class="form-control" value="<?php echo isset($contest_mode_wrong_deduct_score) ? $contest_mode_wrong_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Contest Quiz Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="contest_mode_correct_credit_score" min="1" name="contest_mode_correct_credit_score" required class="form-control" value="<?php echo isset($contest_mode_correct_credit_score) ? $contest_mode_correct_credit_score['message'] : "" ?>">
                                                </div>

                                            </div>
                                            <hr class="row">

                                            <!-- Multi Match Settings -->
                                            <h4 class="row">
                                                <label class="control-label"><b><?= lang('multi_match_settings'); ?></b></label>
                                                <i class="fa fa-question-circle fa-sm ml-2" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?= lang('please_enter_value_greater_than_or_equal_to_1') ?>"></i>
                                            </h4>
                                            <div class="row bg-light rounded p-3">

                                                <!-- Multi Match Visiblity Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('visible_mode'); ?></label><br>
                                                    <input type="checkbox" id="multi_match_mode_btn" data-plugin="switchery" <?php isset($multi_match_mode) && !empty($multi_match_mode) && $multi_match_mode['message'] == '1' ? print_r('checked') : "" ?>>
                                                    <input type="hidden" id="multi_match_mode" name="multi_match_mode" value="<?= isset($multi_match_mode) && !empty($multi_match_mode) ? $multi_match_mode['message'] : 0; ?>">
                                                </div>

                                                <!-- Multi Match Fix Level Question Switch -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('fix_question_in_level'); ?></label><br>
                                                    <input type="checkbox" id="multi_match_fix_level_question_btn" data-plugin="switchery" <?php (isset($multi_match_fix_level_question) && !empty($multi_match_fix_level_question) && $multi_match_fix_level_question['message'] == '1') ? print_r('checked') : ""; ?>>

                                                    <input type="hidden" id="multi_match_fix_level_question" name="multi_match_fix_level_question" value="<?= (isset($multi_match_fix_level_question) && !empty($multi_match_fix_level_question)) ? $multi_match_fix_level_question['message'] : 0; ?>">
                                                </div>

                                                <!-- Multi Match Total Level Question -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2" id="multi_match_fix_que" style="display:none">
                                                    <label class="control-label"><?= lang('total_question_per_level'); ?></label>
                                                    <input type="number" min="1" id="multi_match_total_level_question" name="multi_match_total_level_question" class="form-control" value="<?php echo (isset($multi_match_total_level_question) && !empty($multi_match_total_level_question)) ? $multi_match_total_level_question['message'] : '10' ?>">
                                                </div>

                                                <!-- Multi Match Durtaion -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('multi_match_duration'); ?> <small class="text-danger"><?= lang('in_seconds'); ?> *</small></label>
                                                    <input name="multi_match_duration" type="number" min=1 class="form-control" value="<?php echo (!empty($multi_match_duration['message'])) ? $multi_match_duration['message'] : "30" ?>" required>
                                                </div>

                                                <!-- Wrong Answer Deduct Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('wrong_answer_deduct_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="multi_match_wrong_answer_deduct_score" min="1" name="multi_match_wrong_answer_deduct_score" required class="form-control" value="<?php echo isset($multi_match_wrong_answer_deduct_score) ? $multi_match_wrong_answer_deduct_score['message'] : "" ?>">
                                                </div>

                                                <!-- Correct Answer Credit Score -->
                                                <div class="form-group col-md-3 col-sm-6 mt-2">
                                                    <label class="control-label"><?= lang('correct_answer_credit_score'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 id="multi_match_correct_answer_credit_score" min="1" name="multi_match_correct_answer_credit_score" required class="form-control" value="<?php echo isset($multi_match_correct_answer_credit_score) ? $multi_match_correct_answer_credit_score['message'] : "" ?>">
                                                </div>
                                            </div>
                                            <hr class="row">
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
        $(document).ready(function() {

            let answerModeSelectOption = $("#answer_mode_value").val();
            if (answerModeSelectOption) {
                $('#answer_mode').val(answerModeSelectOption).trigger('change')
            }

            let quizZoneFixLevelQuestionToggle = $("#quiz_zone_fix_level_question").val();
            if (quizZoneFixLevelQuestionToggle == 1) {
                $('#quiz_zone_fix_level_question_btn').trigger('change')
            }

            let GuessTheWordFixQuestionToggle = $("#guess_the_word_fix_question").val();
            if (GuessTheWordFixQuestionToggle == 1) {
                $('#guess_the_word_fix_question_btn').trigger('change')
            }

            let AudioQuizFixLevelQuestionToggle = $("#audio_quiz_fix_question").val();
            if (AudioQuizFixLevelQuestionToggle == 1) {
                $('#audio_quiz_fix_question_btn').trigger('change')
            }

            let MathsQuizFixLevelQuestionToggle = $("#maths_quiz_fix_question").val();
            if (MathsQuizFixLevelQuestionToggle == 1) {
                $('#maths_quiz_fix_question_btn').trigger('change')
            }

            let FunNLearnQuizFixLevelQuestionToggle = $("#fun_n_learn_quiz_fix_question").val();
            if (FunNLearnQuizFixLevelQuestionToggle == 1) {
                $('#fun_n_learn_quiz_fix_question_btn').trigger('change')
            }

            let trueFalseQuizFixLevelQuestionToggle = $("#true_false_quiz_fix_question").val();
            if (trueFalseQuizFixLevelQuestionToggle == 1) {
                $('#true_false_quiz_fix_question_btn').trigger('change')
            }

            let BattleOneQuizFixLevelQuestionToggle = $("#battle_mode_one_fix_question").val();
            if (BattleOneQuizFixLevelQuestionToggle == 1) {
                $('#battle_mode_one_fix_question_btn').trigger('change')

                let BattleRandomQuizFixLevelQuestionToggle = $("#battle_mode_random_fix_question").val();
                if (BattleRandomQuizFixLevelQuestionToggle == 1) {
                    $('#battle_mode_random_fix_question_btn').trigger('change')
                }
            }

            let BattleOneQuizCodeChar = $('#battle_mode_one_code_char_value').val();
            $('#battle_mode_one_code_char').val(BattleOneQuizCodeChar)

            let BattleGroupQuizFixLevelQuestionToggle = $("#battle_mode_group_fix_question").val();
            if (BattleGroupQuizFixLevelQuestionToggle == 1) {
                $('#battle_mode_group_fix_question_btn').trigger('change')
            }

            let BattleGroupQuizCodeChar = $('#battle_mode_group_code_char_value').val();
            $('#battle_mode_group_code_char').val(BattleGroupQuizCodeChar)

            let multiMatchFixLevelQuestionToggle = $("#multi_match_fix_level_question").val();
            if (multiMatchFixLevelQuestionToggle == 1) {
                $('#multi_match_fix_level_question_btn').trigger('change')
            }
        });
    </script>

    <script>
        /* Adding Swtichery to all data-plugin='switchery' added */
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });

        /* on change of Question shuffle Mode btn - switchery js */
        var changeQuestionShuffleMode = document.querySelector('#question_shuffle_mode_btn');
        changeQuestionShuffleMode.onchange = function() {
            if (changeQuestionShuffleMode.checked)
                $('#question_shuffle_mode').val(1);
            else
                $('#question_shuffle_mode').val(0);
        };

        /* on change of Option shuffle Mode btn - switchery js */
        var changeOptionShuffleMode = document.querySelector('#option_shuffle_mode_btn');
        changeOptionShuffleMode.onchange = function() {
            if (changeOptionShuffleMode.checked)
                $('#option_shuffle_mode').val(1);
            else
                $('#option_shuffle_mode').val(0);
        };

        /* on change of Quiz Zone Visibilty Mode btn - switchery js */
        var changeQuizZoneVisiblityMode = document.querySelector('#quiz_zone_mode_btn');
        changeQuizZoneVisiblityMode.onchange = function() {
            if (changeQuizZoneVisiblityMode.checked)
                $('#quiz_zone_mode').val(1);
            else
                $('#quiz_zone_mode').val(0);
        };


        /* on change of fix question btn - switchery js */
        var quizZoneChangeFixQuestion = document.querySelector('#quiz_zone_fix_level_question_btn');
        quizZoneChangeFixQuestion.onchange = function() {
            if (quizZoneChangeFixQuestion.checked) {
                $('#quiz_zone_fix_level_question').val(1);
                $('#quiz_zone_fix_que').show(100);
                $('#quiz_zone_total_level_question').attr('required', true);
            } else {
                $('#quiz_zone_fix_level_question').val(0);
                $('#quiz_zone_total_level_question').removeAttr('required');
                $('#quiz_zone_fix_que').hide(100);
            }
        };


        /* on change of Guess the word mode - switchery js */
        var guessTheWordMode = document.querySelector('#guess_the_word_btn');
        guessTheWordMode.onchange = function() {
            if (guessTheWordMode.checked) {
                $('#guess_the_word_question').val(1);
            } else {
                $('#guess_the_word_question').val(0);
            }
        };

        /* on change of guess the word fix question btn - switchery js */
        var guessTheWordChangeFixQuestion = document.querySelector('#guess_the_word_fix_question_btn');
        guessTheWordChangeFixQuestion.onchange = function() {
            if (guessTheWordChangeFixQuestion.checked) {
                $('#guess_the_word_fix_question').val(1);
                $('#guess_the_word_fix_que').show(100);
                $('#guess_the_word_total_question').attr('required', true);
            } else {
                $('#guess_the_word_fix_question').val(0);
                $('#guess_the_word_total_question').removeAttr('required');
                $('#guess_the_word_fix_que').hide(100);
            }
        };


        /* on change of Auido Question mode - switchery js */
        var audioQuestionMode = document.querySelector('#audio_mode_btn');
        audioQuestionMode.onchange = function() {
            if (audioQuestionMode.checked) {
                $('#audio_mode_question').val(1);
            } else {
                $('#audio_mode_question').val(0);
            }
        };

        /* on change of Audio Quiz fix question btn - switchery js */
        var AudioQuizChangeFixQuestion = document.querySelector('#audio_quiz_fix_question_btn');
        AudioQuizChangeFixQuestion.onchange = function() {
            if (AudioQuizChangeFixQuestion.checked) {
                $('#audio_quiz_fix_question').val(1);
                $('#audio_quiz_fix_que').show(100);
                $('#audio_quiz_total_question').attr('required', true);
            } else {
                $('#audio_quiz_fix_question').val(0);
                $('#audio_quiz_total_question').removeAttr('required');
                $('#audio_quiz_fix_que').hide(100);
            }
        };


        /* on change of Maths Quiz mode - switchery js */
        var mathsQuizMode = document.querySelector('#maths_quiz_mode_btn');
        mathsQuizMode.onchange = function() {
            if (mathsQuizMode.checked) {
                $('#maths_quiz_mode').val(1);
            } else {
                $('#maths_quiz_mode').val(0);
            }
        };

        /* on change of Maths Quiz fix question btn - switchery js */
        var MathsQuizChangeFixQuestion = document.querySelector('#maths_quiz_fix_question_btn');
        MathsQuizChangeFixQuestion.onchange = function() {
            if (MathsQuizChangeFixQuestion.checked) {
                $('#maths_quiz_fix_question').val(1);
                $('#maths_quiz_fix_que').show(100);
                $('#maths_quiz_total_question').attr('required', true);
            } else {
                $('#maths_quiz_fix_question').val(0);
                $('#maths_quiz_total_question').removeAttr('required');
                $('#maths_quiz_fix_que').hide(100);
            }
        };


        /* on change of Fun N Learn Quiz mode - switchery js */
        var funNLearnQuizMode = document.querySelector('#fun_n_learn_btn');
        funNLearnQuizMode.onchange = function() {
            if (funNLearnQuizMode.checked) {
                $('#fun_n_learn_question').val(1);
            } else {
                $('#fun_n_learn_question').val(0);
            }
        };

        /* on change of Fun N Learn Quiz fix question btn - switchery js */
        var FunNLearnQuizChangeFixQuestion = document.querySelector('#fun_n_learn_quiz_fix_question_btn');
        FunNLearnQuizChangeFixQuestion.onchange = function() {
            if (FunNLearnQuizChangeFixQuestion.checked) {
                $('#fun_n_learn_quiz_fix_question').val(1);
                $('#fun_n_learn_quiz_fix_que').show(100);
                $('#fun_n_learn_quiz_total_question').attr('required', true);
            } else {
                $('#fun_n_learn_quiz_fix_question').val(0);
                $('#fun_n_learn_quiz_total_question').removeAttr('required');
                $('#fun_n_learn_quiz_fix_que').hide(100);
            }
        };


        /* on change of True False Quiz mode - switchery js */
        var trueFalseQuizMode = document.querySelector('#true_false_btn');
        trueFalseQuizMode.onchange = function() {
            if (trueFalseQuizMode.checked) {
                $('#true_false_mode').val(1);
            } else {
                $('#true_false_mode').val(0);
            }
        };

        /* on change of True False Quiz fix question btn - switchery js */
        var trueFalseQuizChangeFixQuestion = document.querySelector('#true_false_quiz_fix_question_btn');
        trueFalseQuizChangeFixQuestion.onchange = function() {
            if (trueFalseQuizChangeFixQuestion.checked) {
                $('#true_false_quiz_fix_question').val(1);
                $('#true_false_quiz_fix_que').show(100);
                $('#true_false_quiz_total_question').attr('required', true);
            } else {
                $('#true_false_quiz_fix_question').val(0);
                $('#true_false_quiz_total_question').removeAttr('required');
                $('#true_false_quiz_fix_que').hide(100);
            }
        };


        /* on change of Battle Mode One mode - switchery js */
        var battleModeOneMode = document.querySelector('#battle_mode_one_btn');

        battleModeOneMode.onchange = function() {
            if (battleModeOneMode.checked) {
                $('#battle_mode_one').val(1);
            } else {
                $('#battle_mode_one').val(0);
            }
        };


        /* on change of Battle Mode One Category mode - switchery js */
        var battleModeOneCategoryMode = document.querySelector('#battle_mode_one_category_btn');
        battleModeOneCategoryMode.onchange = function() {
            if (battleModeOneCategoryMode.checked) {
                $('#battle_mode_one_category').val(1);
            } else {
                $('#battle_mode_one_category').val(0);
            }
        };

        /* on change of Battle Mode One fix question btn - switchery js */
        var battleModeOneChangeFixQuestion = document.querySelector('#battle_mode_one_fix_question_btn');
        battleModeOneChangeFixQuestion.onchange = function() {
            if (battleModeOneChangeFixQuestion.checked) {
                $('#battle_mode_one_fix_question').val(1);
                $('#battle_mode_one_fix_que').show(100);
                $('#battle_mode_one_total_question').attr('required', true);
            } else {
                $('#battle_mode_one_fix_question').val(0);
                $('#battle_mode_one_total_question').removeAttr('required');
                $('#battle_mode_one_fix_que').hide(100);
            }
        };



        /* on change of Battle Mode Group mode - switchery js */
        var battleModeGroupMode = document.querySelector('#battle_mode_group_btn');
        battleModeGroupMode.onchange = function() {
            if (battleModeGroupMode.checked) {
                $('#battle_mode_group').val(1);
            } else {
                $('#battle_mode_group').val(0);
            }
        };


        /* on change of Battle Mode Group Category mode - switchery js */
        var battleModeGroupCategoryMode = document.querySelector('#battle_mode_group_category_btn');
        battleModeGroupCategoryMode.onchange = function() {
            if (battleModeGroupCategoryMode.checked) {
                $('#battle_mode_group_category').val(1);
            } else {
                $('#battle_mode_group_category').val(0);
            }
        };

        /* on change of Battle Mode Group fix question btn - switchery js */
        var battleModeGroupChangeFixQuestion = document.querySelector('#battle_mode_group_fix_question_btn');
        battleModeGroupChangeFixQuestion.onchange = function() {
            if (battleModeGroupChangeFixQuestion.checked) {
                $('#battle_mode_group_fix_question').val(1);
                $('#battle_mode_group_fix_que').show(100);
                $('#battle_mode_group_total_question').attr('required', true);
            } else {
                $('#battle_mode_group_fix_question').val(0);
                $('#battle_mode_group_total_question').removeAttr('required');
                $('#battle_mode_group_fix_que').hide(100);
            }
        };


        /* on change of Battle Mode Random mode - switchery js */
        var battleModeRandomMode = document.querySelector('#battle_mode_random_btn');
        battleModeRandomMode.onchange = function() {
            if (battleModeRandomMode.checked) {
                $('#battle_mode_random').val(1);
            } else {
                $('#battle_mode_random').val(0);
            }
        };


        /* on change of Battle Mode Random Category mode - switchery js */
        var battleModeRandomCategoryMode = document.querySelector('#battle_mode_random_category_btn');
        battleModeRandomCategoryMode.onchange = function() {
            if (battleModeRandomCategoryMode.checked) {
                $('#battle_mode_random_category').val(1);
            } else {
                $('#battle_mode_random_category').val(0);
            }
        };

        /* on change of Battle Mode Random fix question btn - switchery js */
        var battleModeRandomChangeFixQuestion = document.querySelector('#battle_mode_random_fix_question_btn');
        battleModeRandomChangeFixQuestion.onchange = function() {
            if (battleModeRandomChangeFixQuestion.checked) {
                $('#battle_mode_random_fix_question').val(1);
                $('#battle_mode_random_fix_que').show(100);
                $('#battle_mode_random_total_question').attr('required', true);
            } else {
                $('#battle_mode_random_fix_question').val(0);
                $('#battle_mode_random_total_question').removeAttr('required');
                $('#battle_mode_random_fix_que').hide(100);
            }
        };


        /* on change of Self Challenge Quiz mode - switchery js */
        var selfChallengeQuizMode = document.querySelector('#self_challenge_mode_btn');
        selfChallengeQuizMode.onchange = function() {
            if (selfChallengeQuizMode.checked) {
                $('#self_challenge_mode').val(1);
            } else {
                $('#self_challenge_mode').val(0);
            }
        };

        /* on change of Exam Module mode - switchery js */
        var examModuleMode = document.querySelector('#exam_module_btn');
        examModuleMode.onchange = function() {
            if (examModuleMode.checked) {
                $('#exam_module').val(1);
            } else {
                $('#exam_module').val(0);
            }
        };

        /* on change of Contest mode - switchery js */
        var contestMode = document.querySelector('#contest_mode_btn');
        contestMode.onchange = function() {
            if (contestMode.checked) {
                $('#contest_mode').val(1);
            } else {
                $('#contest_mode').val(0);
            }
        };

        /* on change of Quiz Zone Visibilty Mode btn - switchery js */
        var changeMultiMatchVisiblityMode = document.querySelector('#multi_match_mode_btn');
        changeMultiMatchVisiblityMode.onchange = function() {
            if (changeMultiMatchVisiblityMode.checked)
                $('#multi_match_mode').val(1);
            else
                $('#multi_match_mode').val(0);
        };


        /* on change of fix question btn - switchery js */
        var multiMatchChangeFixQuestion = document.querySelector('#multi_match_fix_level_question_btn');
        multiMatchChangeFixQuestion.onchange = function() {
            if (multiMatchChangeFixQuestion.checked) {
                $('#multi_match_fix_level_question').val(1);
                $('#multi_match_fix_que').show(100);
                $('#multi_match_total_level_question').attr('required', true);
            } else {
                $('#multi_match_fix_level_question').val(0);
                $('#multi_match_total_level_question').removeAttr('required');
                $('#multi_match_fix_que').hide(100);
            }
        };
    </script>

</body>

</html>