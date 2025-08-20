<meta name="robots" content="noindex, nofollow, noarchive">
<!-- General CSS Files -->
<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
<!-- Template CSS -->
<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
<?php
$custom_colors = $this->db->where_in('type', ['theme_color', 'navbar_color', 'navbar_text_color'])->get('tbl_settings')->result_array();
$theme_color = "#f05387";
$navbar_color = "#00000000";
$navbar_text_color = "#ffffff";

foreach ($custom_colors as $color) {
        switch ($color['type']) {
                case 'theme_color':
                        $theme_color = $color['message'];
                        break;
                case 'navbar_color':
                        $navbar_color = $color['message'];
                        break;
                case 'navbar_text_color':
                        $navbar_text_color = $color['message'];
                        break;
        }
}
?>

<style>
        :root {
                --theme-color: <?= $theme_color ?>;
                --navbar-color: <?= $navbar_color ?>;
                --navbar-text-color: <?= $navbar_text_color ?>;
        }
</style>
<!-- Bootstrap Table CSS -->
<link href="<?= base_url(); ?>assets/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>assets/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css" rel="stylesheet" type="text/css">

<!-- Light Box CSS -->
<link href="<?= base_url(); ?>assets/lightbox/lightbox.css" rel="stylesheet" type="text/css" />
<!-- Toast CSS -->
<link href="<?= base_url(); ?>assets/css/iziToast.min.css" rel="stylesheet" type="text/css">
<!--Bootstrap Switch-->
<link href="<?= base_url(); ?>assets/switchery/switchery.min.css" rel="stylesheet" type="text/css">
<!--Bootstrap daterangepicker-->
<link href="<?= base_url(); ?>assets/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">

<link href="<?= base_url(); ?>assets/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<!-- Favicon -->
<link href="<?= base_url() . LOGO_IMG_PATH . is_settings('half_logo'); ?>" rel="shortcut icon" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">