<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('questions_for_exam_module'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

    <?php base_url() . include 'include.php'; ?>
</head>

<body>
    <?php
    $exam_id = $this->uri->segment(2);
    ?>
    <div id="app">
        <div class="main-wrapper">
            <?php base_url() . include 'header.php'; ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= lang('manage_exam_questions'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" id="exam_module_id" name="exam_module_id" value="<?= $this->uri->segment(2) ?>" />
                                        <table aria-describedby="mydesc" class='table-striped' id='question_list' data-toggle="table" data-url="<?= base_url() . 'Table/exam_module_questions' ?>" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "exam-questions-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="question" data-sortable="true"><?= lang('question'); ?></th>
                                                    <th scope="col" data-field="question_type" data-sortable="true" data-visible='false'><?= lang('question_type'); ?></th>
                                                    <th scope="col" data-field="optiona" data-sortable="true"><?= lang('option_a'); ?></th>
                                                    <th scope="col" data-field="optionb" data-sortable="true"><?= lang('option_b'); ?></th>
                                                    <th scope="col" data-field="optionc" data-sortable="true"><?= lang('option_c'); ?></th>
                                                    <th scope="col" data-field="optiond" data-sortable="true"><?= lang('option_d'); ?></th>
                                                    <?php if (is_option_e_mode_enabled()) { ?>
                                                        <th scope="col" data-field="optione" data-sortable="true"><?= lang('option_e'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="answer" data-sortable="true" data-visible='false'><?= lang('answer'); ?></th>
                                                    <th scope="col" data-field="marks" data-sortable="true"><?= lang('mark'); ?></th>
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
            $('#question_list').on('post-body.bs.table', function() {
                createCkeditor();
            })
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_questions'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_exam_module_questions',
                    type: "POST",
                    data: 'id=' + id + '&image_url=' + image,
                    success: function(result) {
                        if (result) {
                            $('#question_list').bootstrapTable('refresh');
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
                "language": $('#filter_language').val(),
                "exam_module_id": $('#exam_module_id').val(),
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