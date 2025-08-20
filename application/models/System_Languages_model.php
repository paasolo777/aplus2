<?php

defined('BASEPATH') or exit('No direct script access allowed');

class System_Languages_model extends CI_Model
{
    private function normalize_name($name)
    {
        $normalized_name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $normalized_name = preg_replace('/[^a-zA-Z0-9_]/', '_', $normalized_name);

        return $normalized_name;
    }

    public function add_data()
    {
        $name = strtolower($this->input->post('language_name'));
        $name = $this->normalize_name($name);
        $folder = url_title($name, 'dash', TRUE);
        $folder_path = LANGUAGE_PATH . $folder . '/';
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0777, TRUE);
        }

        $this->load->helper('file');
        $sample_path = LANGUAGE_PATH . 'sample_file/sample_file_lang.php';
        $file_name = $folder . '_lang.php';
        $file_path = $folder_path . $file_name;

        $content = file_get_contents($sample_path);
        write_file($file_path, $content);
    }

    public function update_language_file($missing_keys, $folder)
    {
        $file_name = $folder . '_lang.php';
        $file_path = LANGUAGE_PATH . $folder . '/' . $file_name;
        chmod($file_path, 0777);
        // Check if the file is writable
        if (!is_writable($file_path)) {
            return false;
        }
        $lang_file_path = $file_path;
        if (file_exists($lang_file_path)) {
            // Include the existing language file
            include($lang_file_path);

            // Update language keys with new values
            foreach ($missing_keys as $key => $value) {
                $lang[$key] = $value; // Update the value
            }

            // Prepare the new content to write back to the file
            $new_content = "<?php\n";
            foreach ($lang as $key => $value) {
                $new_content .= '$lang["' . ($key) . '"] = "' . ($value) . "\";\n";
            }
            return file_put_contents($lang_file_path, $new_content) !== false;
        }
    }

    public function delete_data($language_name)
    {
        $folder_path1 = LANGUAGE_PATH;
        $all_items = scandir($folder_path1);
        // Filter out only the directories, excluding "." and ".."
        $folders = array_filter($all_items, function ($item) use ($folder_path1) {
            return is_dir($folder_path1 . $item) && $item != '.' && $item != '..';
        });

        // Count the number of folders
        $count = count($folders);
        $total = $count - 1;
        if ($total > 1) {
            $folder_path = LANGUAGE_PATH . $language_name . '/';
            $file_name = $language_name . '_lang.php';
            $existing_file = $folder_path . $file_name;
            if (file_exists($existing_file)) {
                chmod($existing_file, 0755);
                unlink($existing_file);
            }
            if (is_dir($folder_path)) {
                chmod($folder_path, 0755);
                rmdir($folder_path);
            }
            return 1;
        } else {
            return 2;
        }
    }

    //--------------------- app ---------------------------

    public function add_app_data()
    {
        $get_name = strtolower($this->input->post('app_language_name'));
        $get_name = $this->normalize_name($get_name);
        $name = url_title($get_name, 'dash', TRUE);
        $title = $this->input->post('app_language_name');
        $folder_path = APP_LANGUAGE_FILE_PATH;
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0777, TRUE);
        }
        $this->load->helper('file');
        $sample_path = $folder_path . 'app_sample_file.json';
        $file_path = $folder_path . $name . '.json';
        $content = file_get_contents($sample_path);
        write_file($file_path, $content);

        $checkData = $this->db->where('name', $name)->get('tbl_upload_languages')->row_array();
        $app_rtl_support = $this->input->post('app_rtl_support') ? $this->input->post('app_rtl_support') : 0;
        if (empty($checkData)) {
            $addData = array(
                'name' => $name,
                'title' => $title,
                'app_version' => '0.0.1',
                'web_version' => '0.0.0',
                'app_rtl_support' => $app_rtl_support,
                'web_rtl_support' => 0,
                'app_status' => 0,
                'web_status' => 0,
                'app_default' => 0,
                'web_default' => 0,
            );
            $this->db->insert('tbl_upload_languages', $addData);
        } else {
            $id = $checkData['id'];
            $updateData = array('app_version' => '0.0.1', 'app_rtl_support' => $app_rtl_support, 'app_status' => 0, 'app_default' => 0);
            $this->db->where('id', $id)->update('tbl_upload_languages', $updateData);
        }
    }

    public function update_app_data()
    {
        $get_name = strtolower($this->input->post('app_language_name'));
        $get_name = $this->normalize_name($get_name);
        $name = url_title($get_name, 'dash', TRUE);
        $app_rtl_support = $this->input->post('app_rtl_support') ? $this->input->post('app_rtl_support') : 0;
        $app_status = $this->input->post('app_status');
        $app_default = $this->input->post('app_default');

        $checkData = $this->db->where('name', $name)->get('tbl_upload_languages')->row_array();
        $updateData = [
            'app_rtl_support' => $app_rtl_support,
            'app_status' => $app_status,
        ];
        $message = "";
        if ($app_default) {
            $updateData['app_default'] = 1;
            $updateData['app_status'] = 1;
            $this->db->where('id !=', $checkData['id'])->update('tbl_upload_languages', ['app_default' => 0]);
            if ($checkData['app_status'] == 0 && $checkData['app_default'] == 0) {
                $message = lang('default_status_activated');
            } else if ($app_status == 0) {
                $message = lang('default_language_must_active');
            } else {
                $message = lang('data_updated_successfully');
            }
        } elseif ($app_status == 0 && $checkData['app_default'] == 1) {
            $updateData['app_status'] = 1;
            $message = lang('default_language_must_active');
        } else {
            $existingDefault = $this->db->where('app_default', 1)->where('id !=', $checkData['id'])->get('tbl_upload_languages')->row_array();
            if (!$existingDefault) {
                $updateData['app_default'] = 1;
                $message = lang('default_language_require_set_as_default');
            } else {
                $updateData['app_default'] = 0;
                $message = lang('data_updated_successfully');
            }
        }
        $this->db->where('id', $checkData['id'])->update('tbl_upload_languages', $updateData);
        return $message;
    }

    public function delete_app_data($language_name)
    {
        $count = $this->db->where('app_version!=', '0.0.0')->count_all_results('tbl_upload_languages');
        if ($count > 1) {
            $folder_path = APP_LANGUAGE_FILE_PATH;
            $file_name = $language_name . '.json';
            $existing_file = $folder_path . $file_name;
            if (file_exists($existing_file)) {
                chmod($existing_file, 0755);
                unlink($existing_file);
            }
            $checkData = $this->db->where('name', $language_name)->get('tbl_upload_languages')->row_array();
            if (!empty($checkData)) {
                $deleteData = $this->db->where('name', $language_name)->where('web_version', '0.0.0')->get('tbl_upload_languages')->row_array();
                if (!empty($deleteData)) {
                    $this->db->where('id', $deleteData['id'])->delete('tbl_upload_languages');
                } else {
                    $updateData = array('app_version' => '0.0.0');
                    $this->db->where('id', $checkData['id'])->update('tbl_upload_languages', $updateData);
                }
            }
            return 1;
        } else {
            return 2;
        }
    }

    //--------------------- web ---------------------------

    public function add_web_data()
    {
        $get_name = strtolower($this->input->post('web_language_name'));
        $get_name = $this->normalize_name($get_name);
        $name = url_title($get_name, 'dash', TRUE);
        $title = $this->input->post('web_language_name');

        $folder_path = WEB_LANGUAGE_FILE_PATH;
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0777, TRUE);
        }

        $this->load->helper('file');
        $sample_path = $folder_path . 'web_sample_file.json';
        $file_path = $folder_path . $name . '.json';
        $content = file_get_contents($sample_path);
        write_file($file_path, $content);

        $checkData = $this->db->where('name', $name)->get('tbl_upload_languages')->row_array();
        $web_rtl_support = $this->input->post('web_rtl_support') ? $this->input->post('web_rtl_support') : 0;
        if (empty($checkData)) {
            $addData = array(
                'name' => $name,
                'title' => $title,
                'app_version' => '0.0.0',
                'web_version' => '0.0.1',
                'web_rtl_support' => $web_rtl_support,
                'app_rtl_support' => 0,
                'app_status' => 0,
                'web_status' => 0,
                'app_default' => 0,
                'web_default' => 0
            );
            $this->db->insert('tbl_upload_languages', $addData);
        } else {
            $id = $checkData['id'];
            $updateData = array('web_version' => '0.0.1', 'web_rtl_support' => $web_rtl_support, 'web_status' => 0, 'web_default' => 0);
            $this->db->where('id', $id)->update('tbl_upload_languages', $updateData);
        }
    }

    public function update_web_data()
    {
        $get_name = strtolower($this->input->post('web_language_name'));
        $get_name = $this->normalize_name($get_name);
        $name = url_title($get_name, 'dash', TRUE);
        $web_rtl_support = $this->input->post('web_rtl_support') ? $this->input->post('web_rtl_support') : 0;
        $web_status = $this->input->post('web_status');
        $web_default = $this->input->post('web_default');

        $checkData = $this->db->where('name', $name)->get('tbl_upload_languages')->row_array();
        $updateData = [
            'web_rtl_support' => $web_rtl_support,
            'web_status' => $web_status,
        ];
        $message = "";
        if ($web_default) {
            $updateData['web_default'] = 1;
            $updateData['web_status'] = 1;
            $this->db->where('id !=', $checkData['id'])->update('tbl_upload_languages', ['web_default' => 0]);
            if ($checkData['web_status'] == 0 && $checkData['web_default'] == 0) {
                $message = lang('default_status_activated');
            } else if ($web_status == 0) {
                $message = lang('default_language_must_active');
            } else {
                $message = lang('data_updated_successfully');
            }
        } elseif ($web_status == 0 && $checkData['web_default'] == 1) {
            $updateData['web_status'] = 1;
            $message = lang('default_language_must_active');
        } else {
            $existingDefault = $this->db->where('web_default', 1)->where('id !=', $checkData['id'])->get('tbl_upload_languages')->row_array();
            if (!$existingDefault) {
                $updateData['web_default'] = 1;
                $message = lang('default_language_require_set_as_default');
            } else {
                $updateData['web_default'] = 0;
                $message = lang('data_updated_successfully');
            }
        }
        $this->db->where('id', $checkData['id'])->update('tbl_upload_languages', $updateData);
        return $message;
    }

    public function delete_web_data($language_name)
    {
        $count = $this->db->where('web_version!=', '0.0.0')->count_all_results('tbl_upload_languages');
        if ($count > 1) {
            $folder_path = WEB_LANGUAGE_FILE_PATH;
            $file_name = $language_name . '.json';
            $existing_file = $folder_path . $file_name;
            if (file_exists($existing_file)) {
                chmod($existing_file, 0755);
                unlink($existing_file);
            }
            $checkData = $this->db->where('name', $language_name)->get('tbl_upload_languages')->row_array();
            if (!empty($checkData)) {
                $deleteData = $this->db->where('name', $language_name)->where('app_version', '0.0.0')->get('tbl_upload_languages')->row_array();
                if (!empty($deleteData)) {
                    $this->db->where('id', $deleteData['id'])->delete('tbl_upload_languages');
                } else {
                    $updateData = array('web_version' => '0.0.0');
                    $this->db->where('id', $checkData['id'])->update('tbl_upload_languages', $updateData);
                }
            }
            return 1;
        } else {
            return 2;
        }
    }

    public function update_json_language_file($missing_keys, $file_path, $folder, $language_name)
    {
        if (!is_writable($file_path)) {
            return 1;
        }
        if (file_exists($file_path)) {
            $FileContent = file_get_contents($file_path);
            $languageArray = json_decode($FileContent, true);

            if (!is_array($languageArray)) {
                $languageArray = [];
            }

            $old_file = $languageArray;

            foreach ($missing_keys as $key => $value) {
                $safeKey = str_replace(' ', '_', $key);
                // Only add missing keys that do not exist in $languageArray
                if (!array_key_exists($safeKey, $languageArray)) {
                    $languageArray[$safeKey] = $value;
                }
            }

            $updatedlanguageArray = array_replace($languageArray, $missing_keys);
            $updatedJson = json_encode($updatedlanguageArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            if (file_put_contents($file_path, $updatedJson)) {
                $newData = json_decode(file_get_contents($file_path), true);
                if ($old_file != $newData) {
                    $checkData = $this->db->where('name', $language_name)->get('tbl_upload_languages')->row_array();
                    if (empty($checkData)) {
                        $addData = array(
                            'name' => $language_name,
                            'app_version' => '0.0.0',
                            'web_version' => '0.0.0',
                        );
                        if ($folder == 'app') {
                            $addData['app_version'] = '0.0.1';
                        } else if ($folder == 'web') {
                            $addData['web_version'] = '0.0.1';
                        }
                        $this->db->insert('tbl_upload_languages', $addData);
                    } else {
                        $id = $checkData['id'];
                        $updateData = [];
                        if ($folder == 'app') {
                            $current_version = $checkData['app_version'];
                            $updateData = array('app_version' => get_version($current_version));
                        } else if ($folder == 'web') {
                            $current_version = $checkData['web_version'];
                            $updateData = array('web_version' => get_version($current_version));
                        }
                        $this->db->where('id', $id)->update('tbl_upload_languages', $updateData);
                    }
                    return 2;
                } else {
                    return 2;
                }
            } else {
                return 3;
            }
        }
    }
}
