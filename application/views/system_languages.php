<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('system_languages') ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('system_languages') ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-2">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="adminpanel-tab4" data-toggle="tab" href="#panelLanguage" role="tab"
                                                    aria-controls="adminpanel" aria-selected="true"><?= lang('admin_panel') ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="app-tab4" data-toggle="tab" href="#appLanguage" role="tab"
                                                    aria-controls="app" aria-selected="false"><?= lang('app') ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="web-tab4" data-toggle="tab" href="#webLanguage" role="tab"
                                                    aria-controls="web" aria-selected="false"><?= lang('web') ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-10">
                                <div class="tab-content no-padding" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="panelLanguage" role="tabpanel" aria-labelledby="adminpanel-tab4">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><?= lang('add_panel_languages') ?></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                            <div class="form-group row">
                                                                <div class="col-md-6 col-sm-12">
                                                                    <label class="control-label"><?= lang('language_name') ?></label> <small class="text-danger">*</small>
                                                                    <input type="text" name="language_name" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="btnadd" value="<?= lang('submit') ?>" class="<?= BUTTON_CLASS ?>" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><?= lang('panel_language_list') ?> <small><?= lang('view_update_delete') ?></small></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <table aria-describedby="mydesc" class='table-striped' id='system_languages_list' data-toggle="table" data-url="<?= base_url() . 'Table/system_langauge' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "system-language-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" data-field="no" data-sortable="false"><?= lang('sr_no') ?></th>
                                                                    <th scope="col" data-field="title" data-sortable="false"><?= lang('language_name') ?></th>
                                                                    <th scope="col" data-field="operate" data-sortable="false" data-events="actionEvents" data-force-hide="true"><?= lang('operate') ?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="appLanguage" role="tabpanel" aria-labelledby="app-tab4">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><?= lang('add_app_languages') ?></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                            <div class="form-group row">
                                                                <div class="col-md-5 col-sm-12">
                                                                    <label class="control-label"><?= lang('language') ?></label> <small class="text-danger">*</small>
                                                                    <input type="text" name="app_language_name" class="form-control" required>
                                                                </div>
                                                                <div class="form-group col-md-3 col-sm-6">
                                                                    <label class="control-label"><?= lang('rtl_support') ?></label><br>
                                                                    <input type="checkbox" name="app_rtl_support" data-plugin="switchery" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="btnaddapp" value="<?= lang('submit') ?>" class="<?= BUTTON_CLASS ?>" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><?= lang('app_language_list') ?> <small><?= lang('view_update_delete') ?></small></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <table aria-describedby="mydesc" class='table-striped' id='app_system_languages_list' data-toggle="table" data-url="<?= base_url() . 'Table/app_system_langauge' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "app-system-language-list-<?= date('d-m-y') ?>" }' data-query-params="queryParamsApp">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" data-field="no" data-sortable="false"><?= lang('sr_no') ?></th>
                                                                    <th scope="col" data-field="title" data-sortable="true"><?= lang('language_name') ?></th>
                                                                    <th scope="col" data-field="app_default" data-sortable="true" data-formatter="appDefault"><?= lang('default') ?></th>
                                                                    <th scope="col" data-field="app_status" data-sortable="true" data-formatter="appStatus"><?= lang('app_status') ?></th>
                                                                    <th scope="col" data-field="app_version" data-sortable="true"><?= lang('app_version') ?></th>
                                                                    <th scope="col" data-field="app_rtl_support" data-sortable="true" data-formatter="appRTL"><?= lang('rtl_support') ?></th>
                                                                    <th scope="col" data-field="operate" data-sortable="false" data-events="actionEventsApp" data-force-hide="true"><?= lang('operate') ?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="webLanguage" role="tabpanel" aria-labelledby="web-tab4">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><?= lang('add_web_languages') ?></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                            <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required />
                                                            <div class="form-group row">
                                                                <div class="col-md-5 col-sm-12">
                                                                    <label class="control-label"><?= lang('language_name') ?></label> <small class="text-danger">*</small>
                                                                    <input type="text" name="web_language_name" class="form-control" required>
                                                                </div>

                                                                <div class="form-group col-md-3 col-sm-6">
                                                                    <label class="control-label"><?= lang('rtl_support') ?></label><br>
                                                                    <input type="checkbox" name="web_rtl_support" data-plugin="switchery" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" name="btnaddweb" value="<?= lang('submit') ?>" class="<?= BUTTON_CLASS ?>" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><?= lang('web_language_list') ?> <small><?= lang('view_update_delete') ?></small></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <table aria-describedby="mydesc" class='table-striped' id='web_system_languages_list' data-toggle="table" data-url="<?= base_url() . 'Table/web_system_langauge' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "web-system-language-list-<?= date('d-m-y') ?>" }' data-query-params="queryParamsWeb">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" data-field="no" data-sortable="false"><?= lang('sr_no') ?></th>
                                                                    <th scope="col" data-field="title" data-sortable="true"><?= lang('language_name') ?></th>
                                                                    <th scope="col" data-field="web_default" data-sortable="true" data-formatter="webDefault"><?= lang('default') ?></th>
                                                                    <th scope="col" data-field="web_status" data-sortable="true" data-formatter="webStatus"><?= lang('web_status') ?></th>
                                                                    <th scope="col" data-field="web_version" data-sortable="true"><?= lang('web_version') ?></th>
                                                                    <th scope="col" data-field="web_rtl_support" data-sortable="true" data-formatter="webRTL"><?= lang('rtl_support') ?></th>
                                                                    <th scope="col" data-field="operate" data-sortable="false" data-events="actionEventsWeb" data-force-hide="true"><?= lang('operate') ?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editDataModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('edit_panel_language_file') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="language_name" id="language_name">
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('language_name') ?></label>
                                    <input id="update_name" name="update_name" type="text" class="form-control" required placeholder="<?= lang('enter_language_name') ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('file') ?> <small><?= lang('leave_it_blank') ?></small></label>
                                    <input id="update_file" name="update_file" type="file" accept=".php" class="form-control">
                                    <small class="text-danger"><?= lang('file_type_support_php') ?></small>
                                    <div style="display: none" id="up_file_error_msg" class="alert alert-danger"></div>
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close') ?></button>
                                <input name="btnupdate" type="submit" id="btnupdate" value="<?= lang('save_changes') ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editDataModalApp">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('edit_app_language_file') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="app_language_name" id="app_language_name">
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('language_name') ?></label>
                                    <input id="app_update_name" name="app_update_name" type="text" class="form-control" required placeholder="<?= lang('enter_language_name') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('status') ?></label><br>
                                    <input type="checkbox" id="app_status" name="app_status" data-plugin="switchery">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('default') ?></label><br>
                                    <input type="checkbox" id="app_default" name="app_default" data-plugin="switchery">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('rtl_support') ?></label><br>
                                    <input type="checkbox" id="app_rtl_support" name="app_rtl_support" data-plugin="switchery">
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close') ?></button>
                                <input name="btnupdateapp" type="submit" id="btnupdateapp" value="<?= lang('save_changes') ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editDataModalWeb">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('edit_web_language_file') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="web_language_name" id="web_language_name">
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('language_name') ?> <small class="text-danger">*</small></label>
                                    <input id="web_update_name" name="web_update_name" type="text" class="form-control" required placeholder="<?= lang('enter_language_name') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('status') ?></label><br>
                                    <input type="checkbox" id="web_status" name="web_status" data-plugin="switchery">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('default') ?></label><br>
                                    <input type="checkbox" id="web_default" name="web_default" data-plugin="switchery">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('rtl_support') ?></label><br>
                                    <input type="checkbox" id="web_rtl_support" name="web_rtl_support" data-plugin="switchery">
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close') ?></button>
                                <input name="btnupdateweb" type="submit" id="btnupdateweb" value="<?= lang('save_changes') ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
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
        $('[data-plugin="switchery"]').on('change', function() {
            if ($(this).prop('checked') == true) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        })
    </script>
    <script type="text/javascript">
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#update_name').val(row.name);
                $('#btnupdate').attr('data-lang', row.name);
            }
        };
        window.actionEventsApp = {
            'click .edit-data': function(e, value, row, index) {
                $('#app_update_name').val(row.name);
                $('#btnupdateapp').attr('data-lang', row.name);
                $('#app_rtl_support').val(row.app_rtl_support);
                $("#app_rtl_support").prop("checked", true).trigger("click");
                if (row.app_rtl_support == 1) {
                    $("#app_rtl_support").prop("checked", false).trigger("click");
                }
                $('#app_status').val(row.app_status);
                $("#app_status").prop("checked", true).trigger("click");
                if (row.app_status == 1) {
                    $("#app_status").prop("checked", false).trigger("click");
                }
                $('#app_default').val(row.app_default);
                $("#app_default").prop("checked", true).trigger("click");
                if (row.app_default == 1) {
                    $("#app_default").prop("checked", false).trigger("click");
                }
            }
        };
        window.actionEventsWeb = {
            'click .edit-data': function(e, value, row, index) {
                $('#web_update_name').val(row.name);
                $('#btnupdateweb').attr('data-lang', row.name);
                $('#web_rtl_support').val(row.web_rtl_support);
                $("#web_rtl_support").prop("checked", true).trigger("click");
                if (row.web_rtl_support == 1) {
                    $("#web_rtl_support").prop("checked", false).trigger("click");
                }
                $('#web_status').val(row.web_status);
                $("#web_status").prop("checked", true).trigger("click");
                if (row.web_status == 1) {
                    $("#web_status").prop("checked", false).trigger("click");
                }
                $('#web_default').val(row.web_default);
                $("#web_default").prop("checked", true).trigger("click");
                if (row.web_default == 1) {
                    $("#web_default").prop("checked", false).trigger("click");
                }
            }
        };

        function appRTL(value, row) {
            let html = "";
            if (row.app_rtl_support == 1) {
                html = "<span class='badge badge-success'><?= lang('yes'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('no'); ?></span>";
            }
            return html;
        }

        function webRTL(value, row) {
            let html = "";
            if (row.web_rtl_support == 1) {
                html = "<span class='badge badge-success'><?= lang('yes'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('no'); ?></span>";
            }
            return html;
        }

        function appStatus(value, row) {
            let html = "";
            if (row.app_status == 1) {
                html = "<span class='badge badge-success'><?= lang('active'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('deactive'); ?></span>";
            }
            return html;
        }

        function webStatus(value, row) {
            let html = "";
            if (row.web_status == 1) {
                html = "<span class='badge badge-success'><?= lang('active'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('deactive'); ?></span>";
            }
            return html;
        }

        function appDefault(value, row) {
            let html = "";
            if (row.app_default == 1) {
                html = "<span class='badge badge-success'><?= lang('yes'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('no'); ?></span>";
            }
            return html;
        }

        function webDefault(value, row) {
            let html = "";
            if (row.web_default == 1) {
                html = "<span class='badge badge-success'><?= lang('yes'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('no'); ?></span>";
            }
            return html;
        }

        $(document).ready(function() {
            // Javascript to enable link to tab
            var hash = location.hash.replace(/^#/, ''); // ^ means starting, meaning only match the first hash
            if (hash) {
                $('.nav-pills a[href="#' + hash + '"]').tab('show');
            }
            // Change hash for page-reload
            $('.nav-pills a').on('shown.bs.tab', function(e) {
                e.preventDefault();
                window.history.pushState(null, null, e.target.hash);
            })

            $('input[name="btnupdate"]').click(function() {
                var language_name = $(this).data('lang');
                $('#language_name').val(language_name);
            });

            $('input[name="btnupdateapp"]').click(function() {
                var language_name = $(this).data('lang');
                $('#app_language_name').val(language_name);
            });

            $('input[name="btnupdateweb"]').click(function() {
                var language_name = $(this).data('lang');
                $('#web_language_name').val(language_name);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm('<?= lang('sure_to_delete_language') ?>')) {
                var base_url = "<?php echo base_url(); ?>";
                language_name = $(this).data("lang");
                $.ajax({
                    url: base_url + 'delete-system-languages',
                    type: "POST",
                    data: "language_name=" + language_name,
                    success: function(result) {
                        if (result == 1) {
                            $('#system_languages_list').bootstrapTable('refresh');
                        } else if (result == 2) {
                            ErrorMsg("<?= lang('can_not_delete_one_language_have_to_enable') ?>");
                        } else {
                            var PERMISSION_ERROR_MSG = "<?= lang(PERMISSION_ERROR_MSG); ?>";
                            ErrorMsg(PERMISSION_ERROR_MSG);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.delete-app-data', function() {
            if (confirm('<?= lang('sure_to_delete_language') ?>')) {
                var base_url = "<?php echo base_url(); ?>";
                language_name = $(this).data("lang");
                $.ajax({
                    url: base_url + 'delete-app-system-languages',
                    type: "POST",
                    data: "language_name=" + language_name,
                    success: function(result) {
                        if (result == 1) {
                            $('#app_system_languages_list').bootstrapTable('refresh');
                        } else if (result == 2) {
                            ErrorMsg("<?= lang('can_not_delete_one_language_have_to_enable') ?>");
                        } else {
                            var PERMISSION_ERROR_MSG = "<?= lang(PERMISSION_ERROR_MSG); ?>";
                            ErrorMsg(PERMISSION_ERROR_MSG);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.delete-web-data', function() {
            if (confirm('<?= lang('sure_to_delete_language') ?>')) {
                var base_url = "<?php echo base_url(); ?>";
                language_name = $(this).data("lang");
                $.ajax({
                    url: base_url + 'delete-web-system-languages',
                    type: "POST",
                    data: "language_name=" + language_name,
                    success: function(result) {
                        if (result == 1) {
                            $('#web_system_languages_list').bootstrapTable('refresh');
                        } else if (result == 2) {
                            ErrorMsg("<?= lang('can_not_delete_one_language_have_to_enable') ?>");
                        } else {
                            var PERMISSION_ERROR_MSG = "<?= lang(PERMISSION_ERROR_MSG); ?>";
                            ErrorMsg(PERMISSION_ERROR_MSG);
                        }
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        function queryParams(p) {
            return {
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }

        function queryParamsApp(p) {
            return {
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }

        function queryParamsWeb(p) {
            return {
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }
    </script>

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;
        var validExtensions = ['php']; // Allowed file extensions

        $("#file").change(function(e) {
            var file;
            if ((file = this.files[0])) {
                var fileName = file.name;
                var fileExtension = fileName.split('.').pop().toLowerCase(); // Get the file extension
                if (!validExtensions.includes(fileExtension)) {
                    $('#file').val('');
                    $('#file_error_msg').html('<?= lang(INVALID_FILE_TYPE); ?>');
                    $('#file_error_msg').show().delay(3000).fadeOut();
                }
            }
        });

        $("#update_file").change(function(e) {
            var file, img;
            if ((file = this.files[0])) {
                var fileName = file.name;
                var fileExtension = fileName.split('.').pop().toLowerCase(); // Get the file extension
                if (!validExtensions.includes(fileExtension)) {
                    $('#update_file').val('');
                    $('#up_file_error_msg').html('<?= lang(INVALID_FILE_TYPE); ?>');
                    $('#up_file_error_msg').show().delay(3000).fadeOut();
                }
            }
        });

        $("#app_file").change(function(e) {
            var file;
            if ((file = this.files[0])) {
                if (file.type !== 'application/json') {
                    $('#app_file').val('');
                    $('#app_file_error_msg').html('<?= lang(INVALID_FILE_TYPE); ?>');
                    $('#app_file_error_msg').show().delay(3000).fadeOut();
                }
            }
        });

        $("#app_update_file").change(function(e) {
            var file;
            if ((file = this.files[0])) {
                if (file.type !== 'application/json') {
                    $('#app_update_file').val('');
                    $('#app_up_file_error_msg').html('<?= lang(INVALID_FILE_TYPE); ?>');
                    $('#app_up_file_error_msg').show().delay(3000).fadeOut();
                }
            }
        });


        $("#web_file").change(function(e) {
            var file;
            if ((file = this.files[0])) {
                if (file.type !== 'application/json') {
                    $('#web_file').val('');
                    $('#web_file_error_msg').html('<?= lang(INVALID_FILE_TYPE); ?>');
                    $('#web_file_error_msg').show().delay(3000).fadeOut();
                }
            }
        });

        $("#web_update_file").change(function(e) {
            var file;
            if ((file = this.files[0])) {
                if (file.type !== 'application/json') {
                    $('#web_update_file').val('');
                    $('#web_up_file_error_msg').html('<?= lang(INVALID_FILE_TYPE); ?>');
                    $('#web_up_file_error_msg').show().delay(3000).fadeOut();
                }
            }
        });
    </script>

</body>

</html>