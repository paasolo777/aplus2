<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('question_reports_by_users'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('question_reports_by_users'); ?></h1>
                    </div>
                    <div class="section-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">

                                        <div id="toolbar">
                                            <?php if (has_permissions('delete', 'question_report')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_question_reports" title="<?= lang('delete_selected_question_report'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='report_list' data-toggle="table" data-url="<?= base_url() . 'Table/question_reports' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "report-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="user_id" data-sortable="true" data-visible='false'><?= lang('user_id'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="question_id" data-sortable="true" data-visible='false'><?= lang('question_id'); ?></th>
                                                    <th scope="col" data-field="question" data-sortable="true"><?= lang('question'); ?></th>
                                                    <th scope="col" data-field="message" data-sortable="true"><?= lang('message'); ?></th>
                                                    <th scope="col" data-field="date" data-sortable="true"><?= lang('date'); ?></th>
                                                    <th scope="col" data-field="operate" data-sortable="false"><?= lang('operate'); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
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
    <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#report_list').on('load-success.bs.table', function() {
                createCkeditor();
            });

            $('#report_list').on('column-switch.bs.table', function(e, field, checked) {
                createCkeditor();
            });
        });
    </script>
    <script type="text/javascript">
        $('input[name="edit_question_type"]').on("click", function(e) {
            var edit_question_type = $(this).val();

            if (edit_question_type == "2") {
                $('#edit_tf').hide('fast');
                $('#edit_a').val("<?= is_settings('true_value') ?>");
                $('#edit_b').val("<?= is_settings('false_value') ?>");
                $('#edit_c').removeAttr('required');
                $('#edit_d').removeAttr('required');
                $('#edit_e').removeAttr('required');
                $('.edit_ntf').hide('fast');
                $('#edit_answer').val('');
            } else {
                $('#edit_tf').show('fast');
                $('.edit_ntf').show('fast');
                $('#edit_c').attr("required", "required");
                $('#edit_d').attr("required", "required");
                $('#edit_e').attr("required", "required");
            }
        });
    </script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        var type = 'main-category';
        $('#update_language_id').on('change', function(e, row_language_id, row_category, row_subcategory) {
            var language_id = $('#update_language_id').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#edit_category').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#edit_category').html(result).trigger("change");
                    if (language_id == row_language_id && row_category != 0)
                        $('#edit_category').val(row_category).trigger("change", [row_category, row_subcategory]);
                }
            });
        });

        $('#edit_category').on('change', function(e, row_category, row_subcategroy) {
            var category_id = $('#edit_category').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_subcategories_of_category',
                data: 'category_id=' + category_id,
                beforeSend: function() {
                    $('#edit_subcategory').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#edit_subcategory').html(result);
                    if (category_id == row_category && row_subcategroy != 0)
                        $('#edit_subcategory').val(row_subcategroy);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('#filter_btn').on('click', function(e) {
            $('#report_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_question_reports').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_question_reports';
            is_image = 0;
            table = $('#report_list');
            delete_button = $('#delete_multiple_question_reports');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_reports_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_reports'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('question_reports_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_question_reports_try_again'); ?>");
                            }
                            delete_button.html('<i class="fa fa-trash"></i>');
                            table.bootstrapTable('refresh');
                        }
                    });
                }
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_report'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                $.ajax({
                    url: base_url + 'delete_question_report',
                    type: "POST",
                    data: 'id=' + id,
                    success: function(result) {
                        if (result) {
                            $('#report_list').bootstrapTable('refresh');
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
    </script>

</body>

</html>