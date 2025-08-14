<?php
class M_user extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function get_by_username($username)
  {
    return $this->db->get_where('tbl_user', ['username' => $username])->row();
  }

  public function get_modul_by_user($user_id)
  {
    $query = $this->db->query("
        SELECT 
            m.id AS modul_id, 
            m.name AS modul_name, 
            m.icon AS modul_icon, 
            m.url_modul,
            uma.role_id AS modul_role_id,
            ra_modul.akses AS modul_akses,
            
            mn.id AS menu_id, 
            mn.name AS menu_name, 
            mn.url AS menu_url,
            uma_menu.role_id AS menu_role_id,
            ra_menu.akses AS menu_akses
        FROM tbl_user_modul_akses uma
        JOIN tbl_modul m 
            ON m.id = uma.modul_id
        LEFT JOIN tbl_role_akses ra_modul 
            ON ra_modul.role_id = uma.role_id 
            AND ra_modul.akses IS NOT NULL

        LEFT JOIN tbl_menu mn 
            ON mn.modul_id = m.id
        LEFT JOIN tbl_user_menu_akses uma_menu 
            ON uma_menu.menu_id = mn.id 
            AND uma_menu.user_id = uma.user_id
        LEFT JOIN tbl_role_akses ra_menu 
            ON ra_menu.role_id = uma_menu.role_id
            AND ra_menu.akses IS NOT NULL

        WHERE uma.user_id = {$user_id}
          AND (m.url_modul != 'Dashboard' OR m.url_modul IS NULL)
        ORDER BY m.id, mn.id
    ")->result_array();

    $result = [];

    foreach ($query as $row) {
      $modul_id = $row['modul_id'];

      // Pastikan modul belum dibuat di array
      if (!isset($result[$modul_id])) {
        $result[$modul_id] = [
          'id' => $modul_id,
          'name' => $row['modul_name'],
          'icon' => $row['modul_icon'],
          'url_modul' => $row['url_modul'],
          'akses' => [],
          'menus' => []
        ];
      }

      // Simpan akses modul
      if ($row['modul_akses'] !== null && !in_array($row['modul_akses'], $result[$modul_id]['akses'])) {
        $result[$modul_id]['akses'][] = $row['modul_akses'];
      }

      // Kalau ada menu
      if ($row['menu_id'] !== null) {
        $menu_id = $row['menu_id'];

        if (!isset($result[$modul_id]['menus'][$menu_id])) {
          $result[$modul_id]['menus'][$menu_id] = [
            'id' => $menu_id,
            'name' => $row['menu_name'],
            'url' => $row['menu_url'],
            'akses' => []
          ];
        }

        if ($row['menu_akses'] !== null && !in_array($row['menu_akses'], $result[$modul_id]['menus'][$menu_id]['akses'])) {
          $result[$modul_id]['menus'][$menu_id]['akses'][] = $row['menu_akses'];
        }
      }
    }

    // Reset index numerik
    $final = array_values(array_map(function ($modul) {
      $modul['menus'] = array_values($modul['menus']);
      return $modul;
    }, $result));

    return $final;
  }



  public function get_role_akses_by_user($user_id)
  {
    $this->db->select('uma.modul_id, ra.akses');
    $this->db->from('tbl_user_modul_akses uma');
    $this->db->join('tbl_role_akses ra', 'ra.role_id = uma.role_id');
    $this->db->where('uma.user_id', $user_id);
    $query = $this->db->get()->result();

    $result = [];
    foreach ($query as $row) {
      $result[$row->modul_id][] = $row->akses;
    }

    return $result;
  }
}
