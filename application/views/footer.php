        <?php $footer_copyrights_text = $this->db->where('type', 'footer_copyrights_text')->get('tbl_settings')->row_array(); ?>
        <footer class="main-footer">
            <div class="footer-left">
                <?php
                if (isset($footer_copyrights_text) && !empty($footer_copyrights_text['message'])) { ?>
                    <?= $footer_copyrights_text['message'] ?>
                <?php } else { ?>
                    <?= lang('copyright'); ?> &copy; <?= date('Y') ?> <?= lang('made_by'); ?> <strong><a href="https://www.wrteam.in/" class="footer_dev_link" target="_blank">WRTeam</a></strong>
                <?php }
                ?>
            </div>
            <div class="footer-right">
            </div>
        </footer>

        <div class="modal fade" tabindex="-1" role="dialog" id="editCodeModal" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang('purchase_code'); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="<?= base_url() ?>set_setting" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <?php
                                $quiz_url = $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                                ?>
                                <input type="hidden" name="quiz_url" value="<?= $quiz_url; ?>" required />

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label><?= lang('purchase_code'); ?></label>
                                        <input type="text" name="purchase_code" required placeholder="<?= lang('enter_purchase_code'); ?>" class="form-control" />
                                    </div>
                                </div>

                                <div class="float-right">
                                    <input name="btnupdate" type="submit" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/js-color.min.js" type="text/javascript"></script>
        <!-- General JS Scripts -->
        <script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>

        <script src="<?= base_url(); ?>assets/js/popper.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/tooltip.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/nicescroll/jquery.nicescroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>

        <!-- Template JS File -->
        <script src="<?= base_url(); ?>assets/js/stisla.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/scripts.js" type="text/javascript"></script>

        <!-- Bootstrap Table JS -->
        <script src="<?= base_url(); ?>assets/bootstrap-table/bootstrap-table.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/bootstrap-table/extensions/export/tableexport.jquery.plugin/tableExport.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/bootstrap-table/extensions/export/jspdf/dist/jspdf.umd.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/bootstrap-table/extensions/export/bootstrap-table-export.min.js" type="text/javascript"></script>

        <script src="<?= base_url(); ?>assets/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js" type="text/javascript"></script>

        <!-- Light Box JS -->
        <script src="<?= base_url(); ?>assets/lightbox/lightbox.js" type="text/javascript"></script>
        <!-- Toast JS -->
        <script src="<?= base_url(); ?>assets/js/iziToast.min.js"></script>
        <!--Bootstrap Switch-->
        <script src="<?= base_url(); ?>assets/switchery/switchery.min.js" type="text/javascript"></script>
        <!--Bootstrap daterangepicker-->
        <script src="<?= base_url(); ?>assets/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.8.4/tinymce.min.js"></script>
        <script src="<?= base_url(); ?>assets/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>

        <?php if ($this->session->flashdata('success')) { ?>
            <script type='text/javascript'>
                iziToast.success({
                    message: '<?= $this->session->flashdata('success'); ?>',
                    timeout: 4e3,
                    position: 'topRight'
                });
            </script>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <script type='text/javascript'>
                iziToast.error({
                    message: '<?= $this->session->flashdata('error'); ?>',
                    timeout: 4e3,
                    position: 'topRight'
                });
            </script>
        <?php } ?>
        <script type='text/javascript'>
            function ErrorMsg(msg) {
                iziToast.error({
                    message: msg,
                    timeout: 4e3,
                    position: 'topRight'
                });
            }

            function SuccessMsg(msg) {
                iziToast.success({
                    message: msg,
                    timeout: 4e3,
                    position: 'topRight'
                });
            }
        </script>

        <script type='text/javascript'>
            $(".sidebar-menu a").each(function() {
                var pageUrl = window.location.href.split(/[?#]/)[0];
                var baseHref = this.href.split(/[?#]/)[0];
                if (this.href == pageUrl || pageUrl.startsWith(baseHref + '/')) {
                    $(this).parent().addClass("active"); // add active to li of the current link
                    $(this).parent().parent().addClass("show");
                    $(this).parent().parent().parent().addClass("active");
                }
            });
        </script>

        <script>
            function questionTypeFormatter(value) {
                if (value == 1) {
                    return "<span class='badge badge-primary'>Options</span>"
                } else {
                    return "<span class='badge badge-dark'>True/False</span>"
                }
            }
        </script>


        <script type="text/javascript">
            $(document).ready(function() {
                <?php if (!is_settings('system_key') || !is_settings('configuration_key')) { ?>
                    $('#editCodeModal').modal('show');
                <?php } ?>
            });

            function removeImage(id, image, table) {
                if (confirm('Are you sure? Want to remove Image?')) {
                    var base_url = "<?php echo base_url(); ?>";
                    $.ajax({
                        url: base_url + 'removeImage',
                        type: "POST",
                        data: 'id=' + id + '&image=' + image + '&table=' + table,
                        success: function(result) {
                            if (result) {
                                SuccessMsg('Image Remove SuccessFully...!')
                                $("#imageView").load(location.href + " #imageView");
                            } else {
                                ErrorMsg('Something went wrong');
                            }
                        },
                        error: function(result) {
                            ErrorMsg('Something went wrong');
                        }
                    });
                }
            }
        </script>

        <script>
            jscolor.presets.default = {
                format: 'hexa'
            };

            function createCkeditor() {
                for (let equation_editor in CKEDITOR.instances) {
                    CKEDITOR.instances[equation_editor].destroy();
                }
                CKEDITOR.replaceAll(function(textarea, config) {
                    if (textarea.className == "editor_questions" || textarea.className == "editor_options" || textarea.className == "edit_editor_options") {
                        config.mathJaxLib = "<?= base_url('assets/MathJax/MathJax.js?config=TeX-AMS_HTML') ?>";
                        config.extraPlugins = 'mathjax';
                        config.height = textarea.className == "editor_questions" ? 200 : 100;
                        return true;
                    }
                    return false;
                });

                // inline editors
                let elements = CKEDITOR.document.find('.editor-questions-inline'),
                    i = 0,
                    element;
                while ((element = elements.getItem(i++))) {
                    CKEDITOR.inline(element, {
                        mathJaxLib: "<?= base_url('assets/MathJax/MathJax.js?config=TeX-AMS_HTML') ?>",
                        extraPlugins: 'mathjax',
                        readOnly: true,
                    });
                }
            }
        </script>