<?php

defined('BASEPATH') or exit('No direct script access allowed');

class System_Languages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        $this->category_type = $this->config->item('category_type');
    }

    private function normalize_name($name)
    {
        $normalized_name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $normalized_name = preg_replace('/[^a-zA-Z0-9_]/', '_', $normalized_name);

        return $normalized_name;
    }

    function switch($language = "")
    {
        $language = ($language != "") ? $language : "sample_file";
        $adminId = $this->session->userdata('authId');
        $data = array(
            'language' => $language
        );
        $this->db->where('auth_id', $adminId)->update('tbl_authenticate', $data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function index()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $folder = strtolower($this->input->post('language_name'));
                        $folder = $this->normalize_name($folder);
                        $folder_path = LANGUAGE_PATH . '/' . $folder . '/';
                        $file_name = $folder . '_lang.php';
                        $existing_file = $folder_path . $file_name;
                        if (!file_exists($existing_file) || !is_dir($folder_path)) {
                            $this->System_Languages_model->add_data();
                            $this->session->set_flashdata('success', lang('data_created_successfully'));
                        } else {
                            $this->session->set_flashdata('error', lang('language_already_exists'));
                        }
                    }
                    redirect('system-languages');
                } else if ($this->input->post('btnupdate')) {
                    if (!has_permissions('update', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->System_Languages_model->update_data();
                        $this->session->set_flashdata('success', lang('file_uploaded_successfully'));
                    }
                    redirect('system-languages');
                } else if ($this->input->post('btnaddapp')) {
                    if (!has_permissions('create', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $app_language_name = strtolower($this->input->post('app_language_name'));
                        $app_language_name = $this->normalize_name($app_language_name);
                        $file_name = $app_language_name . '.json';
                        $folder_path = APP_LANGUAGE_FILE_PATH . $file_name;
                        if (!file_exists($folder_path)) {
                            $this->System_Languages_model->add_app_data();
                            $this->session->set_flashdata('success', lang('data_created_successfully'));
                        } else {
                            $this->session->set_flashdata('error', lang('language_already_exists'));
                        }
                    }
                    redirect('system-languages');
                } else if ($this->input->post('btnupdateapp')) {
                    if (!has_permissions('update', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $data = $this->System_Languages_model->update_app_data();
                        if ($data && $data != '') {
                            $this->session->set_flashdata('success', $data);
                        }
                    }
                    redirect('system-languages');
                } else if ($this->input->post('btnaddweb')) {
                    if (!has_permissions('create', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $web_language_name = strtolower($this->input->post('web_language_name'));
                        $web_language_name = $this->normalize_name($web_language_name);
                        $file_name = $web_language_name . '.json';
                        $folder_path = WEB_LANGUAGE_FILE_PATH . $file_name;
                        if (!file_exists($folder_path)) {
                            $this->System_Languages_model->add_web_data();
                            $this->session->set_flashdata('success', lang('data_created_successfully'));
                        } else {
                            $this->session->set_flashdata('error', lang('language_already_exists'));
                        }
                    }
                    redirect('system-languages');
                } else if ($this->input->post('btnupdateweb')) {
                    if (!has_permissions('update', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $data = $this->System_Languages_model->update_web_data();
                        if ($data && $data != '') {
                            $this->session->set_flashdata('success', $data);
                        }
                    }
                    redirect('system-languages');
                }
            }
            $this->load->view('system_languages');
        }
    }

    public function delete_language_data()
    {
        if (!has_permissions('delete', 'system_languages')) {
            echo FALSE;
        } else {
            $language_name = $this->input->post('language_name');
            $data = $this->System_Languages_model->delete_data($language_name);
            echo $data;
        }
    }

    public function delete_app_language_data()
    {
        if (!has_permissions('delete', 'system_languages')) {
            echo FALSE;
        } else {
            $language_name = $this->input->post('language_name');
            $data = $this->System_Languages_model->delete_app_data($language_name);
            echo $data;
        }
    }

    public function delete_web_language_data()
    {
        if (!has_permissions('delete', 'system_languages')) {
            echo FALSE;
        } else {
            $language_name = $this->input->post('language_name');
            $data = $this->System_Languages_model->delete_web_data($language_name);
            echo $data;
        }
    }

    public function new_language_data()
    {
        $language_name = $this->uri->segment(2);
        $title = $language_name;

        $folder_path = LANGUAGE_PATH . $language_name . '/';
        $file_name = $language_name . '_lang.php';
        $existing_file = $folder_path . $file_name;
        $missing_keys = [];
        $set_label = 0;

        // Load the language helper
        if (file_exists($existing_file)) {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'system_languages')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->System_Languages_model->update_language_file($this->input->post('lang_val'), $language_name);
                    $this->session->set_flashdata('success', lang('data_updated_successfully'));
                }
                redirect('system-languages');
            }
            $this->load->helper('language');
            $current_lang = $this->lang->language;

            // Load both language files
            $get_lang = [];
            include(APPPATH . "language/" . $language_name . "/" . $language_name . "_lang.php");
            $get_lang = isset($lang) ? $lang : [];

            $this->lang->load('sample_file_lang', 'sample_file');
            $sample_file_lang = $this->lang->language;

            // Check if keys from sample_file_lang exist in get_lang
            foreach ($sample_file_lang as $key => $value) {
                if (!array_key_exists($key, $get_lang)) {
                    $missing_keys[$key] = $value;
                    $set_label = 1;
                }
            }
            if (empty($missing_keys)) {
                $missing_keys = $get_lang;
                $set_label = 2;
            }
            $this->lang->language = $current_lang;
        }
        $this->result['set_label'] = $set_label ?? 0;
        $this->result['missing_keys'] = $missing_keys;
        $this->result['language_name'] = $title;
        $this->load->view('new_label_file', $this->result);
    }

    public function new_json_language_data()
    {
        $missingKeys = [];
        $folder = $this->uri->segment(2);
        $language_name = $this->uri->segment(3);
        $path = '';
        $set_label = 0;
        if ($folder == 'app') {
            $path = APP_LANGUAGE_FILE_PATH;
        } else if ($folder == 'web') {
            $path = WEB_LANGUAGE_FILE_PATH;
        }
        if ($folder == 'app' || $folder == 'web') {
            // Set the file paths
            $sampleFilePath =  $path . $folder . '_sample_file.json';
            $getFilePath = $path . $language_name . '.json';

            // Load the contents of the JSON files
            if (file_exists($sampleFilePath) && file_exists($getFilePath)) {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'system_languages')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $data = $this->System_Languages_model->update_json_language_file($this->input->post('lang_val'), $getFilePath, $folder, $language_name);
                        if ($data == 1) {
                            $this->session->set_flashdata('error', lang('file_is_not_writable'));
                        } else if ($data == 2) {
                            $this->session->set_flashdata('success', lang('data_updated_successfully'));
                        } else if ($data == 3) {
                            $this->session->set_flashdata('error', lang('data_not_updated'));
                        }
                    }
                    redirect('system-languages');
                }
                $sampleFileContent = file_get_contents($sampleFilePath);
                $getFileContent = file_get_contents($getFilePath);

                // Decode JSON into associative arrays
                $sampleArray = json_decode($sampleFileContent, true);
                $getArray = json_decode($getFileContent, true);

                if (is_array($sampleArray) && is_array($getArray)) {
                    // Find the missing keys
                    $missingKeys = array_diff_key($sampleArray, $getArray);
                    $set_label = 1;
                }

                if (!$missingKeys) {
                    $missingKeys = ($getArray);
                    $set_label = 2;
                }
            }
            $this->result['set_label'] = $set_label ?? 0;
            $this->result['missing_keys'] = $missingKeys;
            $this->result['language_name'] = $language_name;
            $this->load->view('new_label_file', $this->result);
        } else {
            $this->session->set_flashdata('error', lang('something_wrong_please_try_again'));
            redirect('/');
        }
    }
}
