<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('badges_settings'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('badges_settings'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('dashing_debut'); ?></h6>
                                                </div>
                                                <?php if (isset($dashing_debut) && !empty($dashing_debut['badge_icon'])) { ?>
                                                    <input name="dashing_debut_file" type="hidden" value="<?= $dashing_debut['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="dashing_debut_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($dashing_debut) && !empty($dashing_debut['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $dashing_debut['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="dashing_debut_reward" value="<?= (isset($dashing_debut) && !empty($dashing_debut['badge_reward'])) ? $dashing_debut['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="dashing_debut_counter" value="<?= (isset($dashing_debut) && !empty($dashing_debut['badge_counter'])) ? $dashing_debut['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('combat_winner'); ?></h6>
                                                </div>
                                                <?php if (isset($combat_winner) && !empty($combat_winner['badge_icon'])) { ?>
                                                    <input name="combat_winner_file" type="hidden" value="<?= $combat_winner['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="combat_winner_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($combat_winner) && !empty($combat_winner['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $combat_winner['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="combat_winner_reward" value="<?= (isset($combat_winner) && !empty($combat_winner['badge_reward'])) ? $combat_winner['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="combat_winner_counter" value="<?= (isset($combat_winner) && !empty($combat_winner['badge_counter'])) ? $combat_winner['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('clash_winner'); ?></h6>
                                                </div>
                                                <?php if (isset($clash_winner) && !empty($clash_winner['badge_icon'])) { ?>
                                                    <input name="clash_winner_file" type="hidden" value="<?= $clash_winner['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="clash_winner_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($clash_winner) && !empty($clash_winner['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $clash_winner['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="clash_winner_reward" value="<?= (isset($clash_winner) && !empty($clash_winner['badge_reward'])) ? $clash_winner['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="clash_winner_counter" value="<?= (isset($clash_winner) && !empty($clash_winner['badge_counter'])) ? $clash_winner['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('most_wanted_winner'); ?></h6>
                                                </div>
                                                <?php if (isset($most_wanted_winner) && !empty($most_wanted_winner['badge_icon'])) { ?>
                                                    <input name="most_wanted_winner_file" type="hidden" value="<?= $most_wanted_winner['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="most_wanted_winner_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($most_wanted_winner) && !empty($most_wanted_winner['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $most_wanted_winner['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="most_wanted_winner_reward" value="<?= (isset($most_wanted_winner) && !empty($most_wanted_winner['badge_reward'])) ? $most_wanted_winner['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="most_wanted_winner_counter" value="<?= (isset($most_wanted_winner) && !empty($most_wanted_winner['badge_counter'])) ? $most_wanted_winner['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('ultimate_player'); ?></h6>
                                                </div>
                                                <?php if (isset($ultimate_player) && !empty($ultimate_player['badge_icon'])) { ?>
                                                    <input name="ultimate_player_file" type="hidden" value="<?= $ultimate_player['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="ultimate_player_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($ultimate_player) && !empty($ultimate_player['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $ultimate_player['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="ultimate_player_reward" value="<?= (isset($ultimate_player) && !empty($ultimate_player['badge_reward'])) ? $ultimate_player['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('quiz_warrior'); ?></h6>
                                                </div>
                                                <?php if (isset($quiz_warrior) && !empty($quiz_warrior['badge_icon'])) { ?>
                                                    <input name="quiz_warrior_file" type="hidden" value="<?= $quiz_warrior['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="quiz_warrior_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($quiz_warrior) && !empty($quiz_warrior['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $quiz_warrior['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="quiz_warrior_reward" value="<?= (isset($quiz_warrior) && !empty($quiz_warrior['badge_reward'])) ? $quiz_warrior['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="quiz_warrior_counter" value="<?= (isset($quiz_warrior) && !empty($quiz_warrior['badge_counter'])) ? $quiz_warrior['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('super_sonic'); ?></h6>
                                                </div>
                                                <?php if (isset($super_sonic) && !empty($super_sonic['badge_icon'])) { ?>
                                                    <input name="super_sonic_file" type="hidden" value="<?= $super_sonic['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="super_sonic_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($super_sonic) && !empty($super_sonic['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $super_sonic['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="super_sonic_reward" value="<?= (isset($super_sonic) && !empty($super_sonic['badge_reward'])) ? $super_sonic['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small>(<?= lang('in_seconds'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="super_sonic_counter" value="<?= (isset($super_sonic) && !empty($super_sonic['badge_counter'])) ? $super_sonic['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('flashback'); ?></h6>
                                                </div>
                                                <?php if (isset($flashback) && !empty($flashback['badge_icon'])) { ?>
                                                    <input name="flashback_file" type="hidden" value="<?= $flashback['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="flashback_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($flashback) && !empty($flashback['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $flashback['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="flashback_reward" value="<?= (isset($flashback) && !empty($flashback['badge_reward'])) ? $flashback['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small>(<?= lang('in_seconds'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input type="number" name="flashback_counter" value="<?= (isset($flashback) && !empty($flashback['badge_counter'])) ? $flashback['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('brainiac'); ?></h6>
                                                </div>
                                                <?php if (isset($brainiac) && !empty($brainiac['badge_icon'])) { ?>
                                                    <input name="brainiac_file" type="hidden" value="<?= $brainiac['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="brainiac_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($brainiac) && !empty($brainiac['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $brainiac['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="brainiac_reward" value="<?= (isset($brainiac) && !empty($brainiac['badge_reward'])) ? $brainiac['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('big_thing'); ?></h6>
                                                </div>
                                                <?php if (isset($big_thing) && !empty($big_thing['badge_icon'])) { ?>
                                                    <input name="big_thing_file" type="hidden" value="<?= $big_thing['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="big_thing_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($big_thing) && !empty($big_thing['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $big_thing['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="big_thing_reward" value="<?= (isset($big_thing) && !empty($big_thing['badge_reward'])) ? $big_thing['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="big_thing_counter" value="<?= (isset($big_thing) && !empty($big_thing['badge_counter'])) ? $big_thing['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('elite'); ?></h6>
                                                </div>
                                                <?php if (isset($elite) && !empty($elite['badge_icon'])) { ?>
                                                    <input name="elite_file" type="hidden" value="<?= $elite['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="elite_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($elite) && !empty($elite['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $elite['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="elite_reward" value="<?= (isset($elite) && !empty($elite['badge_reward'])) ? $elite['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="elite_counter" value="<?php echo (isset($elite) && !empty($elite['badge_counter'])) ? $elite['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('thirsty'); ?></h6>
                                                </div>
                                                <?php if (isset($thirsty) && !empty($thirsty['badge_icon'])) { ?>
                                                    <input name="thirsty_file" type="hidden" value="<?= $thirsty['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="thirsty_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($thirsty) && !empty($thirsty['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $thirsty['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="thirsty_reward" value="<?= (isset($thirsty) && !empty($thirsty['badge_reward'])) ? $thirsty['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small>(<?= lang('in_days'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="thirsty_counter" value="<?php echo (isset($thirsty) && !empty($thirsty['badge_counter'])) ? $thirsty['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('power_elite'); ?></h6>
                                                </div>
                                                <?php if (isset($power_elite) && !empty($power_elite['badge_icon'])) { ?>
                                                    <input name="power_elite_file" type="hidden" value="<?= $power_elite['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="power_elite_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($power_elite) && !empty($power_elite['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $power_elite['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="power_elite_reward" value="<?= (isset($power_elite) && !empty($power_elite['badge_reward'])) ? $power_elite['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="power_elite_counter" value="<?php echo (isset($power_elite) && !empty($power_elite['badge_counter'])) ? $power_elite['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('sharing_is_caring'); ?></h6>
                                                </div>
                                                <?php if (isset($sharing_caring) && !empty($sharing_caring['badge_icon'])) { ?>
                                                    <input name="sharing_caring_file" type="hidden" value="<?= $sharing_caring['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="sharing_caring_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($sharing_caring) && !empty($sharing_caring['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $sharing_caring['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="sharing_caring_reward" value="<?= (isset($sharing_caring) && !empty($sharing_caring['badge_reward'])) ? $sharing_caring['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="sharing_caring_counter" value="<?php echo (isset($sharing_caring) && !empty($sharing_caring['badge_counter'])) ? $sharing_caring['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <h6 class="font-weight-bold"><?= lang('streak'); ?></h6>
                                                </div>
                                                <?php if (isset($streak) && !empty($streak['badge_icon'])) { ?>
                                                    <input name="streak_file" type="hidden" value="<?= $streak['badge_icon'] ?>" />
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('icon'); ?></label>
                                                    <input name="streak_file" type="file" accept="image/*" class="form-control" />
                                                </div>
                                                <?php if (isset($streak) && !empty($streak['badge_icon'])) { ?>
                                                    <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                        <img src="<?= base_url() . BADGE_IMG_PATH . $streak['badge_icon'] ?>" width="80" height="80" />
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('reward'); ?> <small>(<?= lang('coins'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input name="streak_reward" value="<?= (isset($streak) && !empty($streak['badge_reward'])) ? $streak['badge_reward'] : "" ?>" type="number" min="1" required class="form-control" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 col-lg-3 col-xl-2">
                                                    <label class="control-label"><?= lang('counter'); ?> <small>(<?= lang('in_days'); ?>)</small> <small class="text-danger">*</small></label>
                                                    <input type="number" min="1" name="streak_counter" value="<?php echo (isset($streak) && !empty($streak['badge_counter'])) ? $streak['badge_counter'] : "" ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <hr>
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


</body>
<script>
    function queryParams(p) {
        return {
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            limit: p.limit,
            search: p.search
        };
    }
</script>

</html>