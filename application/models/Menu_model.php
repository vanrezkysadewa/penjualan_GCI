<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Menu_model extends CI_Model
{

    public function get_access_menu($role_id)
    {
        $this->db->select('*');
        $this->db->from('tb_user_access_menu');
        $this->db->join('tb_user_menu', 'tb_user_menu.id_um=tb_user_access_menu.menu_id', 'INNER');
        $this->db->where('tb_user_access_menu.role_id', $role_id);
        $this->db->order_by('tb_user_menu.menu_urut', 'ASC');
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_sub_menu($id)
    {

        $this->db->select('*');
        $this->db->from('tb_user_sub_menu');
        $this->db->where('tb_user_sub_menu.menu_id', $id);
        $info = $this->db->get();
        return $info->result_array();
    }


    public function save_menu_info($data) 
    {
        return $this->db->insert('tb_user_menu', $data);
    }

    public function save_submenu_info($data) 
    {
        return $this->db->insert('tb_user_sub_menu', $data);
    }

    public function get_all_menu() //ambil data dari tabel barang
    {
        $this->db->select('*');
        $this->db->from('tb_user_menu');
        $info = $this->db->get();
        return $info->result_array();

    }

    public function get_menu_id($id) 
    {
        $this->db->select('*');
        $this->db->from('tb_user_menu');
        $this->db->where('id_um', $id);
        $info = $this->db->get();
        return $info->row_array();
    }

    public function get_submenu_id($id) 
    {
        $this->db->select('*');
        $this->db->from('tb_user_sub_menu');
        $this->db->where('menu_id', $id);
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_all_satuan() //ambil data dari tabel satuan
    {

        $this->db->select('*');
        $this->db->from('tb_satuan');
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_single_barang($id) // ambil data barang berdasarkan id
    {

        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_barang.satuan_id=tb_satuan.satuan_id', 'inner');
        $this->db->where('tb_barang.id', $id);
        $info = $this->db->get();
        return $info->row_array();
    }



    public function update_barang_info($data, $id) // update barang
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_barang', $data);
    }

    public function update_stock_info($databarang, $barang_id) // update Stock
    {
        $this->db->where('id', $barang_id);
        return $this->db->update('tb_barang', $databarang);
    }

    public function delete_barang_info($id) // delate barang
    {
        $this->db->where('id', $id);
        return $this->db->delete('tb_barang');
    }
}