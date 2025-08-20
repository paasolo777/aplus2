<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Multi_Match_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(get_system_timezone());
    }

    public function get_data($id)
    {
        return $this->db->where('id', $id)->order_by('id', 'DESC')->get('tbl_multi_match')->result();
    }

    public function import_data()
    {
        $name = explode(".", $_FILES['file']['name']);
        $file_extension = end($name);
        $error = '';
        if ($_FILES['file']['tmp_name'] != "" && $file_extension == "csv") {
            $filename = $_FILES['file']['tmp_name'];
            $file = fopen($filename, "r");
            $count = $count1 = 0;
            $type1_valid_values = ['a', 'b', 'c', 'd', 'e', '']; // Allowed values
            $type1_keys_to_check = [11, 12, 13, 14, 15]; // Only check these keys

            $type2_valid_values = ['a', 'b', '']; // Allowed values
            $type2_keys_to_check = [11, 12]; // Only check these keys


            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (count($emapData) > 2) {
                    $emapData[0] = $emapData[0]; //category
                    $emapData[1] = (empty($emapData[1])) ? "0" : $emapData[1]; //subcategory
                    $emapData[2] = (is_language_mode_enabled()) ? $emapData[2] : "0";   //language_id
                    $emapData[3] = trim($emapData[3]);   //question_type
                    $emapData[4] = $emapData[4];     //question
                    $emapData[5] = $emapData[5];    // optiona
                    $emapData[6] = $emapData[6];    // optionb
                    $emapData[7] = $emapData[7];    // optionc
                    $emapData[8] = $emapData[8];    // optiond
                    $emapData[9] = (empty($emapData[9])) ? "" : $emapData[9];  // optione
                    $emapData[10] = trim($emapData[10]);  //answer_type
                    $emapData[11] = trim(strtolower($emapData[11]));  //answer1
                    $emapData[12] = trim(strtolower($emapData[12]));  //answer2
                    $emapData[13] = trim(strtolower($emapData[13]));  //answer3
                    $emapData[14] = trim(strtolower($emapData[14]));  //answer4
                    $emapData[15] = trim(strtolower($emapData[15]));  //answer5
                    $emapData[16] = $emapData[16];       //level
                    $emapData[17] = $emapData[17];      // note
                    $count++;
                    if ($count > 1) {
                        $keys_to_check = ($emapData[3] == '1') ? $type1_keys_to_check : $type2_keys_to_check;
                        $valid_values = ($emapData[3] == '1') ? $type1_valid_values : $type2_valid_values;
                        $row_values = [];
                        foreach ($keys_to_check as $key) {
                            $value = trim(strtolower($emapData[$key])); // Normalize value
                            if (!in_array($emapData[$key], $valid_values, true)) {
                                $empty_value_found = false;
                                $error .= lang('invalid_value') . "&nbsp;<b>" . $emapData[$key] . "</b>&nbsp;" . lang('found_at_row') . "&nbsp;" . $count . "&nbsp;" . lang('of_index') . "&nbsp;" .  $key;
                                break;
                            } else {
                                $empty_value_found = true;
                            }

                            // // Check for duplicate values (except empty strings)
                            if ($value && $value !== '' && isset($row_values[$value])) {
                                $empty_value_found = false;
                                $error .= lang('duplicate_value') . "&nbsp;<b>" . $emapData[$key] . "</b>&nbsp;" . lang('found_at_row') . "&nbsp;" .  $count . "&nbsp;" . lang('of_index') . "&nbsp;" .  $key;
                                break;
                            } else {
                                $empty_value_found = true;
                            }
                            $row_values[$value] = true;
                        }
                        if ($empty_value_found) {
                            if ($emapData[3] == '1') {
                                if ($emapData[0] != '' && $emapData[1] != '' && $emapData[2] != '' && !empty($emapData[3]) && $emapData[4] != '' && $emapData[5] != '' && $emapData[6] != '' && $emapData[7] != '' && $emapData[8] != '' && !empty($emapData[10]) && $emapData[11] != '' && $emapData[12] != '' && $emapData[13] != '' && $emapData[14] != '' && $emapData[16]) {
                                    $empty_value_found = true;
                                } else {
                                    $empty_value_found = false;
                                    $error .= lang('please_check') . ' ' . $count . ' ' . lang('row');
                                    break;
                                }
                            } else if ($emapData[3] == '2') {
                                if ($emapData[0] != '' && $emapData[1] != '' && $emapData[2] != '' && !empty($emapData[3]) && $emapData[4] != '' && $emapData[5] != '' && $emapData[6] != '' && !empty($emapData[10]) && $emapData[11] != '' && $emapData[12] != '' && $emapData[16]) {
                                    $empty_value_found = true;
                                } else {
                                    $empty_value_found = false;
                                    $error .= lang('please_check') . ' ' . $count . ' ' . lang('row');
                                    break;
                                }
                            } else {
                                $empty_value_found = false;
                                break;
                            }
                        } else {
                            $empty_value_found = false;
                            break;
                        }
                    }
                }
            }
            fclose($file);
            if ($empty_value_found == TRUE) {
                $file = fopen($filename, "r");
                while (($emapData1 = fgetcsv($file, 10000, ",")) !== FALSE) {
                    if (count($emapData1) > 2) {
                        $emapData1[0] = $emapData1[0]; //category
                        $emapData1[1] = (empty($emapData1[1])) ? "0" : $emapData1[1]; //subcategory
                        $emapData1[2] = (is_language_mode_enabled()) ? $emapData1[2] : "0";   //language_id
                        $emapData1[3] = trim($emapData1[3]);   //question_type
                        $emapData1[4] = $emapData1[4];     //question
                        $emapData1[5] = $emapData1[5];    // optiona
                        $emapData1[6] = $emapData1[6];    // optionb
                        $emapData1[7] = $emapData1[7];    // optionc
                        $emapData1[8] = $emapData1[8];    // optiond
                        $emapData1[9] = (empty($emapData1[9])) ? "" : $emapData1[9];  // optione
                        $emapData1[10] = trim($emapData1[10]);   //answer_type
                        $emapData1[11] = trim(strtolower($emapData1[11]));  //answer1
                        $emapData1[12] = trim(strtolower($emapData1[12]));  //answer2
                        $emapData1[13] = trim(strtolower($emapData1[13]));  //answer3
                        $emapData1[14] = trim(strtolower($emapData1[14]));  //answer4
                        $emapData1[15] = trim(strtolower($emapData1[15]));  //answer5
                        $emapData1[16] = $emapData1[16];       //level
                        $emapData1[17] = $emapData1[17];      // note
                        $answer = '';
                        if ($emapData1[3] == 1) {
                            $answer = implode(',', array_filter([$emapData1[11], $emapData1[12], $emapData1[13], $emapData1[14], $emapData1[15]]));
                        } else if ($emapData1[3] == 2) {
                            $answer = implode(',', array_filter([$emapData1[11], $emapData1[12]]));
                        }
                        $count1++;
                        if ($count1 > 1) {
                            if (count($emapData1) > 2) {
                                $frm_data = array(
                                    'category' => $emapData1[0],
                                    'subcategory' => $emapData1[1],
                                    'language_id' => $emapData1[2],
                                    'image' => '',
                                    'question' => $emapData1[4],
                                    'question_type' => $emapData1[3],
                                    'optiona' => $emapData1[5],
                                    'optionb' => $emapData1[6],
                                    'optionc' => $emapData1[7],
                                    'optiond' => $emapData1[8],
                                    'optione' => $emapData1[9],
                                    'answer_type' => $emapData1[10],
                                    'answer' => $answer,
                                    'level' => $emapData1[16],
                                    'note' => $emapData1[17]
                                );
                                $this->db->insert('tbl_multi_match', $frm_data);
                            }
                        }
                    }
                }
                fclose($file);
                return ['error' => $error, 'error_code' => 1];
            } else {
                return ['error' => $error, 'error_code' => 2];
            }
        } else {
            return ['error' => $error, 'error_code' => 0];
        }
    }

    public function delete_question_report($id)
    {
        $this->db->where('id', $id)->delete('tbl_multi_match_question_reports');
    }

    public function add_data()
    {
        if (!is_dir(MULTIMATCH_QUESTION_IMG_PATH)) {
            mkdir(MULTIMATCH_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
        $question = $this->input->post('question');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question_type = $this->input->post('question_type');
        $answer_type = $this->input->post('answer_type') ?? 1;
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $level = $this->input->post('level');
        $answer = $this->input->post('answer');
        $note = $this->input->post('note');
        $answer = '';
        if ($answer_type == 2) {
            $answer = ($this->input->post('text_answer')) ? $this->input->post('text_answer') : '';
        } else {
            $answer = ($this->input->post('answer')) ? implode(',', $this->input->post('answer')) : '';
        }

        $frm_data = array(
            'category' => $category,
            'subcategory' => $subcategory,
            'language_id' => $language,
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer_type' => $answer_type,
            'answer' => $answer,
            'level' => $level,
            'note' => $note,
            'image' => ''
        );
        if ($_FILES['file']['name'] != '') {
            $config['upload_path'] = MULTIMATCH_QUESTION_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return FALSE;
            } else {
                $data = $this->upload->data();
                $img = $data['file_name'];
                $frm_data['image'] = $img;
            }
        }
        $this->db->insert('tbl_multi_match', $frm_data);
        return TRUE;
    }

    public function update_data()
    {
        if (!is_dir(MULTIMATCH_QUESTION_IMG_PATH)) {
            mkdir(MULTIMATCH_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_multi_match', $data);
        }

        $question = $this->input->post('question');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question_type = $this->input->post('question_type');
        $answer_type = $this->input->post('answer_type') ?? 1;
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $level = $this->input->post('level');


        $answer = '';
        if ($answer_type == 2) {
            $answer = ($this->input->post('text_answer')) ? $this->input->post('text_answer') : '';
        } else {
            $answer = ($this->input->post('answer')) ? implode(',', $this->input->post('answer')) : '';
        }

        $note = $this->input->post('note');

        $frm_data = array(
            'category' => $category,
            'subcategory' => $subcategory,
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer' => $answer,
            'answer_type' => $answer_type,
            'level' => $level,
            'note' => $note
        );
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $config['upload_path'] = MULTIMATCH_QUESTION_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return FALSE;
            } else {
                $image_url = $this->input->post('image_url');
                if (file_exists($image_url)) {
                    unlink($image_url);
                }

                $data = $this->upload->data();
                $frm_data['image'] = $data['file_name'];
            }
        }

        $this->db->where('id', $id)->update('tbl_multi_match', $frm_data);
        return TRUE;
    }

    public function delete_data($id, $image_url)
    {
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_multi_match');
        //remove report question
        $this->db->where('question_id', $id)->delete('tbl_multi_match_question_reports');
    }
}
