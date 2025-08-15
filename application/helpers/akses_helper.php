<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function cek_akses($modul_id, $akses_id)
{
    $CI = &get_instance();
    $CI->load->library('session');

    $role_akses = $CI->session->userdata('role_akses');

    return isset($role_akses[$modul_id]) && in_array($akses_id, $role_akses[$modul_id]);
}

function get_modul_akses_user()
{
    $CI = &get_instance();
    $CI->load->model('M_user');

    // Pakai id_user (fallback ke 'id' kalau ada project lama)
    $user_id = $CI->session->userdata('id_user') ?: $CI->session->userdata('id');
    if (!$user_id) return [];

    return $CI->M_user->get_modul_with_access($user_id); // ini mengembalikan array of OBJECT
}

function get_menu_akses_user($modul_id)
{
    $CI = &get_instance();
    $CI->load->model('M_user');

    $user_id = $CI->session->userdata('id_user') ?: $CI->session->userdata('id');
    if (!$user_id) return [];

    return $CI->M_user->get_menu_with_access($user_id, $modul_id); // array of OBJECT
}
