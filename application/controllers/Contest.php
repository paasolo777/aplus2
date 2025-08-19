<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

require FCPATH . 'vendor/autoload.php';

defined('BASEPATH') or exit('No direct script access allowed');

class Contest extends CI_Controller
{
    public $toDate;
    public $toDateTime;
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());
        $this->toDate = date('Y-m-d');
        $this->toDateTime = date('Y-m-d H:i:s');
    }

    public function contest_questions_import()
    {
        if ($this->input->post('btnadd')) {
            if (!has_permissions('update', 'import_contest_question')) {
                $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
            } else {
                $data = $this->Contest_model->import_data();
                if ($data['error_code'] == "1") {
                    $this->session->set_flashdata('success', lang('csv_file_successfully_imported'));
                } else if ($data['error_code'] == "0") {
                    if ($data['error'] != '') {
                        $this->session->set_flashdata('error', $data['error']);
                    } else {
                        $this->session->set_flashdata('error',  lang('please_upload_data_in_csv_file'));
                    }
                } else if ($data['error_code'] == "2") {
                    if ($data['error'] != '') {
                        $this->session->set_flashdata('error', $data['error']);
                    } else {
                        $this->session->set_flashdata('error', lang('please_fill_all_the_data_in_csv_file'));
                    }
                } else {
                    $this->session->set_flashdata('error', $data['error']);
                }
            }
            redirect('contest-questions-import');
        }
        $this->load->view('contest_questions_import');
    }

    public function contest_questions()
    {
        if (!has_permissions('read', 'manage_contest_question')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'manage_contest_question')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Contest_model->add_contest_question();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_created_successfully'));
                    }
                }
                redirect('contest-questions');
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'manage_contest_question')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Contest_model->update_contest_question();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('contest-questions');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->result['contest'] = $this->Contest_model->get_data();
            $this->load->view('contest_questions', $this->result);
        }
    }

    public function delete_contest_questions()
    {
        if (!has_permissions('delete', 'manage_contest_question')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Contest_model->delete_contest_questions($id, $image_url);
            echo TRUE;
        }
    }

    public function contest_prize_distribute($id)
    {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/');
        } else {
            $currentDate = $this->toDateTime;
            $res = $this->db->where('end_date <=', $currentDate)->where('id', $id)->limit(1)->get('tbl_contest')->result();
            if (!empty($res)) {
                foreach ($res as $contest) {
                    $prize_status = $contest->prize_status;
                    $contest_name = $contest->name;
                    if ($prize_status == 0) {
                        $contest_id = $contest->id;
                        $type = "wonContest";
                        $res1 = $this->db->where('contest_id', $contest_id)->order_by('top_winner', 'ASC')->get('tbl_contest_prize')->result();
                        if (!empty($res1)) {
                            for ($j = 0; $j < count($res1); $j++) {

                                $u_rank = $res1[$j]->top_winner;
                                $winner_points = $res1[$j]->points;

                                $query2 = $this->db->query("SELECT r.*, u.firebase_id, u.coins FROM (SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT user_id, score FROM tbl_contest_leaderboard c join tbl_users u on u.id = c.user_id WHERE contest_id='" . $contest_id . "' ) s, (SELECT @user_rank := 0) init ORDER BY score DESC ) r INNER join tbl_users u on u.id = r.user_id WHERE r.user_rank='" . $u_rank . "' ORDER BY r.user_rank ASC");
                                $res2 = $query2->result();

                                for ($i = 0; $i < count($res2); $i++) {
                                    $winner_userId = $res2[$i]->user_id;
                                    $frm_data = array(
                                        'user_id' => $res2[$i]->user_id,
                                        'uid' => $res2[$i]->firebase_id,
                                        'points' => $winner_points,
                                        'type' => $type,
                                        'status' => 0,
                                        'date' => $this->toDate
                                    );
                                    $this->db->insert('tbl_tracker', $frm_data);

                                    $coins = ($res2[$i]->coins + $winner_points);
                                    $frm_data1 = array('coins' => $coins);
                                    $this->db->where('id', $res2[$i]->user_id)->update('tbl_users', $frm_data1);
                                    if ($winner_userId) {
                                        $this->set_badges($winner_userId, 'most_wanted_winner');
                                    }
                                }
                            }
                            $frm_data2 = array('prize_status' => '1');
                            $this->db->where('id', $contest_id)->update('tbl_contest', $frm_data2);

                            $this->session->set_flashdata('success', lang('successfully_prize_distributed_for') . ' ' . $contest_name . '..!');
                        } else {
                            $this->session->set_flashdata('error', lang('prize_can_not_distributed_for') . ' ' . $contest_name . '..!');
                        }
                    } else {
                        $this->session->set_flashdata('error', lang('prize_already_distributed_for') . ' ' . $contest_name . '..!');
                    }
                }
            } else {
                $this->session->set_flashdata('error', lang('prize_distribution_is_currently_not_available_check_contest_end_date'));
            }
            redirect('contest');
        }
    }

    function set_badges($user_id, $type)
    {
        $res = $this->db->where('user_id', $user_id)->get('tbl_users_badges')->row_array();
        $counter_name = $type . '_counter';
        if (!empty($res)) {
            if ($res[$type] == 0 || $res[$type] == '0') {
                $res1 = $this->db->where('type', $type)->get('tbl_badges')->row_array();
                if (!empty($res1)) {
                    $counter = $res1['badge_counter'];
                    $user_conter = $res[$counter_name];
                    $user_conter = $user_conter + 1;
                    if ($user_conter < $counter) {
                        $data = [$counter_name => $user_conter];
                        $this->db->where('user_id', $user_id)->update('tbl_users_badges', $data);
                    } else if ($counter == $user_conter) {
                        $power_elite_counter = $res['power_elite_counter'] + 1;
                        $this->set_power_elite_badge($user_id, $power_elite_counter);
                        $data1 = [
                            $counter_name => $user_conter,
                            $type => 1,
                        ];
                        $this->db->where('user_id', $user_id)->update('tbl_users_badges', $data1);
                        $this->send_badges_notification($user_id, $type);
                    }
                }
            }
        }
    }

    function set_power_elite_badge($user_id, $counter)
    {
        $type = 'power_elite';
        $res = $this->db->where('user_id', $user_id)->get('tbl_users_badges')->row_array();
        $user_conter = $type . '_counter';
        if (!empty($res)) {
            if ($res[$type] == 0 || $res[$type] == '0') {
                $res1 = $this->db->where('type', $type)->get('tbl_badges')->row_array();
                if (!empty($res1)) {
                    $badge_counter = $res1['badge_counter'];
                    if ($counter < $badge_counter) {
                        $data = [$user_conter => $counter];
                        $this->db->where('user_id', $user_id)->update('tbl_users_badges', $data);
                    } else if ($counter == $badge_counter) {
                        $data1 = [
                            $type . '_counter' => $counter,
                            $type => 1,
                        ];
                        $this->db->where('user_id', $user_id)->update('tbl_users_badges', $data1);
                        $this->send_badges_notification($user_id, $type);
                    }
                }
            }
        }
    }

    function getBadgeNotificationData($language, $type, $path, $sampleFile, $defaultFile)
    {
        $file = $path . $language . '.json';

        if (!file_exists($file)) {
            $file = $path . $defaultFile;
            if (!file_exists($file)) {
                $file = $path . $sampleFile;
            }
        }

        $content = file_get_contents($file);
        $dataArray = json_decode($content, true);

        $badge_label = $type . '_label';
        $badge_note = $type . '_note';

        return [
            'notification_title' => $dataArray[$badge_label] ?? 'Congratulations!!',
            'notification_body' => $dataArray[$badge_note] ?? 'You have unlocked new badge.'
        ];
    }

    public function send_badges_notification($user_id, $type)
    {
        $res = $this->db->select('id,fcm_id,web_fcm_id,app_language,web_language')->where('id', $user_id)->get('tbl_users')->row_array();
        $fcm_id = $res['fcm_id'];
        $web_fcm_id = $res['web_fcm_id'];

        $user_app_language = $res['app_language'];

        $get_app_default_language = $this->db->select('id,name,app_default')->where('app_default', 1)->get('tbl_upload_languages')->row_array();
        $default_app_language = $get_app_default_language['name'];

        $notificationData = $this->getBadgeNotificationData($user_app_language, $type, APP_LANGUAGE_FILE_PATH, 'app_sample_file.json', $default_app_language);

        $notification_title_message = $notificationData['notification_title'] ?? 'Congratulations!!';
        $notification_body_message = $notificationData['notification_body'] ?? 'You have unlocked new badge.';
        $fcmMsg = array(
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'type' => 'badges',
            'badge_type' => $type,
            'title' => $notification_title_message,
            'body' => $notification_body_message,
        );

        if ($fcm_id && $fcm_id != '' && $fcm_id != 'empty') {
            $registrationID = explode(',', $fcm_id);
            $factory = (new Factory)->withServiceAccount('assets/firebase_config.json');
            $messaging = $factory->createMessaging();
            $message = CloudMessage::new();
            $message = $message->withNotification($fcmMsg)->withData($fcmMsg);
            $messaging->sendMulticast($message, $registrationID);
        }

        $user_web_language = $res['web_language'];

        $get_web_default_language = $this->db->select('id,name,web_default')->where('web_default', 1)->get('tbl_upload_languages')->row_array();
        $default_web_language = $get_web_default_language['name'];

        $web_notificationData = $this->getBadgeNotificationData($user_web_language, $type, WEB_LANGUAGE_FILE_PATH, 'web_sample_file.json', $default_web_language);

        $web_notification_title_message = $web_notificationData['notification_title'] ?? 'Congratulations!!';
        $web_notification_body_message = $web_notificationData['notification_body'] ?? 'You have unlocked new badge.';
        $web_fcmMsg = array(
            'click_action' => 'WEB_NOTIFICATION_CLICK',
            'type' => 'badges',
            'badge_type' => $type,
            'title' => $web_notification_title_message,
            'body' => $web_notification_body_message,
        );

        if ($web_fcm_id && $web_fcm_id != '' && $web_fcm_id != 'empty') {
            $registrationID = explode(',', $web_fcm_id);
            $factory = (new Factory)->withServiceAccount('assets/firebase_config.json');
            $messaging = $factory->createMessaging();
            $message = CloudMessage::new();
            $message = $message->withNotification($web_fcmMsg)->withData($web_fcmMsg);
            $messaging->sendMulticast($message, $registrationID);
        }
    }

    public function contest_leaderboard()
    {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/');
        } else {
            $this->load->view('contest_leaderboard');
        }
    }

    public function index()
    {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'manage_contest')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Contest_model->add_contest();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('contest_created_successfully'));
                    }
                }
                redirect('contest');
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'manage_contest')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Contest_model->update_contest();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success',  lang('contest_updated_successfully'));
                    }
                }
                redirect('contest');
            } else if ($this->input->post('btnupdatestatus')) {
                if (!has_permissions('update', 'manage_contest')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $contest_id = $this->input->post('update_id');
                    $res = $this->db->where('contest_id', $contest_id)->get('tbl_contest_question')->result();
                    if (empty($res)) {
                        $this->session->set_flashdata('error', lang('not_enought_question_for_active_contest'));
                    } else {
                        $this->Contest_model->update_contest_status();
                        $this->session->set_flashdata('success', lang('contest_updated_successfully'));
                    }
                }
                redirect('contest');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->load->view('contest', $this->result);
        }
    }

    public function delete_contest()
    {
        if (!has_permissions('delete', 'manage_contest')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Contest_model->delete_contest($id, $image_url);
            echo TRUE;
        }
    }

    public function contest_prize($id)
    {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'manage_contest')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->Contest_model->add_contest_prize();
                    $this->session->set_flashdata('success', lang('prize_created_successfully'));
                }
                redirect('contest-prize/' . $id);
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'manage_contest')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->Contest_model->update_contest_prize();
                    $this->session->set_flashdata('success', lang('prize_updated_successfully'));
                }
                redirect('contest-prize/' . $id);
            }
            $this->result['max'] = $this->Contest_model->get_max_top_winner($id);
            $this->load->view('contest_prize', $this->result);
        }
    }

    public function delete_contest_prize()
    {
        if (!has_permissions('delete', 'manage_contest')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $this->Contest_model->delete_contest_prize($id);
            echo TRUE;
        }
    }
}
