<?php
class MultiLanguageLoader
{
    function initialize()
    {
        $ci = &get_instance();
        $ci->load->database();
        $userData = $ci->db->where('auth_id',  $ci->session->userdata('authId'))->get('tbl_authenticate')->row_array();
        // load language helper
        $ci->load->helper('language');
        $siteLang = $userData['language'] ?? 'sample_file';

        $folder_path = LANGUAGE_PATH . '/' . $siteLang . '/';
        $file_name = $siteLang . '_lang.php';
        $existing_file = $folder_path . $file_name;

        if ($siteLang && file_exists($existing_file)) {
            // difine all language files
            $ci->lang->load($siteLang, $siteLang);
        } else {
            // default language files
            $ci->lang->load('sample_file', 'sample_file');
        }
    }
}
