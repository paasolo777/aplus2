<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('authentication_settings') ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('authentication_settings') ?> <small class="text-small"> <?= lang('note_that_this_will_directly_reflect_on_app_and_web_login') ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <div class="form-group col-md-3 col-sm-6">
                                                    <label class="control-label"><?= lang('gmail') ?></label><br>
                                                    <input type="checkbox" id="gmail_btn" data-plugin="switchery" <?php
                                                                                                                    if (!empty($gmail_login) && $gmail_login['message'] == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>

                                                    <input type="hidden" id="gmail_login" name="gmail_login" value="<?= $gmail_login['message'] ?? 0; ?>">
                                                </div>
                                                <div class="form-group col-md-3 col-sm-6">
                                                    <label class="control-label"><?= lang('email') ?></label><br>
                                                    <input type="checkbox" id="email_btn" data-plugin="switchery" <?php
                                                                                                                    if (!empty($email_login) && $email_login['message'] == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>

                                                    <input type="hidden" id="email_login" name="email_login" value="<?= $email_login['message'] ?? 0; ?>">
                                                </div>
                                                <div class="form-group col-md-3 col-sm-6">
                                                    <label class="control-label"><?= lang('phone') ?></label><br>
                                                    <input type="checkbox" id="phone_btn" data-plugin="switchery" <?php
                                                                                                                    if (!empty($phone_login) && $phone_login['message'] == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>

                                                    <input type="hidden" id="phone_login" name="phone_login" value="<?= $phone_login['message'] ?? 0; ?>">
                                                </div>
                                                <div class="form-group col-md-3 col-sm-6">
                                                    <label class="control-label"><?= lang('apple') ?> <small class="text-danger"> <?= lang('if_you_have_the_ios_app_please_ensure_it_is_enabled') ?></small></label> <br>
                                                    <input type="checkbox" id="apple_btn" data-plugin="switchery" <?php
                                                                                                                    if (!empty($apple_login) && $apple_login['message'] == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>

                                                    <input type="hidden" id="apple_login" name="apple_login" value="<?= $apple_login['message'] ?? 0; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit') ?>" class="<?= BUTTON_CLASS ?>" />
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
        /* on change of gmail login btn - switchery js */
        var gmailCheckbox = document.querySelector('#gmail_btn');
        gmailCheckbox.onchange = function() {
            if (gmailCheckbox.checked) {
                $('#gmail_login').val(1);
            } else {
                $('#gmail_login').val(0);
            }
        };

        /* on change of email login btn - switchery js */
        var emailCheckbox = document.querySelector('#email_btn');
        emailCheckbox.onchange = function() {
            if (emailCheckbox.checked) {
                $('#email_login').val(1);
            } else {
                $('#email_login').val(0);
            }
        };

        /* on change of phone login btn - switchery js */
        var phoneCheckbox = document.querySelector('#phone_btn');
        phoneCheckbox.onchange = function() {
            if (phoneCheckbox.checked) {
                $('#phone_login').val(1);
            } else {
                $('#phone_login').val(0);
            }
        };

        /* on change of apple login btn - switchery js */
        var appleCheckbox = document.querySelector('#apple_btn');
        appleCheckbox.onchange = function() {
            if (appleCheckbox.checked) {
                $('#apple_login').val(1);
            } else {
                $('#apple_login').val(0);
            }
        };
    </script>

</body>

</html>