<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cek apakah user memiliki akses tertentu pada modul tertentu
 *
 * @param int $modul_id ID dari modul
 * @param int $akses_id ID dari akses (1=Create, 2=Read, dst)
 * @return bool
 */
function cek_akses($modul_id, $akses_id) {
    $CI =& get_instance();
    $CI->load->library('session');

    $role_akses = $CI->session->userdata('role_akses');

    if (isset($role_akses[$modul_id]) && in_array($akses_id, $role_akses[$modul_id])) {
        return true;
    }

    return false;
}
