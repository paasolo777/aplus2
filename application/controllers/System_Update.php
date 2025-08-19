<?php

defined('BASEPATH') or exit('No direct script access allowed');

class System_Update extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->helper('password_helper');
    }

    public function set_setting()
    {
        $purchase_code = $this->input->post('purchase_code');
        $purchase_code = getHashedPassword($purchase_code);
        $system_key = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        if ($system_key) {
            $frm_system_key = ['message' => $purchase_code];
            $this->db->where('type', 'system_key')->update('tbl_settings', $frm_system_key);
        } else {
            $frm_system_key = array(
                'type' => 'system_key',
                'message' => $purchase_code
            );
            $this->db->insert('tbl_settings', $frm_system_key);
        }
        $quiz_url = $this->input->post('quiz_url');
        $quiz_url = getHashedPassword($quiz_url);
        $configuration_key = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
        if ($configuration_key) {
            $frm_config_key = ['message' => $quiz_url];
            $this->db->where('type', 'configuration_key')->update('tbl_settings', $frm_config_key);
        } else {
            $frm_config_key = array(
                'type' => 'configuration_key',
                'message' => $quiz_url
            );
            $this->db->insert('tbl_settings', $frm_config_key);
        }
        redirect('/');
    }

    public function index()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                $pathToServiceAccountJsonFile = 'assets/firebase_config.json';
                if (!file_exists($pathToServiceAccountJsonFile)) {
                    redirect('firebase-configurations');
                }
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('update', 'system_update')) {
                        $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                    } else {
                        if ($_FILES['file']['name'] != '') {
                            $purchase_code = $this->input->post('purchase_code');
                            $quiz_url = $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://validator.wrteam.in/flutter_quiz_validator?purchase_code=' . $purchase_code . '&domain_url=' . $quiz_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                            ));
                            $response = curl_exec($curl);
                            $response = json_decode($response, 1);
                            curl_close($curl);
                            if ($response["error"] == false) {
                                $tmp_path = 'images/tmp';
                                if (!is_dir($tmp_path)) {
                                    mkdir($tmp_path, 0777, TRUE);
                                }
                                $target_path = getcwd() . DIRECTORY_SEPARATOR;

                                $config['upload_path'] = $tmp_path;
                                $config['allowed_types'] = 'zip|rar';
                                $config['file_name'] = $_FILES['file']['name'];
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);

                                if ($this->upload->do_upload('file')) {
                                    $uploadData = $this->upload->data();
                                    $fileName = $uploadData['file_name'];

                                    $zip = new ZipArchive();
                                    $filePath = $tmp_path . '/' . $fileName;
                                    $zipFile = $zip->open($filePath);
                                    if ($zipFile === true) {
                                        $zip->extractTo($tmp_path);
                                        $zip->close();
                                        unlink($filePath);

                                        $ver_file1 = $tmp_path . '/version_info.php';
                                        $source_path1 = $tmp_path . '/source_code.zip';
                                        $sql_file1 = $tmp_path . '/database.sql';
                                        if (file_exists($ver_file1) && file_exists($source_path1) && file_exists($sql_file1)) {
                                            $ver_file = $target_path . 'version_info.php';
                                            $source_path = $target_path . 'source_code.zip';
                                            $sql_file = $target_path . 'database.sql';

                                            if (rename($ver_file1, $ver_file) && rename($source_path1, $source_path) && rename($sql_file1, $sql_file)) {
                                                $version_file = require_once($ver_file);
                                                $res = $this->db->where('type', 'system_version')->get('tbl_settings')->row_array();
                                                $current_version = (!empty($res)) ? $res['message'] : '';
                                                if ($current_version == $version_file['current_version']) {
                                                    $zip1 = new ZipArchive();
                                                    $zipFile1 = $zip1->open($source_path);

                                                    if ($zipFile1 === true) {
                                                        $zip1->extractTo($target_path); // change this to the correct site path
                                                        $zip1->close();
                                                        if (file_exists($sql_file)) {
                                                            $lines = file($sql_file);
                                                            for ($i = 0; $i < count($lines); $i++) {
                                                                if (!empty($lines[$i])) {
                                                                    $this->db->query($lines[$i]);
                                                                }
                                                            }
                                                        }
                                                        unlink($source_path);
                                                        unlink($ver_file);
                                                        unlink($sql_file);
                                                        $frm_data = ['message' => $version_file['update_version']];
                                                        $this->db->where('type', 'system_version')->update('tbl_settings', $frm_data);
                                                        $this->session->set_flashdata('success', lang('system_update_successfully'));
                                                        redirect('system-updates', 'refresh');
                                                    } else {
                                                        unlink($source_path);
                                                        unlink($ver_file);
                                                        unlink($sql_file);
                                                        $this->session->set_flashdata('error', lang('something_wrong_please_try_again'));
                                                        redirect('system-updates', 'refresh');
                                                    }
                                                } else if ($current_version == $version_file['update_version']) {
                                                    unlink($source_path);
                                                    unlink($ver_file);
                                                    unlink($sql_file);
                                                    $this->session->set_flashdata('error', lang('system_is_alreay_updated'));
                                                    redirect('system-updates', 'refresh');
                                                } else {
                                                    unlink($source_path);
                                                    unlink($ver_file);
                                                    unlink($sql_file);
                                                    $this->session->set_flashdata('error', lang('your_version_is') . ' ' . $current_version . '.' . lang('please_update_nearest_version_first'));
                                                    redirect('system-updates', 'refresh');
                                                }
                                            } else {
                                                $this->DeleteDir($tmp_path);
                                                $this->session->set_flashdata('error', lang('invalid_file_please_try_again'));
                                                redirect('system-updates', 'refresh');
                                            }
                                        } else {
                                            $this->DeleteDir($tmp_path);
                                            $this->session->set_flashdata('error', lang('invalid_file_please_try_again'));
                                            redirect('system-updates', 'refresh');
                                        }
                                    } else {
                                        $this->DeleteDir($tmp_path);
                                        $this->session->set_flashdata('error',  lang('something_wrong_please_try_again'));
                                        redirect('system-updates', 'refresh');
                                    }
                                } else {
                                    $this->session->set_flashdata('error',  lang('only_zip_allow_please_try_again'));
                                    redirect('system-updates', 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error', $response["message"]);
                                redirect('system-updates', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error', lang('please_upload_zip_file'));
                            redirect('system-updates', 'refresh');
                        }
                    }
                    redirect('system-updates', 'refresh');
                }
                $this->result['system_version'] = $this->db->where('type', 'system_version')->get('tbl_settings')->row_array();
                $this->load->view('system_updates', $this->result);
            }
        }
    }

    // public function removeUser()
    // {
    //     $firebase_config = 'assets/firebase_config.json';
    //     if (file_exists($firebase_config)) {
    //         $factory = (new Factory)->withServiceAccount($firebase_config);
    //         $firebaseauth = $factory->createAuth();
    //         try {
    //             $getUser = $this->db->select('id,firebase_id')->get('tbl_users')->result_array();
    //             $chunks = array_chunk($getUser, 100);
    //             foreach ($chunks as $chunk) {
    //                 foreach ($chunk as $user) {
    //                     $firebaseId = $user['firebase_id'];
    //                     $user_id = $user['id'];
    //                     try {
    //                         $firebaseauth->getUser($firebaseId);
    //                     } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
    //                         $tables = [
    //                             'tbl_bookmark',
    //                             'tbl_contest_leaderboard',
    //                             'tbl_daily_quiz_user',
    //                             'tbl_exam_module_result',
    //                             'tbl_leaderboard_daily',
    //                             'tbl_leaderboard_monthly',
    //                             'tbl_level',
    //                             'tbl_payment_request',
    //                             'tbl_question_reports',
    //                             'tbl_rooms',
    //                             'tbl_tracker',
    //                             'tbl_users_badges',
    //                             'tbl_users_statistics',
    //                             'tbl_multi_match_question_reports'
    //                         ];

    //                         foreach ($tables as $type) {
    //                             if ($this->db->table_exists($type)) {
    //                                 $this->db->where('user_id', $user_id)->delete($type);
    //                             }
    //                         }

    //                         $this->db->where('id', $user_id)->delete('tbl_users');
    //                         $this->db->where('user_id1', $user_id)->delete('tbl_battle_statistics');
    //                         $this->db->where('user_id2', $user_id)->delete('tbl_battle_statistics');
    //                     } catch (\Throwable $t) {
    //                         return false;
    //                     }
    //                 }
    //             }
    //         } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    public function DeleteDir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        $dir_sec = $dir . "/" . $object;
                        if (is_dir($dir_sec)) {
                            foreach ($dir_sec as $sec) {
                                if ($sec != "." && $sec != "..") {
                                    if (filetype($dir . "/" . $dir_sec . "/" . $sec) == "dir") {
                                        $dir_sec1 = $dir . "/" . $dir_sec . "/" . $sec;
                                        if (is_dir($dir_sec1)) {
                                            rmdir($dir_sec1);
                                        }
                                    } else {
                                        unlink($dir . "/" . $dir_sec . "/" . $sec);
                                    }
                                }
                            }
                            rmdir($dir_sec);
                        }
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }
}
