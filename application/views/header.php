<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg"><em class="fas fa-bars"></em></a></li>
            <li class="nav-item d-none d-sm-inline-block center">
                <?php
                if (!ALLOW_MODIFICATION) {
                ?>
                    <span class="right badge badge-danger"><?= lang('Modification_in_demo_version_is_not_allowed'); ?></span>
                <?php } ?>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg" aria-expanded="false">
                <h6>
                    <em class="fas fa-language"></em>
                    <?= ucwords(get_user_permissions($this->session->userdata('authId'))['language'] ?? '') ?>
                </h6>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php foreach (panel_languages() as $value) { ?>
                    <a href="<?php echo base_url('System_Languages/switch/') . $value; ?>" class="dropdown-item text-decoration-none <?php if (get_user_permissions($this->session->userdata('authId'))['language'] == $value) echo 'active'; ?>">
                        <div class="dropdown-item-desc">
                            <b><?= ucwords($value) ?></b>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </li>
        <li class="dropdown">
            <a href="<?= base_url(); ?>" data-toggle="dropdown" class="nav-link dropdown-toggle  nav-link-lg nav-link-user">
                <span class="rounded-circle mr-1"><i class="fa fa-user-circle" aria-hidden="true"></i> </span>
                <div class="d-sm-none d-lg-inline-block"><?= lang('hi'); ?>, <?= ucwords($this->session->userdata('authName')); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php if (has_permissions('read', 'profile')) { ?>
                    <a href="<?php echo base_url(); ?>profile" class="dropdown-item has-icon">
                        <em class="fas fa-user"></em> <?= lang('profile'); ?>
                    </a>
                <?php }
                if (has_permissions('read', 'reset_password')) { ?>
                    <a href="<?php echo base_url(); ?>resetpassword" class="dropdown-item has-icon">
                        <em class="fas fa-key"></em> <?= lang('reset_password'); ?>
                    </a>
                <?php } ?>
                <a href="<?php echo base_url(); ?>logout" class="dropdown-item has-icon">
                    <em class="fas fa-sign-out-alt"></em> <?= lang('logout'); ?>
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <ul class="sidebar-menu">
            <div class="sidebar-brand my-1">
                <a href="<?= base_url(); ?>dashboard">
                    <?php if (is_settings('full_logo')) { ?>
                        <img src="<?= base_url() . LOGO_IMG_PATH . is_settings('full_logo'); ?>" alt="logo" width="150" id="full_logo">
                    <?php } ?>
                </a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="<?= base_url(); ?>dashboard">
                    <?php if (is_settings('half_logo')) { ?>
                        <img src="<?= base_url() . LOGO_IMG_PATH . is_settings('half_logo'); ?>" alt="logo" width="50">
                    <?php } ?>
                </a>
            </div>
            <li>
                <a class="nav-link" href="<?= base_url(); ?>dashboard"><em class="fas fa-home"></em> <span><?= lang('dashboard'); ?></span></a>
            </li>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('create', 'questions') || has_permissions('read', 'questions') || has_permissions('read', 'import_question') || has_permissions('read', 'question_report')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-gift"></em><span><?= lang('quiz_zone'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>main-category"><?= lang('main_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>sub-category"><?= lang('sub_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>category-order"><?= lang('category_order'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('create', 'questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>create-questions"><?= lang('create_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>manage-questions"><?= lang('view_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'import_question')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>import-questions"> <?= lang('import_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'question_report')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>question-reports"> <?= lang('question_reports'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'daily_quiz')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>daily-quiz"><em class="fas fa-question"></em> <span><?= lang('daily_quiz'); ?></span></a>
                </li>
            <?php } ?>

            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('create', 'multi_match') || has_permissions('read', 'multi_match') || has_permissions('read', 'multi_match_import_question') || has_permissions('read', 'multi_match_question_report')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-puzzle-piece"></em><span><?= lang('multi_match'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>multi-match-category"><?= lang('main_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>multi-match-subcategory"><?= lang('sub_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>multi-match-category-order"><?= lang('category_order'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('create', 'multi_match')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>multi-match"><?= lang('create_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'multi_match')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>manage-multi-match"><?= lang('view_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'multi_match_import_question')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>multi-match-import-questions"> <?= lang('import_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'multi_match_question_report')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>multi-match-question-reports"> <?= lang('question_reports'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if (has_permissions('read', 'manage_contest') || has_permissions('read', 'manage_contest_question') || has_permissions('read', 'import_contest_question')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-gift"></em> <span><?= lang('contests'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'manage_contest')) { ?>
                            <li><a href="<?= base_url(); ?>contest"> <?= lang('manage_contest'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'manage_contest_question')) { ?>
                            <li><a href="<?= base_url(); ?>contest-questions"> <?= lang('manage_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'import_contest_question')) { ?>
                            <li><a href="<?= base_url(); ?>contest-questions-import"> <?= lang('import_questions'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('read', 'fun_n_learn')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-book-open"></em><span><?= lang('fun_n_learn'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>fun-n-learn-category"><?= lang('main_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>fun-n-learn-subcategory"><?= lang('sub_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>fun-n-learn-category-order"><?= lang('category_order'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'fun_n_learn')) { ?>
                            <li><a class="nav-link" href="<?= base_url() ?>fun-n-learn"><?= lang('manage_fun_n_learn'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('read', 'guess_the_word')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-atom"></em><span><?= lang('guess_the_word'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>guess-the-word-category"><?= lang('main_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>guess-the-word-subcategory"><?= lang('sub_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>guess-the-word-category-order"><?= lang('category_order'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'guess_the_word')) { ?>
                            <li><a class="nav-link" href="<?= base_url() ?>guess-the-word"><?= lang('manage_guess_the_word'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('read', 'audio_question')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-microphone-alt"></em><span><?= lang('audio_questions'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>audio-question-category"><?= lang('main_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>audio-question-subcategory"><?= lang('sub_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>audio-question-category-order"><?= lang('category_order'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'audio_question')) { ?>
                            <li><a class="nav-link" href="<?= base_url() ?>audio-question"><?= lang('manage_audio_questions'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'categories') || has_permissions('read', 'subcategories') || has_permissions('read', 'category_order') || has_permissions('create', 'maths_questions') || has_permissions('read', 'maths_questions')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-book-open"></em><span><?= lang('maths_quiz'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'categories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>maths-question-category"><?= lang('main_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'subcategories')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>maths-question-subcategory"><?= lang('sub_category'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'category_order')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>maths-question-category-order"><?= lang('category_order'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('create', 'maths_questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>create-maths-questions"><?= lang('create_questions'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'maths_questions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>manage-maths-questions"><?= lang('view_questions'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'exam_module')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-book"></em><span><?= lang('exam_module'); ?></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= base_url(); ?>exam-module"><?= lang('exam_module'); ?></a></li>
                        <li><a class="nav-link" href="<?= base_url(); ?>exam-module-questions-import"><?= lang('import_exam_question'); ?></a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (has_permissions('read', 'users')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>users"><em class="fas fa-users"></em> <span><?= lang('users'); ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'in_app_users')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>in-app-users"><em class="fas fa-users"></em> <span><?= lang('in_app_users'); ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'activity_tracker')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>activity-tracker"><em class="fas fa-chart-bar"></em> <span><?= lang('activity_tracker'); ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'payment_requests')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>payment-requests"><em class="fas fa-rupee-sign"></em> <span><?= lang('payment_requests'); ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'leaderboard')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-th"></em><span><?= lang('leaderboard'); ?></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= base_url(); ?>global-leaderboard"><?= lang('all'); ?></a></li>
                        <li><a class="nav-link" href="<?= base_url(); ?>monthly-leaderboard"><?= lang('monthly'); ?></a></li>
                        <li><a class="nav-link" href="<?= base_url(); ?>daily-leaderboard"><?= lang('daily'); ?></a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (is_language_mode_enabled()) { ?>
                <?php if (has_permissions('read', 'languages')) { ?>
                    <li>
                        <a class="nav-link" href="<?= base_url() ?>languages"><em class="fas fa-language"></em> <span><?= lang('languages'); ?></span></a>
                    </li>
                <?php } ?>
            <?php } ?>
            <?php if (has_permissions('read', 'system_languages')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>system-languages"><em class="fas fa-language"></em> <span><?= lang('system_languages') ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'in_app_settings') || has_permissions('read', 'coin_store_settings') || has_permissions('read', 'badges_settings') || has_permissions('read', 'ads_settings') || has_permissions('read', 'payment_settings') || has_permissions('read', 'firebase_configurations') || has_permissions('read', 'system_configuration') || has_permissions('read', 'system_utilities') || has_permissions('read', 'authentication_settings')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-cog"></em><span><?= lang('settings'); ?></span></a>
                    <ul class="dropdown-menu">
                        <?php if (has_permissions('read', 'system_configuration')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>system-configurations"><?= lang('system_configurations'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'system_utilities')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>system-utilities"><?= lang('system_utilities'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'authentication_settings')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>authentication-settings"><?= lang('authentication_settings'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'firebase_configurations')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>firebase-configurations"><?= lang('firebase_configurations'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'payment_settings')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>payment-settings"><?= lang('payment_settings'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'ads_settings')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>ads-settings"><?= lang('ads_settings'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'badges_settings')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>badges-settings"><?= lang('badges_settings'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'coin_store_settings')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>coin-store-settings"><?= lang('coin_store_settings'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'in_app_settings')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>in-app-settings"><?= lang('in_app_settings'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'about_us')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>about-us"><?= lang('about_us'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'contact_us')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>contact-us"><?= lang('contact_us'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'how_to_play')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>instructions"><?= lang('how_to_play'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'privacy_policy')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>privacy-policy"><?= lang('privacy_policy'); ?></a></li>
                        <?php } ?>
                        <?php if (has_permissions('read', 'term_conditions')) { ?>
                            <li><a class="nav-link" href="<?= base_url(); ?>terms-conditions"><?= lang('term_conditions'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if (has_permissions('read', 'send_notification')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>send-notifications"><em class="fas fa-bullhorn"></em> <span><?= lang('send_notifications'); ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'users_accounts_rights')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>user-accounts-rights"><em class="fas fa-user"></em> <span><?= lang('user_accounts_and_rights'); ?></span></a>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'web_settings')) { ?>
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link has-dropdown"><em class="fas fa-cog"></em><span><?= lang('web_settings'); ?></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= base_url('web-settings'); ?>"><?= lang('settings'); ?></a></li>
                        <li><a class="nav-link" href="<?= base_url('web-home-settings'); ?>"><?= lang('home_settings'); ?></a></li>
                        <li><a class="nav-link" href="<?= base_url('sliders'); ?>"><?= lang('sliders'); ?></a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (has_permissions('read', 'system_update')) { ?>
                <li>
                    <a class="nav-link" href="<?= base_url(); ?>system-updates"><em class="fas fa-cloud-download-alt"></em> <span>System Update</span></a>
                </li>
            <?php } ?>
        </ul>
    </aside>
</div>