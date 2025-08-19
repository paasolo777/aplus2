<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function firebase_configurations()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('read', 'firebase_configurations')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'firebase_configurations')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $data = $this->Setting_model->firebase_configurations();
                        if ($data == false) {
                            $this->session->set_flashdata('error', lang('only_json_file_allow'));
                        } else {
                            $this->session->set_flashdata('success', lang('configuration_updated_successfully'));
                        }
                    }
                    redirect('firebase-configurations');
                }

                $this->load->view('firebase_configurations');
            }
        }
    }

    public function system_utilities()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'system_configuration')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->Setting_model->update_system_utility();
                    $this->session->set_flashdata('success', lang('settings_updated_successfully'));
                }
                redirect('system-utilities');
            }

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
            foreach ($settings as $row) {
                $data = $this->db->where('type', $row)->get('tbl_settings')->row_array();
                $this->result[$row] = $data;
            }

            $this->load->view('system_utilities', $this->result);
        }
    }

    public function system_configurations()
    {

        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('read', 'system_configuration')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'system_configuration')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_settings();
                        $this->session->set_flashdata('success', lang('settings_updated_successfully'));
                    }
                    redirect('system-configurations');
                }

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
                foreach ($settings as $row) {
                    $data = $this->db->where('type', $row)->get('tbl_settings')->row_array();
                    $this->result[$row] = $data;
                }

                $this->load->view('system_configurations', $this->result);
            }
        }
    }

    public function ads_settings()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('read', 'ads_settings')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'ads_settings')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_ads();
                        $this->session->set_flashdata('success', lang('settings_updated_successfully'));
                    }
                    redirect('ads-settings');
                }

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
                foreach ($settings as $row) {
                    $data = $this->db->where('type', $row)->get('tbl_settings')->row_array();
                    $this->result[$row] = $data;
                }

                $this->load->view('ads_settings', $this->result);
            }
        }
    }


    public function profile()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'profile')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $data = $this->Setting_model->update_profile();
                        if ($data == false) {
                            $this->session->set_flashdata('error', lang(IMAGE_ALLOW_PNG_JPG_SVG_MSG));
                        } else {
                            $this->session->set_flashdata('success', lang('profile_updated_successfully'));
                        }
                    }
                    redirect('profile');
                }
                $this->result['jwt_key'] = $this->db->where('type', 'jwt_key')->get('tbl_settings')->row_array();
                $this->result['footer_copyrights_text'] = $this->db->where('type', 'footer_copyrights_text')->get('tbl_settings')->row_array();
                $this->load->view('profile', $this->result);
            }
        }
    }

    public function send_notifications()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('read', 'send_notification')) {
                redirect('/');
            } else {
                $pathToServiceAccountJsonFile = 'assets/firebase_config.json';
                if (!file_exists($pathToServiceAccountJsonFile)) {
                    redirect('firebase-configurations');
                }
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'send_notification')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $users = $this->input->post('users');
                        if ($users === 'selected') {
                            if ($this->input->post('selected_list') == '') {
                                $this->session->set_flashdata('error', lang('please_select_the_users_from_the_table'));
                            } else {
                                $this->Notification_model->add_notification();
                                $this->session->set_flashdata('success', lang('notification_sent_successfully'));
                            }
                        } else {
                            $this->Notification_model->add_notification();
                            $this->session->set_flashdata('success', lang('notification_sent_successfully'));
                        }
                    }
                    redirect('send-notifications');
                }
                $this->result['category'] = $this->Category_model->get_data(1);
                $this->load->view('notifications', $this->result);
            }
        }
    }

    public function delete_notification()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('delete', 'send_notification')) {
                echo false;
            } else {
                $id = $this->input->post('id');
                $image_url = $this->input->post('image_url');
                $this->Notification_model->delete_notification($id, $image_url);
                echo lang('notification_deleted_successfully');
            }
        }
    }

    public function play_store_contact_us()
    {
        $result['setting'] = $this->db->where('type', 'contact_us')->get('tbl_settings')->row_array();
        $this->load->view('play_store_contact_us', $result);
    }

    public function contact_us()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'contact_us')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_contact_us();
                        $this->session->set_flashdata('success', lang('contact_us_updated_successfully'));
                    }
                    redirect('contact-us');
                }
                $this->result['setting'] = $this->db->where('type', 'contact_us')->get('tbl_settings')->row_array();
                $this->load->view('contact_us', $this->result);
            }
        }
    }

    public function play_store_terms_conditions()
    {
        $result['setting'] = $this->db->where('type', 'terms_conditions')->get('tbl_settings')->row_array();
        $this->load->view('play_store_terms_conditions', $result);
    }

    public function terms_conditions()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'term_conditions')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_terms_conditions();
                        $this->session->set_flashdata('success', lang('terms_conditions_updated_successfully'));
                    }
                    redirect('terms-conditions');
                }
                $this->result['setting'] = $this->db->where('type', 'terms_conditions')->get('tbl_settings')->row_array();
                $this->load->view('terms_conditions', $this->result);
            }
        }
    }

    public function play_store_privacy_policy()
    {
        $result['setting'] = $this->db->where('type', 'privacy_policy')->get('tbl_settings')->row_array();
        $this->load->view('play_store_privacy_policy', $result);
    }

    public function privacy_policy()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'privacy_policy')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_privacy_policy();
                        $this->session->set_flashdata('success', lang('privacy_policy_updated_successfully'));
                    }
                    redirect('privacy-policy');
                }
                $this->result['setting'] = $this->db->where('type', 'privacy_policy')->get('tbl_settings')->row_array();
                $this->load->view('privacy_policy', $this->result);
            }
        }
    }

    public function instructions()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'how_to_play')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_instructions();
                        $this->session->set_flashdata('success', lang('instructions_updated_successfully'));
                    }
                    redirect('instructions');
                }
                $this->result['setting'] = $this->db->where('type', 'instructions')->get('tbl_settings')->row_array();
                $this->load->view('instructions', $this->result);
            }
        }
    }

    public function about_us()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'about_us')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_about_us();
                        $this->session->set_flashdata('success', lang('about_us_updated_successfully'));
                    }
                    redirect('about-us');
                }
                $this->result['setting'] = $this->db->where('type', 'about_us')->get('tbl_settings')->row_array();
                $this->load->view('about_us', $this->result);
            }
        }
    }

    public function upload_img()
    {
        $accepted_origins = array((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']);

        if (!is_dir(INSTRACTION_IMG_PATH)) {
            mkdir(INSTRACTION_IMG_PATH, 0777, true);
        }
        $imageFolder = INSTRACTION_IMG_PATH;

        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // Same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filename = $temp['name'];

            $filetype = $_POST['filetype']; // file type
            // Valid extension
            if ($filetype == 'image') {
                $valid_ext = array('png', 'jpeg', 'jpg');
            } else if ($filetype == 'media') {
                $valid_ext = array('mp4', 'mp3');
            }

            $location = $imageFolder . $temp['name'];   // Location

            $file_extension = pathinfo($location, PATHINFO_EXTENSION); // file extension
            $file_extension = strtolower($file_extension);

            $return_filename = "";

            // Check extension
            if (in_array($file_extension, $valid_ext)) {
                // Upload file
                if (move_uploaded_file($temp['tmp_name'], $location)) {
                    $return_filename = $filename;
                }
            }

            echo $return_filename;
        } else {
            header("HTTP/1.1 500 Server Error");  // Notify editor that the upload failed
        }
    }

    public function web_settings()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'web_settings')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_web_settings();
                        $this->session->set_flashdata('success',  lang('data_updated_successfully'));
                    }
                    redirect('web-settings');
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

                foreach ($settings as $row) {
                    $data = $this->db->where('type', $row)->get('tbl_web_settings')->row_array();
                    $this->result[$row] = $data;
                }
                $this->load->view('web_settings', $this->result);
            }
        }
    }

    public function web_home_settings()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'web_settings')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_web_home_settings();
                        $this->session->set_flashdata('success', lang('data_updated_successfully'));
                    }
                    redirect('web-home-settings');
                }
                $this->result['language'] = $this->Language_model->get_data();
                $this->load->view('web_home_settings', $this->result);
            }
        }
    }

    public function edit_web_home_settings($id)
    {
        if (!has_permissions('read', 'web_settings')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'web_settings')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->Setting_model->update_web_home_settings();
                    $this->session->set_flashdata('success', lang('data_updated_successfully'));
                }
                redirect('web-home-settings/' . $id);
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

            foreach ($settings as $row) {
                $data = $this->db->where('type', $row)->where('language_id', $id)->get('tbl_web_settings')->row_array();
                $this->result[$row] = $data;
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->result['edit_data'] = 1;
            $this->load->view('web_home_settings', $this->result);
        }
    }

    public function in_app_settings()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('read', 'in_app_settings')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'in_app_settings')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $this->Setting_model->update_in_app_settings();
                        $this->session->set_flashdata('success', lang('in_app_settings_update_successfully'));
                    }
                    redirect('in-app-settings');
                }

                $pathToServiceAccountJsonFile = 'assets/firebase_config.json';
                if (!file_exists($pathToServiceAccountJsonFile)) {
                    redirect('firebase-configurations');
                } else {
                    $get_file = file_get_contents($pathToServiceAccountJsonFile); //data read from json file
                    $fileData = ($get_file != '') ? json_decode($get_file) : '';
                    $clientEmail = ($fileData != '') ? $fileData->client_email ?? '' : '';
                    $applicationName = ($fileData != '') ? $fileData->project_id ?? '' : '';
                    $this->result['clientEmail'] = $clientEmail ?? '';
                    $this->result['is_validate'] = 0;

                    $settings = [
                        'in_app_purchase_mode',
                        'app_package_name',
                        'shared_secrets'
                    ];
                    foreach ($settings as $row) {
                        $data = $this->db->where('type', $row)->get('tbl_settings')->row_array();
                        $this->result[$row] = $data;
                    }

                    if ($applicationName != '') {
                        $this->result['is_validate'] = 1;
                    }
                    $this->load->view('in_app_settings', $this->result);
                }
            }
        }
    }

    public function in_app_users()
    {
        if (!has_permissions('read', 'in_app_users')) {
            redirect('/');
        } else {
            $this->load->view('in_app_users');
        }
    }

    public function auth_settings()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        } else {
            if (!has_permissions('read', 'authentication_settings')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'authentication_settings')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        $gmail = $this->input->post('gmail_login');
                        $email = $this->input->post('email_login');
                        $phone = $this->input->post('phone_login');
                        if (($gmail == 0 && $email == 0 && $phone == 0)) {
                            $this->session->set_flashdata('error', lang('any_one_authentication_method_have_to_enabled'));
                        } else {
                            $this->Setting_model->auth_settings();
                            $this->session->set_flashdata('success', lang('data_updated_successfully'));
                        }
                    }
                    redirect('authentication-settings');
                }

                $settings = [
                    'gmail_login',
                    'email_login',
                    'phone_login',
                    'apple_login'
                ];
                foreach ($settings as $row) {
                    $data = $this->db->where('type', $row)->get('tbl_settings')->row_array();
                    $this->result[$row] = $data;
                }

                $this->load->view('authentication_settings', $this->result);
            }
        }
    }
}
