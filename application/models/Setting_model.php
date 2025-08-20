<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{

    public function get_quiz_list()
    {
        return $this->db->order_by('id', 'ASC')->get('tbl_quiz_list')->result();
    }


    public function firebase_configurations()
    {
        $config['upload_path'] = 'assets';
        $config['allowed_types'] = 'json';
        $config['file_name'] = 'firebase_config';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $old_file = 'assets/firebase_config.json';
        if (file_exists($old_file)) {
            unlink($old_file);
        }

        if (!$this->upload->do_upload('file')) {
            return FALSE;
        } else {
            $data = $this->upload->data();
            return TRUE;
        }
    }


    public function update_system_utility()
    {
        $settings = [
            'maximum_winning_coins',
            'minimum_coins_winning_percentage',
            'quiz_winning_percentage',
            'score',
            'answer_mode',
            'welcome_bonus_coin',
            'review_answers_deduct_coin',
            'question_shuffle_mode',
            'option_shuffle_mode',
            'quiz_zone_mode',
            'quiz_zone_fix_level_question',
            'quiz_zone_total_level_question',
            'quiz_zone_duration',
            'quiz_zone_lifeline_deduct_coin',
            'quiz_zone_wrong_answer_deduct_score',
            'quiz_zone_correct_answer_credit_score',
            'guess_the_word_question',
            'guess_the_word_fix_question',
            'guess_the_word_total_question',
            'guess_the_word_seconds',
            'guess_the_word_max_hints',
            'guess_the_word_max_winning_coin',
            'guess_the_word_wrong_answer_deduct_score',
            'guess_the_word_correct_answer_credit_score',
            'guess_the_word_hint_deduct_coin',
            'audio_mode_question',
            'audio_quiz_fix_question',
            'audio_quiz_total_question',
            'total_audio_time',
            'audio_quiz_seconds',
            'audio_quiz_wrong_answer_deduct_score',
            'audio_quiz_correct_answer_credit_score',
            'maths_quiz_mode',
            'maths_quiz_fix_question',
            'maths_quiz_total_question',
            'maths_quiz_seconds',
            'maths_quiz_wrong_answer_deduct_score',
            'maths_quiz_correct_answer_credit_score',
            'fun_n_learn_question',
            'fun_n_learn_quiz_fix_question',
            'fun_n_learn_quiz_total_question',
            'fun_and_learn_time_in_seconds',
            'fun_n_learn_quiz_wrong_answer_deduct_score',
            'fun_n_learn_quiz_correct_answer_credit_score',
            'true_false_mode',
            'true_false_quiz_fix_question',
            'true_false_quiz_total_question',
            'true_false_quiz_in_seconds',
            'true_false_quiz_wrong_answer_deduct_score',
            'true_false_quiz_correct_answer_credit_score',
            'battle_mode_one',
            'battle_mode_one_category',
            'battle_mode_one_fix_question',
            'battle_mode_one_total_question',
            'battle_mode_one_in_seconds',
            'battle_mode_one_correct_answer_credit_score',
            'battle_mode_one_quickest_correct_answer_extra_score',
            'battle_mode_one_second_quickest_correct_answer_extra_score',
            'battle_mode_one_code_char',
            'battle_mode_one_entry_coin',
            'battle_mode_group',
            'battle_mode_group_category',
            'battle_mode_group_fix_question',
            'battle_mode_group_total_question',
            'battle_mode_group_in_seconds',
            'battle_mode_group_wrong_answer_deduct_score',
            'battle_mode_group_correct_answer_credit_score',
            'battle_mode_group_quickest_correct_answer_extra_score',
            'battle_mode_group_second_quickest_correct_answer_extra_score',
            'battle_mode_group_code_char',
            'battle_mode_group_entry_coin',
            'battle_mode_random',
            'battle_mode_random_category',
            'battle_mode_random_fix_question',
            'battle_mode_random_total_question',
            'battle_mode_random_in_seconds',
            'battle_mode_random_correct_answer_credit_score',
            'battle_mode_random_quickest_correct_answer_extra_score',
            'battle_mode_random_second_quickest_correct_answer_extra_score',
            'battle_mode_random_search_duration',
            'battle_mode_random_entry_coin',
            'self_challenge_mode',
            'self_challenge_max_minutes',
            'self_challenge_max_questions',
            'exam_module',
            'exam_module_resume_exam_timeout',
            'contest_mode',
            'contest_mode_wrong_deduct_score',
            'contest_mode_correct_credit_score',
            'multi_match_mode',
            'multi_match_fix_level_question',
            'multi_match_total_level_question',
            'multi_match_duration',
            'multi_match_wrong_answer_deduct_score',
            'multi_match_correct_answer_credit_score',
        ];


        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_settings')->row_array();
            if ($res) {
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_settings', $data);
            } else {
                $data = array(
                    'type' => $type,
                    'message' => $message
                );
                $this->db->insert('tbl_settings', $data);
            }
        }
    }

    public function update_settings()
    {

        $settings = [
            'system_timezone',
            'system_timezone_gmt',
            'app_link',
            'more_apps',
            'ios_app_link',
            'ios_more_apps',
            'refer_coin',
            'earn_coin',
            'app_version',
            'app_version_ios',
            'force_update',
            'true_value',
            'false_value',
            'shareapp_text',
            'app_maintenance',
            'language_mode',
            'option_e_mode',
            'daily_quiz_mode',
            'latex_mode',
            'exam_latex_mode'
        ];

        if (isset($type['coins'])) {
            $settings[] = 'coins';
        }

        if (isset($type['score'])) {
            $settings[] = 'score';
        }

        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_settings')->row_array();
            if ($res) {
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_settings', $data);
            } else {
                $data = array(
                    'type' => $type,
                    'message' => $message
                );
                $this->db->insert('tbl_settings', $data);
            }

            if ($type == 'latex_mode' && $res['message'] != 0 && $message == 0) {
                $this->remove_html_tags_from_questions();
            }

            if ($type == 'exam_latex_mode' && $res['message'] != 0 && $message == 0) {
                $this->remove_html_tags_from_exam_questions();
            }
        }
    }

    // Method to get all questions
    public function get_all_questions()
    {
        $query = $this->db->get('tbl_question');
        return $query->result_array();
    }

    // Method to update a question by id
    public function update_question($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_question', $data);
    }

    function remove_html_tags_from_questions()
    {
        $questions = $this->get_all_questions();
        foreach ($questions as $question) {
            $stripped_question = strip_tags($question['question']);
            $stripped_optiona = strip_tags($question['optiona']);
            $stripped_optionb = strip_tags($question['optionb']);
            $stripped_optionc = strip_tags($question['optionc']);
            $stripped_optiond = strip_tags($question['optiond']);
            $stripped_optione = strip_tags($question['optione']);
            $stripped_optionnote = strip_tags($question['note']);

            $update_data = [
                'question' => $stripped_question,
                'optiona' => $stripped_optiona,
                'optionb' => $stripped_optionb,
                'optionc' => $stripped_optionc,
                'optiond' => $stripped_optiond,
                'optione' => $stripped_optione,
                'note' => $stripped_optionnote
            ];
            $this->update_question($question['id'], $update_data);
        }
    }


    // Method to get all exam questions
    public function get_all_exam_questions()
    {
        $query = $this->db->get('tbl_exam_module_question');
        return $query->result_array();
    }

    // Method to update a exam question by id
    public function update_exam_question($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_exam_module_question', $data);
    }

    function remove_html_tags_from_exam_questions()
    {
        $questions = $this->get_all_exam_questions();
        foreach ($questions as $question) {
            $stripped_question = strip_tags($question['question']);
            $stripped_optiona = strip_tags($question['optiona']);
            $stripped_optionb = strip_tags($question['optionb']);
            $stripped_optionc = strip_tags($question['optionc']);
            $stripped_optiond = strip_tags($question['optiond']);
            $stripped_optione = strip_tags($question['optione']);

            $update_data = [
                'question' => $stripped_question,
                'optiona' => $stripped_optiona,
                'optionb' => $stripped_optionb,
                'optionc' => $stripped_optionc,
                'optiond' => $stripped_optiond,
                'optione' => $stripped_optione,
            ];
            $this->update_exam_question($question['id'], $update_data);
        }
    }

    public function update_ads()
    {
        $settings = [
            'in_app_ads_mode',
            'ads_type',
            'android_banner_id',
            'android_interstitial_id',
            'android_rewarded_id',
            'ios_banner_id',
            'ios_interstitial_id',
            'ios_rewarded_id',
            'android_game_id',
            'ios_game_id',
            'daily_ads_visibility',
            'daily_ads_coins',
            'daily_ads_counter',
            'reward_coin'
        ];

        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_settings')->row_array();
            if ($res) {
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_settings', $data);
            } else {
                $data = array(
                    'type' => $type,
                    'message' => $message
                );
                $this->db->insert('tbl_settings', $data);
            }
        }
    }

    public function update_profile()
    {

        $app_name = $this->input->post('app_name');
        $name = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();
        if ($name) {
            $frm_name = ['message' => $app_name];
            $this->db->where('type', 'app_name')->update('tbl_settings', $frm_name);
        } else {
            $frm_name = array(
                'type' => 'app_name',
                'message' => $app_name
            );
            $this->db->insert('tbl_settings', $frm_name);
        }

        $jwt_key = $this->input->post('jwt_key');
        $j_key = $this->db->where('type', 'jwt_key')->get('tbl_settings')->row_array();
        if ($j_key) {
            $frm_jwt_key = ['message' => $jwt_key];
            $this->db->where('type', 'jwt_key')->update('tbl_settings', $frm_jwt_key);
        } else {
            $frm_jwt_key = array(
                'type' => 'jwt_key',
                'message' => $jwt_key
            );
            $this->db->insert('tbl_settings', $frm_jwt_key);
        }

        $footer_copyrights_text = $this->input->post('footer_copyrights_text');
        $footer_text = $this->db->where('type', 'footer_copyrights_text')->get('tbl_settings')->row_array();
        if ($footer_text) {
            $footer_text_change = ['message' => $footer_copyrights_text];
            $this->db->where('type', 'footer_copyrights_text')->update('tbl_settings', $footer_text_change);
        } else {
            $footer_text_change = array(
                'type' => 'footer_copyrights_text',
                'message' => $footer_copyrights_text
            );
            $this->db->insert('tbl_settings', $footer_text_change);
        }

        $theme_color = $this->input->post('theme_color');
        $theme_color_db = $this->db->where('type', 'theme_color')->get('tbl_settings')->row_array();
        if ($theme_color_db) {
            $theme_color_change = ['message' => $theme_color];
            $this->db->where('type', 'theme_color')->update('tbl_settings', $theme_color_change);
        } else {
            $theme_color_change = array(
                'type' => 'theme_color',
                'message' => $theme_color
            );
            $this->db->insert('tbl_settings', $theme_color_change);
        }

        $navbar_color = $this->input->post('navbar_color');
        if ($navbar_color) {
            $navbar_color_db = $this->db->where('type', 'navbar_color')->get('tbl_settings')->row_array();
            if ($navbar_color_db) {
                $navbar_color_change = ['message' => $navbar_color];
                $this->db->where('type', 'navbar_color')->update('tbl_settings', $navbar_color_change);
            } else {
                $navbar_color_change = array(
                    'type' => 'navbar_color',
                    'message' => $navbar_color
                );
                $this->db->insert('tbl_settings', $navbar_color_change);
            }
        }

        $navbar_text_color = $this->input->post('navbar_text_color');
        if ($navbar_text_color) {
            $navbar_text_color_db = $this->db->where('type', 'navbar_text_color')->get('tbl_settings')->row_array();
            if ($navbar_text_color_db) {
                $navbar_text_color_change = ['message' => $navbar_text_color];
                $this->db->where('type', 'navbar_text_color')->update('tbl_settings', $navbar_text_color_change);
            } else {
                $navbar_text_color_change = array(
                    'type' => 'navbar_text_color',
                    'message' => $navbar_text_color
                );
                $this->db->insert('tbl_settings', $navbar_text_color_change);
            }
        }


        $full_url = $this->input->post('full_url');
        $half_url = $this->input->post('half_url');
        $background_file_url = $this->input->post('background_file_url');
        $bot_file_url = $this->input->post('bot_file_url');

        if ($_FILES['full_file']['name'] != '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = microtime(true) * 10000;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('full_file')) {
                return FALSE;
            } else {
                if (file_exists($full_url)) {
                    unlink($full_url);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'full_logo')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'full_logo',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                // return TRUE;
            }
        }

        if ($_FILES['half_file']['name'] != '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = microtime(true) * 10000;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('half_file')) {
                return FALSE;
            } else {
                if (file_exists($half_url)) {
                    unlink($half_url);
                }
                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'half_logo')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'half_logo',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                // return TRUE;
            }
        }


        if ($_FILES['background_file']['name'] != '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = microtime(true) * 10000;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('background_file')) {
                return FALSE;
            } else {
                if (file_exists($background_file_url)) {
                    unlink($background_file_url);
                }
                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'background_file')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'background_file')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'background_file',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                // return TRUE;
            }
        }

        if ($_FILES['bot_image']['name'] != '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = microtime(true) * 10000;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bot_image')) {
                return FALSE;
            } else {
                if (file_exists($bot_file_url)) {
                    unlink($bot_file_url);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'bot_image')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'bot_image')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'bot_image',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                // return TRUE;
            }
        }

        return TRUE;
    }

    public function delete_multiple($ids, $is_image, $table)
    {
        if ($is_image) {
            $path = array(
                'tbl_category' => CATEGORY_IMG_PATH,
                'tbl_subcategory' => SUBCATEGORY_IMG_PATH,
                'tbl_question' => QUESTION_IMG_PATH,
                'tbl_notifications' => NOTIFICATION_IMG_PATH,
                'tbl_contest' => CONTEST_IMG_PATH,
                'tbl_contest_question' => CONTEST_QUESTION_IMG_PATH,
                'tbl_audio_question' => QUESTION_AUDIO_PATH,
                'tbl_exam_module_question' => EXAM_QUESTION_IMG_PATH,
                'tbl_maths_question' => MATHS_QUESTION_IMG_PATH,
                'tbl_slider' => SLIDER_IMG_PATH,
                'tbl_coin_store' => COIN_STORE_IMG_PATH,
                'tbl_fun_n_learn' => FUN_LEARN_IMG_PATH,
                'tbl_fun_n_learn_question' => FUN_LEARN_QUESTION_IMG_PATH,
                'tbl_multi_match' => MULTIMATCH_QUESTION_IMG_PATH,
                'tbl_guess_the_word' => GUESS_WORD_IMG_PATH,
            );
            if ($table == 'tbl_audio_question') {
                $query = $this->db->query("SELECT `audio` FROM " . $table . " WHERE id in ( " . $ids . " )");
                $res = $query->result();
                foreach ($res as $audio) {
                    if (!empty($audio->audio) && file_exists($path[$table] . $audio->audio)) {
                        unlink($path[$table] . $audio->audio);
                    }
                }
            } else if ($table == 'tbl_fun_n_learn') {
                $query = $this->db->query("SELECT id,content_data FROM " . $table . " WHERE id in ( " . $ids . " )");
                $res = $query->result();
                foreach ($res as $contentData) {
                    if (!empty($contentData->content_data) && file_exists($path[$table] . $contentData->content_data)) {
                        unlink($path[$table] . $contentData->content_data);
                    }
                    $id = $contentData->id;
                    $question_data = $this->db->select('image')->where('fun_n_learn_id', $id)->get('tbl_fun_n_learn_question')->result_array();
                    foreach ($question_data as $que1) {
                        if (!empty($que1->image) && file_exists(FUN_LEARN_QUESTION_IMG_PATH . $que1->image)) {
                            unlink(FUN_LEARN_QUESTION_IMG_PATH . $que1->image);
                        }
                    }
                    $this->db->where('fun_n_learn_id', $id)->delete('tbl_fun_n_learn_question');
                }
            } else {
                $query = $this->db->query("SELECT `image` FROM " . $table . " WHERE id in ( " . $ids . " )");
                $res = $query->result();
                foreach ($res as $image) {
                    if (!empty($image->image) && file_exists($path[$table] . $image->image)) {
                        unlink($path[$table] . $image->image);
                    }
                }
            }
        }
        $delete = $this->db->query("DELETE FROM `" . $table . "` WHERE `id` in ( " . $ids . " ) ");
        return $delete ? 1 : 0;
    }

    public function update_contact_us()
    {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'contact_us')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'contact_us')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'contact_us',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_terms_conditions()
    {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'terms_conditions')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'terms_conditions')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'terms_conditions',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_privacy_policy()
    {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'privacy_policy')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'privacy_policy')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'privacy_policy',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_instructions()
    {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'instructions')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'instructions')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'instructions',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_about_us()
    {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'about_us')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'about_us')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'about_us',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_web_settings()
    {
        if (!is_dir(WEB_SETTINGS_LOGO_PATH)) {
            mkdir(WEB_SETTINGS_LOGO_PATH, 0777, TRUE);
        }
        $settings = [
            'firebase_api_key',
            'firebase_auth_domain',
            'firebase_database_url',
            'firebase_project_id',
            'firebase_storage_bucket',
            'firebase_messager_sender_id',
            'firebase_app_id',
            'firebase_measurement_id',
            'company_name_footer',
            'email_footer',
            'phone_number_footer',
            'web_link_footer',
            'company_text',
            'address_text',
            'header_logo',
            'footer_logo',
            'sticky_header_logo',
            'quiz_zone_icon',
            'daily_quiz_icon',
            'true_false_icon',
            'fun_learn_icon',
            'self_challange_icon',
            'contest_play_icon',
            'one_one_battle_icon',
            'group_battle_icon',
            'audio_question_icon',
            'math_mania_icon',
            'exam_icon',
            'guess_the_word_icon',
            'primary_color',
            'footer_color',
            'social_media',
            'multi_match_icon'
        ];

        foreach ($settings as $type) {
            // get post data 
            $message = $this->input->post($type);
            // Check that data exists or not 
            $res = $this->db->where('type', $type)->get('tbl_web_settings')->row_array();
            if ($res) {
                // if type is social media then 
                if ($type == "social_media" && isset($_FILES[$type]) && !empty($_FILES[$type])) {
                    // initialize the empty arrays
                    $socialMediaArray = [];
                    $storedIcons = [];
                    $excludeIcons = [];

                    // get data of social media in array format by decoding json
                    $socialMediaData = json_decode($res['message'], true);

                    // Loop on social media data to get the icon's values
                    foreach ($socialMediaData as $data) {
                        $storedIcons[] = $data['icon'];
                    }

                    // check that if social media data is passed or not from the form
                    if (!empty($this->input->post($type))) {
                        // if there is data then loop on the data passed
                        foreach ($this->input->post($type) as $key => $value) {
                            // Check that Icon is uploaded or not 
                            if (!empty($_FILES[$type]['name'][$key]['file'])) {
                                // If uploaded then create array of $_FILES to upload new icon
                                $_FILES['file']['name'] = $_FILES[$type]['name'][$key]['file'];
                                $_FILES['file']['type'] = $_FILES[$type]['type'][$key]['file'];
                                $_FILES['file']['tmp_name'] = $_FILES[$type]['tmp_name'][$key]['file'];
                                $_FILES['file']['error'] = $_FILES[$type]['error'][$key]['file'];
                                $_FILES['file']['size'] = $_FILES[$type]['size'][$key]['file'];

                                $config['upload_path'] = WEB_SETTINGS_LOGO_PATH;
                                $config['allowed_types'] = WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES;
                                $config['file_name'] = $type . '-' . time();

                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);

                                if (!$this->upload->do_upload('file')) {
                                    return FALSE;
                                } else {
                                    $data = $this->upload->data();

                                    // Store the type and new name file of icon in socialMediaArray
                                    $socialMediaArray[] = [
                                        'link' => $this->input->post($type)[$key]['link'],
                                        'icon' => $data['file_name']
                                    ];
                                }
                            } else {
                                // IF new icon is not uploaded then get the data from the post and add in socialMediaArray
                                $socialMediaArray[] = [
                                    'link' => $this->input->post($type)[$key]['link'],
                                    'icon' => $this->input->post($type)[$key]['icon']
                                ];

                                // Add Existed Old Icon to $excludeIcons Array to avid remove the file from the path
                                $excludeIcons[] = $this->input->post($type)[$key]['icon'];
                            }
                        }
                    }
                    // Remove the excluded icons from stored icons array to get remaining icons to be removed from path
                    $remainingIcons = array_diff($storedIcons, $excludeIcons);

                    // loop on the remaining icons and remove from the path
                    if (!empty($remainingIcons)) {
                        foreach ($remainingIcons as $icon) {
                            $icon_path = WEB_SETTINGS_LOGO_PATH . $icon;

                            if (file_exists($icon_path)) {
                                unlink($icon_path);
                            }
                        }
                    }

                    // Make an array of Data with type and message json encoded
                    $data = array(
                        'type' => 'social_media',
                        'message' => json_encode($socialMediaArray ?? array())
                    );
                } else {
                    // declaring the variable for skipping the itration
                    $skip_update = false;
                    //if file uploaded
                    if (isset($_FILES[$type]) && !empty($_FILES[$type]['name'])) {
                        $config['upload_path'] = WEB_SETTINGS_LOGO_PATH;
                        $config['allowed_types'] = WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES;
                        $config['file_name'] = $type . '-' . time();
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload($type)) {
                            return FALSE;
                        } else {
                            // deletes old file
                            if (isset($res['message']) && $res['message'] != '') {
                                $old_file_path = WEB_SETTINGS_LOGO_PATH . $res['message'];
                                if (file_exists($old_file_path)) {
                                    unlink($old_file_path);
                                }
                            }
                            $data = $this->upload->data();
                            $message = $data['file_name'];
                        }
                    } else {
                        // array of all logos
                        $logos = ['favicon', 'header_logo', 'footer_logo', 'sticky_header_logo', 'quiz_zone_icon', 'daily_quiz_icon', 'true_false_icon', 'fun_learn_icon', 'self_challange_icon', 'contest_play_icon', 'one_one_battle_icon', 'group_battle_icon', 'audio_question_icon', 'math_mania_icon', 'exam_icon', 'guess_the_word_icon', 'multi_match_icon'];
                        // checks wheather type of loop is match with value of logos array
                        foreach ($logos as $value) {
                            if ($type == $value) {
                                // make skip_update variable true to skip the iteration
                                $skip_update = true;
                                break;
                            }
                        }
                        //if the skip_update variable true skip the foreach iteration and stops the value to be updated in database
                        if ($skip_update) {
                            continue;
                        }
                    }
                    $data = ['message' => trim($message)];
                }
                $this->db->where('type', $type)->update('tbl_web_settings', $data);
            } else {
                if ($type == "social_media" && isset($_FILES[$type]) && !empty($_FILES[$type])) {
                    // initialize the empty arrays
                    $socialMediaArray = [];
                    // if there is data then loop on the data passed
                    foreach ($_FILES[$type]['name'] as $key => $value) {
                        // Check that Icon is uploaded or not 
                        if (!empty($_FILES[$type]['name'][$key]['file'])) {
                            // If uploaded then create array of $_FILES to upload new icon
                            $_FILES['file']['name'] = $_FILES[$type]['name'][$key]['file'];
                            $_FILES['file']['type'] = $_FILES[$type]['type'][$key]['file'];
                            $_FILES['file']['tmp_name'] = $_FILES[$type]['tmp_name'][$key]['file'];
                            $_FILES['file']['error'] = $_FILES[$type]['error'][$key]['file'];
                            $_FILES['file']['size'] = $_FILES[$type]['size'][$key]['file'];

                            $config['upload_path'] = WEB_SETTINGS_LOGO_PATH;
                            $config['allowed_types'] = WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES;
                            $config['file_name'] = $type . '-' . time();

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('file')) {
                                return FALSE;
                            } else {
                                $data = $this->upload->data();

                                // Store the type and new name file of icon in socialMediaArray
                                $socialMediaArray[] = [
                                    'link' => $this->input->post($type)[$key]['link'],
                                    'icon' => $data['file_name']
                                ];
                            }
                        } else {
                            // IF new icon is not uploaded then get the data from the post and add in socialMediaArray
                            $socialMediaArray[] = [
                                'link' => $this->input->post($type)[$key]['link'],
                                'icon' => ""
                            ];
                        }
                    }

                    // Make an array of Data with type and message json encoded
                    $data = array(
                        'type' => 'social_media',
                        'message' => json_encode($socialMediaArray ?? array())
                    );
                } else {
                    if (isset($_FILES[$type]) && $_FILES[$type]['name'] != '') {
                        $config['upload_path'] = WEB_SETTINGS_LOGO_PATH;
                        $config['allowed_types'] = WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES;
                        $config['file_name'] = $type . '-' . time();
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload($type)) {
                            return FALSE;
                        } else {
                            $data = $this->upload->data();
                            $message = $data['file_name'];
                        }
                    }
                    $data = ['message' => trim($message), 'type' => $type];
                }

                $this->db->insert('tbl_web_settings', $data);
            }
        }
    }


    public function update_web_home_settings()
    {
        if (!is_dir(WEB_HOME_SETTINGS_LOGO_PATH)) {
            mkdir(WEB_HOME_SETTINGS_LOGO_PATH, 0777, TRUE);
        }
        $settings = [
            'section_1_mode',
            'section1_heading',
            'section1_title1',
            'section1_title2',
            'section1_title3',
            'section1_image1',
            'section1_image2',
            'section1_image3',
            'section1_desc1',
            'section1_desc2',
            'section1_desc3',
            'section_2_mode',
            'section2_heading',
            'section2_title1',
            'section2_title2',
            'section2_title3',
            'section2_title4',
            'section2_desc1',
            'section2_desc2',
            'section2_desc3',
            'section2_desc4',
            'section2_image1',
            'section2_image2',
            'section2_image3',
            'section2_image4',
            'section_3_mode',
            'section3_heading',
            'section3_title1',
            'section3_title2',
            'section3_title3',
            'section3_title4',
            'section3_image1',
            'section3_image2',
            'section3_image3',
            'section3_image4',
            'section3_desc1',
            'section3_desc2',
            'section3_desc3',
            'section3_desc4'
        ];

        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $language_id = $this->input->post('language_id') ? $this->input->post('language_id') : 14;
            $res = $this->db->where('language_id', $language_id)->where('type', $type)->get('tbl_web_settings')->row_array();
            if ($res) {
                // declaring the variable for skipping the itration
                $skip_update = false;
                //if file uploaded
                if (isset($_FILES[$type]) && !empty($_FILES[$type]['name'])) {
                    $config['upload_path'] = WEB_HOME_SETTINGS_LOGO_PATH;
                    $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
                    $config['file_name'] = $type . '-' . time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($type)) {
                        return FALSE;
                    } else {
                        // deletes old file
                        if (isset($res['message']) && $res['message'] != '') {
                            $old_file_path = WEB_HOME_SETTINGS_LOGO_PATH . $res['message'];
                            if (file_exists($old_file_path)) {
                                unlink($old_file_path);
                            }
                        }
                        $data = $this->upload->data();
                        $message = $data['file_name'];
                    }
                } else {
                    // array of all images
                    $images = ['section1_image1', 'section1_image2', 'section1_image3', 'section2_image1', 'section2_image2', 'section2_image3', 'section2_image4', 'section3_image1', 'section3_image2', 'section3_image3', 'section3_image4'];
                    // checks wheather type of loop is match with value of images array
                    foreach ($images as $value) {
                        if ($type == $value) {
                            // make skip_update variable true to skip the iteration
                            $skip_update = true;
                            break;
                        }
                    }
                    //if the skip_update variable true skip the foreach iteration and stops the value to be updated in database
                    if ($skip_update) {
                        continue;
                    }
                }
                $data = ['message' => $message];
                $this->db->where('type', $type)->where('language_id', $language_id)->update('tbl_web_settings', $data);
            } else {
                if (isset($_FILES[$type]) && !empty($_FILES[$type]['name'])) {
                    $config['upload_path'] = WEB_HOME_SETTINGS_LOGO_PATH;
                    $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
                    $config['file_name'] = $type . '-' . time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($type)) {
                        return FALSE;
                    } else {
                        $data = $this->upload->data();
                        $message = $data['file_name'];
                    }
                }
                $data = ['message' => $message, 'type' => $type, 'language_id' => $language_id];
                $this->db->insert('tbl_web_settings', $data);
            }
        }
    }

    public function update_in_app_settings()
    {

        $settings = [
            'in_app_purchase_mode',
            'app_package_name',
            'shared_secrets'
        ];

        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_settings')->row_array();
            if ($res) {
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_settings', $data);
            } else {
                $data = array(
                    'type' => $type,
                    'message' => $message
                );
                $this->db->insert('tbl_settings', $data);
            }
        }
    }

    public function removeImage($id, $image, $table)
    {
        if (!empty($image) && file_exists($image)) {
            unlink($image);
        }
        $data = ['image' => ''];
        $update = $this->db->where('id', $id)->update($table, $data);
        return $update ? 1 : 0;
    }

    public function auth_settings()
    {
        $settings = [
            'gmail_login',
            'email_login',
            'phone_login',
            'apple_login'
        ];

        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_settings')->row_array();
            if ($res) {
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_settings', $data);
            } else {
                $data = array(
                    'type' => $type,
                    'message' => $message
                );
                $this->db->insert('tbl_settings', $data);
            }
        }
    }
}
