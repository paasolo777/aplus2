<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fun_N_Learn_model extends CI_Model
{

    public function get_data()
    {
        return $this->db->order_by('id', 'DESC')->get('tbl_fun_n_learn')->result();
    }

    public function add_data()
    {
        $content_type = ($this->input->post('content_type')) ? $this->input->post('content_type') : 0;
        $frm_data = array(
            'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
            'category' => $this->input->post('category'),
            'subcategory' => ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0,
            'title' => $this->input->post('title'),
            'detail' => $this->input->post('detail'),
            'status' => 0,
            'content_type' => $content_type,
            'content_data' => '',
        );
        if ($content_type) {
            if ($content_type == 1) {
                $content_data = $this->input->post('content_data');
                $frm_data['content_type'] = 1;
                $frm_data['content_data'] = $content_data;
                if ($content_data == '') {
                    $frm_data['content_type'] = 0;
                }
            } else if ($content_type == 2) {
                if ($_FILES['file']['name'] != '') {
                    if (!is_dir(FUN_LEARN_IMG_PATH)) {
                        mkdir(FUN_LEARN_IMG_PATH, 0777, TRUE);
                    }
                    $config['upload_path'] = FUN_LEARN_IMG_PATH;
                    $config['allowed_types'] = FILE_ALLOWED_TYPES;
                    $config['file_name'] = time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('file')) {
                        return FALSE;
                    } else {
                        $data = $this->upload->data();
                        $img = $data['file_name'];
                        $frm_data['content_type'] = 2;
                        $frm_data['content_data'] = $img;
                    }
                }
            }
        }
        $this->db->insert('tbl_fun_n_learn', $frm_data);
    }

    public function update_data()
    {
        $id = $this->input->post('edit_id');
        $content_type = ($this->input->post('edit_content_type')) ? $this->input->post('edit_content_type') : 0;
        $frm_data = array(
            'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
            'category' => $this->input->post('category'),
            'subcategory' => ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0,
            'title' => $this->input->post('title'),
            'detail' => $this->input->post('detail'),
            'content_type' => $content_type,
        );
        if ($content_type) {
            $contest_data = $this->db->select('content_type,content_data')->where('id', $id)->get('tbl_fun_n_learn')->row_array();
            $file_url = ($contest_data['content_type'] == 2 && $contest_data['content_data'] != '') ? (FUN_LEARN_IMG_PATH . $contest_data['content_data']) : '';
            if ($content_type == 1) {
                if (!empty($file_url) && file_exists($file_url)) {
                    unlink($file_url);
                }
                $content_data = $this->input->post('content_data');
                $frm_data['content_type'] = 1;
                $frm_data['content_data'] = $content_data;
                if ($content_data == '') {
                    $frm_data['content_type'] = 0;
                }
            } else if ($content_type == 2 && $_FILES['file']['name'] != '') {
                if (!is_dir(FUN_LEARN_IMG_PATH)) {
                    mkdir(FUN_LEARN_IMG_PATH, 0777, TRUE);
                }
                $config['upload_path'] = FUN_LEARN_IMG_PATH;
                $config['allowed_types'] = FILE_ALLOWED_TYPES;
                $config['file_name'] = time();
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file')) {
                    return FALSE;
                } else {
                    if ($file_url && file_exists($file_url)) {
                        unlink($file_url);
                    }
                    $data = $this->upload->data();
                    $filedata = $data['file_name'];
                    $frm_data['content_type'] = 2;
                    $frm_data['content_data'] = $filedata;
                }
            } else {
                $frm_data['content_type'] = 0;
                $frm_data['content_data'] = '';
            }
        }
        $this->db->where('id', $id)->update('tbl_fun_n_learn', $frm_data);
    }

    public function delete_data($id)
    {
        $contes_data = $this->db->select('content_type,content_data')->where('id', $id)->get('tbl_fun_n_learn')->row_array();
        $file_url = ($contes_data['content_type'] == 2 && $contes_data['content_data'] != '') ? (FUN_LEARN_IMG_PATH . $contes_data['content_data']) : '';

        if (!empty($file_url) && file_exists($file_url)) {
            unlink($file_url);
        }

        $question_data = $this->db->select('image')->where('fun_n_learn_id', $id)->get('tbl_fun_n_learn_question')->result_array();
        foreach ($question_data as $que1) {
            if (!empty($que1->image) && file_exists(FUN_LEARN_QUESTION_IMG_PATH . $que1->image)) {
                unlink(FUN_LEARN_QUESTION_IMG_PATH . $que1->image);
            }
        }
        $this->db->where('fun_n_learn_id', $id)->delete('tbl_fun_n_learn_question');
        $this->db->where('id', $id)->delete('tbl_fun_n_learn');
    }

    public function update_fun_n_learn_status()
    {
        $id = $this->input->post('update_id');
        $data = array(
            'status' => $this->input->post('status')
        );
        $this->db->where('id', $id)->update('tbl_fun_n_learn', $data);
    }

    public function add_fun_n_learn_question()
    {
        $fun_n_learn_id = $this->input->post('fun_n_learn_id');
        $question = $this->input->post('question');
        $question_type = $this->input->post('question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');

        $frm_data = array(
            'fun_n_learn_id' => $fun_n_learn_id,
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer' => $answer,
            'image' => ''
        );
        if ($_FILES['file']['name'] != '') {
            if (!is_dir(FUN_LEARN_QUESTION_IMG_PATH)) {
                mkdir(FUN_LEARN_QUESTION_IMG_PATH, 0777, TRUE);
            }
            $config['upload_path'] = FUN_LEARN_QUESTION_IMG_PATH;
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
        $this->db->insert('tbl_fun_n_learn_question', $frm_data);
    }

    public function update_fun_n_learn_question()
    {
        $id = $this->input->post('edit_id');
        $question = $this->input->post('question');
        $question_type = $this->input->post('edit_question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');

        $frm_data = array(
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer' => $answer,
        );
        if ($_FILES['update_file']['name'] != '') {
            if (!is_dir(FUN_LEARN_QUESTION_IMG_PATH)) {
                mkdir(FUN_LEARN_QUESTION_IMG_PATH, 0777, TRUE);
            }
            $config['upload_path'] = FUN_LEARN_QUESTION_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('update_file')) {
                return FALSE;
            } else {
                $image_url = $this->input->post('image_url');
                if (file_exists($image_url)) {
                    unlink($image_url);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $frm_data['image'] = $img;
            }
        }
        $this->db->where('id', $id)->update('tbl_fun_n_learn_question', $frm_data);
    }

    public function delete_fun_n_learn_questions($id)
    {
        $question_data = $this->db->select('image')->where('id', $id)->get('tbl_fun_n_learn_question')->row_array();
        foreach ($question_data as $que1) {
            if (!empty($que1->image) && file_exists(FUN_LEARN_QUESTION_IMG_PATH . $que1->image)) {
                unlink(FUN_LEARN_QUESTION_IMG_PATH . $que1->image);
            }
        }
        $this->db->where('id', $id)->delete('tbl_fun_n_learn_question');
    }
}
