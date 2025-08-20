<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('payment_settings'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('payment_settings'); ?> <small class="text-small"><?= lang('update_payment_setting_here'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label class="control-label"><?= lang('payment'); ?> <small><?= lang('enable_disable'); ?></small></label><br>
                                                    <input type="checkbox" id="payment_mode_btn" data-plugin="switchery" <?php
                                                                                                                            if (!empty($payment_mode) && $payment_mode['message'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                            ?>>

                                                    <input type="hidden" id="payment_mode" name="payment_mode" value="<?= ($payment_mode) ? $payment_mode['message'] : 0; ?>">
                                                </div>
                                            </div>

                                            <hr class="row">
                                            <div class="text-danger text-small">
                                                <p>
                                                    <li><?= lang('all_coins_should_be_minimum_0_and_hour_minimum_1_value'); ?></li>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('per_coin'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 name="per_coin" value="<?= (!empty($per_coin)) ? $per_coin['message'] : '' ?>" required class="form-control" />
                                                </div>
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('per_amount'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 name="coin_amount" value="<?= (!empty($coin_amount)) ? $coin_amount['message'] : '' ?>" required class="form-control" />
                                                </div>
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('currency_symbol'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" name="currency_symbol" value="<?= (!empty($currency_symbol)) ? $currency_symbol['message'] : '' ?>" required class="form-control" />
                                                </div>
                                                <div class="form-group col-md-2 col-sm-6">
                                                    <label class="control-label"><?= lang('minimum_coins_for_request'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 name="coin_limit" value="<?= (!empty($coin_limit)) ? $coin_limit['message'] : '' ?>" required class="form-control" />
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label class="control-label"><?= lang('difference_in_hours_between_consecutive_payment_request'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min=1 name="difference_hours" value="<?= (!empty($difference_hours)) ? $difference_hours['message'] : '' ?>" required class="form-control" />
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
        $(document).ready(function() {

        });
    </script>
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
        /* on change of language mode btn - switchery js */
        var changeCheckbox = document.querySelector('#payment_mode_btn');
        changeCheckbox.onchange = function() {
            if (changeCheckbox.checked) {
                $('#payment_mode').val(1);
                $('#payment_message').prop('readonly', true);
                $('#payment_message').attr('required', 'required');
            } else {
                $('#payment_mode').val(0);
                $('#payment_message').prop('readonly', false);
                $('#payment_message').removeAttr('required');
            }
        };
    </script>

</body>

</html>